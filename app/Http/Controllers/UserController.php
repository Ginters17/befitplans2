<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Plan;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $userPlans=Plan::where('user_id', $userId)->get();
        return view('userPage', compact('userPlans'), compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        return view('editUserPage', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId)
    {
        $rules = array( 
            'name' => 'required|min:1|max:40',
            'age' => 'required|min:1|max:100',
            'weight' => 'required|min:1|max:200',
            'height' => 'required|min:1|max:200',
            'sex' => 'required',
        );
        $user = User::findOrFail($userId);
        if (Auth::user()) 
        {
            // if (auth()->user()->can('update', $userId)) 
            // {
                $this->validate($request, $rules);   
                $user->name = $request->name;
                $user->age = $request->age;
                $user->weight = $request->weight;
                $user->height = $request->height;
                $user->sex = $request->sex;
                $user->save();
                return redirect('/');
            // }
            // else 
            // { 
            //     return redirect('/'); 
            // }
        } 
        else 
        {
            return redirect('/'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
