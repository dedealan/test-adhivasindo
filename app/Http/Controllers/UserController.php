<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(50);
        return response()->json([
            'status' => true,
            'data' => $users,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->all();
        $validator = Validator::make($payload, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal :min karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        $validated = $validator->validate();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'User baru berhasil ditambahkan.',
            ], 201);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan, silahkan coba lagi.',
        ], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'status' => true,
            'data' => $user,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $payload = $request->all();
        $validator = Validator::make($payload, [
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|min:8',
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal :min karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        $validated = $validator->validate();

        $user->update([
            'name' => $validated['name'] ?? $user->name,
            'email' => $validated['email'] ?? $user->email,
            'password' => isset($validated['password']) ? bcrypt($validated['password']) : $user->password,
        ]);

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'User berhasil diperbarui.',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan, silahkan coba lagi.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $deleteUser = $user->deleteOrFail();

        if ($deleteUser) {
            return response()->json([
                'status' => true,
                'message' => 'User berhasil dihapus.',
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan, silahkan coba lagi.',
        ], 500);
    }
}
