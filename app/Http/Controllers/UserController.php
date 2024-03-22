<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    /*  format for controller action functions
        index -> List of Users, return blade with data if WEB, return data only if API
        create -> Page of create user, WEB only
        edit -> Page of Edit User, WEB only
        show -> Get Data of User, return blade with data if WEB, return data only if API
        store -> Create User Function
        update -> Update User Function
        destroy -> Delete User Function

        Custom Functions (Camel Case)
        e.g. enableUser

        Variables (snake)
        e.g. $user_data

        Properties & Methods of Class/Objects (Camel Case)
        e.g. $class->userData
    */


    /**
     * Display a listing of the resource.
     */
    public function users()
    {
        $users = User::latest()->paginate(10);

        return view('user.users', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_user()
    {
        return view('user.create_user');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store_user(UserRequest $request)
    {
        // $request->validate([
        // 'name' => 'required|string|max:255',
        // 'address' => 'required|string|max:255',
        // 'email' => 'required|email|unique:users|max:255',
        // 'password' => 'required|string|min:8',
        // ]);

        $input = $request->all();

        User::create($input);

        return redirect()->route('user.users')
                        ->with('success', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show_user(User $user)
    {
        return view('user.show_user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_user(User $user)
    {
        return view('user.edit_user',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update_user(Request $request, User $user)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'address' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users|max:255',
        //     'password' => 'required|string|min:8',
        //     ]);

            $input = $request->all();

        $user->update($input);

        return redirect()->route('user.users')
                        ->with('success','User updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy_user(User $user)
    {
        $user->delete();

        return redirect()->route('user.users')
                        ->with('success', 'User removed successfully');
    }
}
