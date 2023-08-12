<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        return response()->json($user);
    }

    public function login(LoginRequest $request)
    {
        /** @var User $user */
        $user = User::query()
            ->where('username', $request->input('username'))
            ->firstOrFail();

        if (!Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                "message" => "احراز هویت انجام نشد"
            ], 422);
        }
        $user->save();

        $token = $user->createToken('bearer');
        Auth::guard('web')->login($user);
        return response()->json(collect($user)->put('token', $token->plainTextToken));
    }
    public function destroy($action)
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            "message" => "success"
        ]);
    }
}
