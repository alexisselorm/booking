<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // The user's dashboard or profile page
    public function createUser(){
        // $user=User::create($request->all());
        // return response()->json($user,200);
        $attributes=request()->validate([
            'fname'=>'required|min:3|max:60',
            'mname'=>'required|min:3|max:60',
            'lname'=>'required|min:3|max:60',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8'
        ]);
        $user=User::create($attributes);
        return response()->json($user,200);
    }
    
    public function dashboard()
    {
        //
        return response()->json([
            "status" => 1,
            "message" => "Student Page",
            "data" => auth()->user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Login to the dashboard
    public function login(Request $request)
    {
        //validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        //check user
        $user = User::where("email", "=", $request->email)->first();

        if (isset($user->id)) {
            // create token
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken("auth_token")->plainTextToken;
                //send a response
                return response()->json([
                    "status" => 1,
                    "message" => "Logging You In",
                    "access_token" => $token
                ]);
            } else {
                return response()->json(
                    [
                        "status" => 0,
                        "message" => "Password is incorrect."
                    ],
                );
            }
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Email does not exist"
            ],);
        }
      



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Logout the User
    public function logout(Request $request)
    {
        //
        auth()->user()->tokens()->delete();

        return response()->json([
            "status" => 1,
            "message" => "Successfuly Logged Out",

        ], 200);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
