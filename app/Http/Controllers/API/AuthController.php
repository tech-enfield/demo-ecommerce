<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    /**
     * Login function
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $data = $request->only(['email', 'password']);

        $user = User::where('email', $data['email'])->first();

        if (!Hash::check($data['password'], $user->password)) {
            return $this->sendError('Credentials did not match.', null, 401);
        }

        Auth::login($user);
        $token = $user->createToken($data['email'])->plainTextToken;

        $bool = $user->person->expected_date != null ? true : false;

        return $this->sendResponse(['token' => $token, 'calculated' => $bool]);
    }

    /**
     * Register Function
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:normal_people,username',
            'contact' => 'required|unique:normal_people,contact',
            'email' => 'required|email|unique:normal_people,email',
            'dob' => 'required|date',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->contact)]);

        return $this->sendResponse(null, 'created', 201);
    }
}
