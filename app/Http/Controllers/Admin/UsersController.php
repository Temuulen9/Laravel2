<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use Gate;
use Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\DocBlock\Tags\InvalidTag;
use Auth;
use Carbon\Carbon;
use App\Rules\MatchOldPassword;
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
        if(Gate::check('admin'))
        {
            
            $users = Branch::find(Auth::user()->branch_id)->hasUsers;
        
        }

        
        return view('admin.users.index')->with('users', $users);
    }


    public function admin()
    {
        $users = Role::find(2)->hasUsers;
  
        return view('admin.index')->with('users', $users);
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
            'register' => array('required', 'regex:/(^([ФЦУЖЭНГШҮЗКЪЙЫБӨАХРОЛДПЯЧЁСМИТЬВЮЩЕ]{2}+)(\d{8}+)$)/u', 'unique:users'),
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'lesson_type' => ['required', 'string'],
            'branch' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
        
        $branch_id = Branch::select('id')->where('name', $request['branch'])->get()->first();
        $userRole = Role::where('name' , 'user')->get()->first();
        $user = User::create([
           'name' => $request['name'],
            'lastname' => $request['lastname'],
            'email' => $request['email'],
            'register' => $request['register'],
            'lesson_type' =>$request['lesson_type'],
            'branch' => $request['branch'],
            'branch_id' => $branch_id->id,
            'password' => Hash::make($request['password']),
            'role' => $userRole->name,
            'role_id' =>$userRole->id,
        ]);
    


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
  
        if(Route::currentRouteName() != "profile.edit")
        {
            if(Gate::denies('manage-user'))
            {
                return redirect(route('admin.users.index'));
            }
            $roles = Role::all();
            $branches = Branch::all();
            return view('admin.users.edit')->with([
                'user'=> $user,
                'roles' => $roles,
                'branches' => $branches,
            ]);
        }
        else{
            if(Auth::user() == $user)
            {
                return view('Profile.edit')->with('user', $user);
            }
            else
            {
                return redirect()->route('profile.show' , ['user' => Auth::user()]);
            }
        }
    

}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $counter = 0;
    if(Auth::user() == $user)
    {
        if($user->role == 'payed_user')
        {

            if(count($user->hasResults) > 0)
            {
    
                for($i = 0; $i < count($user->hasResults); $i++)
                {
                    if(Auth::user()->lesson_type == "Шинэ жолоочийн сургалт"){

                        if($user->hasResults[$i]->point >= 18)
                        {
            
                            $counter++;
                        }   
                        
                    }
                    else{
                        if($user->hasResults[$i]->point >= 9)
                        {
                            $counter++;
                        } 
                    }
                }
                
            }
            return view('admin.users.profile', [
                'user' => $user,
                'counter' => $counter,
            ]);
        }
        else
        {

            return view('admin.users.profile', [
                'user' => $user,
            ]);
        }
    }  
    else
    {
        return redirect()->route('profile.show' , ['user' => Auth::user()]);
    }
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
        if($request->register != $user->register){


            $request->validate([
                'register' => array('required', 'regex:/(^([ФЦУЖЭНГШҮЗКЪЙЫБӨАХРОЛДПЯЧЁСМИТЬВЮЩЕ]{2}+)(\d{8}+)$)/u', 'unique:users'),
            ]);
        }
        elseif($request->email != $user->email)
        {
            $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }
        else
        {
            
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'lesson_type' => ['required', 'string'],
                'branch' => ['required', 'string'],
    ]);
        }
            
        $branch_id = Branch::select('id')->where('name', $request['branch'])->get()->first();

       
        $role = Role::where('name', $request['roles'])->get()->first();
        if($request['roles'] == 'payed_user')
        {
            $user->verified_date = Carbon::now();
        }
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->register = $request->register;
        $user->email = $request->email;
        $user->lesson_type = $request['lesson_type'];
        $user->branch = $request['branch'];
        $user->branch_id = $branch_id->id;
        $user->role = $request->roles;
        $user->role_id = $role->id;
        if($user->save())
        {
            $request->session()->flash('success',$user->name . ' хэрэглэгчийн мэдээлэл шинэчлэгдлээ.');
        }
        else
        {
            $request->session()->flash('error', $user->name . ' хэрэглэгчийн мэдээлэллийг шинэчлэхэд алдаа гарлаа.');
        }


        return redirect()->route('admin.users.index');
    }

    public function updateProfile(Request $request, User $user)
    {
        if(Auth::user() == $user)
        {
            if($user->email == $request->email){
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'lastname' => ['required', 'string', 'max:255'],
                ]);
            }
            else
            {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'lastname' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
                ]);
            }
        $user->email = $request->email;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        if($user->save())
        {
            $request->session()->flash('success',$user->name . ' хэрэглэгчийн мэдээлэл шинэчлэгдлээ.');
        }
        else
        {
            $request->session()->flash('error', $user->name . ' хэрэглэгчийн мэдээлэллийг шинэчлэхэд алдаа гарлаа.');
        }
        return redirect()->route('profile.edit', $user);
    }
    else
    {
        return redirect()->route('profile.show' , ['user' => Auth::user()]);
    }
    }

    public function changePassword(User $user)
    {
        if(Auth::user() == $user)
        {
        return view('Profile.changePassword')->with('user', $user);
        }
        else
            {
                return redirect()->route('profile.show' , ['user' => Auth::user()]);
            }
    }

    public function change(Request $request, User $user)
    {

        $request->validate([
    
            'password_old' => ['required', new MatchOldPassword],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::find($user->id)->update(['password'=> Hash::make($request->password)]);
        return redirect()->route('profile.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('manage-user'))
        {
            return redirect(route('admin.users.index'));
        }

  
        $user->delete();

        return back()->withInput();
    }
}
