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
        $completedUserPlans = Plan::where('user_id', $userId)
            ->where('is_complete', '1')
            ->get();
        $notCompletedUserPlans = Plan::where('user_id', $userId)
            ->where(
                function ($query)
                {
                    $query->where('is_complete', '0')
                        ->orWhereNull('is_complete');
                }
            )->get();

        $userName = $user->name[strlen($user->name) - 1] == "s" ? $user->name . "'" : $user->name . "'s";
        return view('userPage', compact('completedUserPlans','notCompletedUserPlans','user'))->with('userName', $userName);
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
            'age' => 'nullable|integer|max:100',
            'height' => 'nullable|integer|max:300',
            'weight' => 'nullable|integer|max:500',
            'sex' => 'nullable|integer|digits:1'
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
            $user->plan()->delete();
            $user->delete();
            return redirect('/')->with('success', 'Account has been deleted successfully');
        }
        else
        {
            return redirect('/');
        }
    }
}
