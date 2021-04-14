<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $user = new User;

        if ($request->filled('keywords')) {
            $user = $user->where(function ($query) use ($request)
            {
                $query->where('name', 'like', "%{$request->keywords}%")
                    ->orWhere('email', 'like', "%{$request->keywords}%");
            });
        }

        $users = $user->paginate();

        return view('user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request['is_superadmin'] = $request['is_superadmin'] == 'true' ? true : false;

        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'is_superadmin' => 'nullable|boolean',
            'permissions' => ['array', Rule::in(User::$permissions), 'nullable']
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return $user;
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);

        return $user;
    }

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        
        $data = $request->validate([
            'name' => 'string|max:255|min:3',
            'email' => ['email', Rule::unique('users', 'email')->ignore($user)],
            'is_superadmin' => 'nullable|boolean',
            'permissions' => ['array', Rule::in(User::$permissions), 'nullable']
        ]);

        $user->update($data);

        return $user->fresh();
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response(null, 204);
    }
}
