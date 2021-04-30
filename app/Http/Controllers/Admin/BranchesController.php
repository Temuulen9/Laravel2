<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class BranchesController extends Controller
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
        
        $branches = Branch::all();
        return view('admin.branches.index')->with('branches', $branches);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => ['string', 'required'],
            'image' => ['image'],
            'phone_number' => ['regex:/\b\d{8}$/'],
            'location' => ['string', 'required']
        ]);

        $imagepath = $request->file('image')->store('uploads', 'public');

        $branch = Branch::create([
            'name' => $request['name'],
            'image' => $imagepath,
            'phone_number' => $request['phone_number'],
            'location' => $request['location']
        ]);

        return redirect()->route('admin.branches.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        $users = Branch::find($branch->id)->hasUsers;
        return view('admin.branches.show', [
            'branch' => $branch,
            'users' => $users,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        return view('admin.branches.edit')->with([
            'branch'=> $branch
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {

      
        $data = request()->validate([
            'name' => ['string', 'required'],
            'image' => ['image'],
            'phone_number' => ['regex:/\b\d{8}$/'],
            'location' => ['string', 'required']
        ]);

        $imagepath = $request->file('image')->store('uploads', 'public');

        $branch->name = $request->name;
        $branch->image = $imagepath;
        $branch->phone_number = $request->phone_number;
        $branch->location = $request->location;
        if($branch->save())
        {
            $request->session()->flash('success',$branch->name . ' салбарын мэдээлэл шинэчлэгдлээ.');
        }
        else
        {
            $request->session()->flash('error', $branch->name . ' салбарын мэдээлэлийг шинэчлэхэд алдаа гарлаа.');
        }

        return redirect()->route('admin.branches.index');
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        User::where('branch_id', $branch->id)->delete();
        $branch->delete();

        return redirect()->route('admin.branches.index');
    }
}
