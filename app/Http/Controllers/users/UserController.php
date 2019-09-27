<?php

namespace App\Http\Controllers\Users;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Hash;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $this->showAll($users);
        // return Response()->json(['data'=> $users], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        // $data['password'] = bcrypt($request->password);
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        return $this->showOne($user, 201);
        //return Response()->json(['data'=> $user], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //$user = User::FindorFail($user);
        //return Response()->json(['data'=> $user], 200);

        return $this->showOne($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //$user = User::FindorFail($user->id);
        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed'
        ];
        $this->validate($request, $rules);
        if ($request->has('name')) {

            $user->name = $request->name;
        }
        // if( $request->has('email')&& $user->email != $request->email) {
        //     // $user->verified = ' not verified';
        //     // $user->verification_token = User::generateVerificationCode();
        //     $user->email = $request->email;
        //     dd($user->email);
        // }

        if ($request->has('email') && $user->email != $request->email) {

            $user->email = $request->email;
        }


        if ($request->has('password')) {

            $password = Hash::make($request->password);
            $user->password = $password;
        }

        if (!$user->isDirty()) {
            return $this->errorResponse('Nothing to update Friend', 422);
        }

        $user->update();
        // return Response()->json(['error' => 'Nothing to update Friend', 'code' => 409], 409);
        // return Response()->json(['data' => $user], 200);
        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        // return Response()->json(['data' => $user], 200);
        return $this->showOne($user);
    }
}
