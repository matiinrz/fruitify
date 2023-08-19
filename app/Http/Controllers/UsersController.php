<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return response()->json(User::query()->paginate());
    }

    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->permission = $request->input('permission');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return response()->json($user);
    }

    public function show(string $id)
    {
        $user = User::query()->findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, string $id)
    {
        /* @var User $user */
        $user = User::query()->findOrFail($id);
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->permission = $request->input('permission');
        if (!empty($request->input('password'))) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
        return response()->json($user);
    }

    public function destroy(string $id)
    {
        $user = User::query()->findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'success']);
    }
}
