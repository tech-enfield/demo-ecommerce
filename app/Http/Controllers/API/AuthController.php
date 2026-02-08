<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

        // $bool = $user->person->expected_date != null ? true : false;

        return $this->sendResponse(['token' => $token, 'user' => $user]);
    }

    /**
     * Register Function
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password)]);

        return $this->sendResponse(null, 'created', 201);
    }

    public function me()
    {
        if (Auth::check()) {
            return $this->sendResponse(User::find(Auth::id()));
        } else {
            return $this->sendError('Unauthenticated', null, 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->sendResponse(null, 'Logged out successfuly.', 200);
    }

    public function editProfile(Request $request)
    {
        $user = User::find(Auth::id());

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update($validated);

        return $this->sendResponse($user, 'Profile updated successfully');
    }

    public function changePassword(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'current_password' => ['required'],
            'new_password'     => ['required', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->sendError('Current password is incorrect.', null, 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        // Optional: revoke all tokens after password change
        $user->tokens()->delete();

        return $this->sendResponse(null, 'Password Changed successfully');
    }

    public function deleteAccount(Request $request)
    {
        $user = User::find(Auth::id());

        // Optional: confirm password before deleting
        $request->validate([
            'password' => ['required'],
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return $this->sendError('Current password is incorrect.', null, 422);
        }

        // Revoke all tokens
        $user->tokens()->delete();

        $user->delete();

        return $this->sendResponse(null, 'Account deleted successfully');
    }


}
