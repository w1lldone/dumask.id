<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $user = new User;

        $users = $user->paginate();

        return view('user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'is_superadmin' => 'nullable|boolean'
        ]);

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
            'is_superadmin' => 'nullable|boolean'
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
