<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Support\Facades\Validator;

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
        $userPlans = Plan::where('user_id', $userId)->get();
        $userName = $user->name[strlen($user->name) - 1] == "s" ? $user->name . "'" : $user->name . "'s";
        return view('userPage', compact('userPlans'), compact('user'))->with('userName', $userName);
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
        if (auth()->user() && $this->authorize('edit', $user))
        {
            $user = User::findOrFail($userId);
            return view('editUserPage', compact('user'));
        }
        else
        {
            return redirect('/');
        }
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'age' => 'nullable|integer',
            'height' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'sex' => 'nullable|integer'
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with("error", "Account not updated - one or more fields have an error");
        }

        $user = User::findOrFail($userId);
        if (auth()->user() && $this->authorize('update', $user))
        {
            $user->name = $request->name;
            $user->age = $request->age;
            $user->weight = $request->weight;
            $user->height = $request->height;
            $user->sex = $request->sex;
            $user->save();
            return back()->with('success', 'Account has been updated successfully.');
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
        $user = User::findOrFail($id);
        if (auth()->user() && $this->authorize('delete', $user))
        {
            $user->strava_activity()->delete();
            $user->delete();
            return redirect('/')->with('success', 'Account has been deleted successfully');
        }
        else
        {
            return redirect('/');
        }
    }
}
