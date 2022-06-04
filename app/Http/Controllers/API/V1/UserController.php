<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return response()->json([
            'statusCode' => 200,
            'message' => 'User.list',
            'data'=> $users
        ]);
    }
    public function show(User $user)
    {
        // $user = User::find($id);
        return response()->json([
            'statusCode' => 200,
            'message' => 'User.detail',
            'data'=> $user
        ]);
    }
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();
        return response()->json([
            'statusCode' => 200,
            'message' => 'user.store',
            'data' => $user
        ]);
    }
}
