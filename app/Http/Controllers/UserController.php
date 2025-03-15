<?php

namespace App\Http\Controllers;

use App\Models\User2;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User2::all();

        return response()->json([
            'status' => 200,
            'message' => 'user retrieved successfully',
            'data' => $users
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'username' => 'required|string',
            'phone' => 'required|integer'
        ]);

        $Users = User2::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'User created successfully',
            'data' => $Users
        ], 201);
    }

    public function show($id)
    {
        $Users = User2::find($id);

        if (!$Users) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found',
                'data' => null
                ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'User retrieved successfully',
            'data' => $Users
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $Users = User2::find($id);

        if (!$Users) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found',
                'data' => null
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'username' => 'required|string',
            'phone' => 'required|integer'
        ]);
        $Users->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'User updated successfully',
            'data' => $Users
        ], 200);
    }

    public function destroy($id)
    {
        $Users = User2::find($id);

        if (!$Users) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found',
                'data' => null
            ], 404);
        }

        $Users->delete();

        return response()->json([
            'status' => 200,
            'message' => 'User deleted successfully',
            'data' => null
        ], 200);
    }
}
