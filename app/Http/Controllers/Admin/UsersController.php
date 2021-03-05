<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\DocBlock\Tags\InvalidTag;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }


    public function create()
    {
        $branches = Branch::all();
        return view('admin.users.create')->with('branches', $branches);
        
    }
    

    public function store(Request $request)
    {

        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'register' => ['required', 'regex:/[А-Я]{2}\d{8}$/', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'lesson_type' => ['required', 'string'],
            'branch' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $branch_id = Branch::select('id')->where('name', $request['branch'])->get()->first();
        $user = User::create([
           'name' => $request['name'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'register' => $request['register'],
            'lesson_type' =>$request['lesson_type'],
            'branch' => $request['branch'],
            'branch_id' => $branch_id->id,
            'password' => Hash::make($request['password']),
        ]);
    
        $role = Role::select('id')->where('name', 'user')->first();
        
        $user->roles()->attach($role);

        if($user->save())
        {
            $request->session()->flash('success',$user->name . ' хэрэглэгчийг амжилттай нэмлээ.');
        }

        return redirect()->route('admin.users.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::denies('edit-users'))
        {
            return redirect(route('admin.users.index'));
        }
        $roles = Role::all();

        return view('admin.users.edit')->with([
            'user'=> $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.profile', [
            'user' => $user,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;

        if($user->save())
        {
            $request->session()->flash('success',$user->name . ' хэрэглэгчийн мэдээлэл шинэчлэгдлээ.');
        }
        else
        {
            $request->session()->flash('error', 'There was an error updating user');
        }



        return redirect()->route('admin.users.index');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete-users'))
        {
            return redirect(route('admin.users.index'));
        }

        $user->roles()->detach();
        $user->delete();

        return back()->withInput();
    }
}
