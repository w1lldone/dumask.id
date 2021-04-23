<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        /** @var User */
        $user = $request->user();

        // Appending $user->has_no_password attribute
        $user->append('has_no_password');

        return $user;
    }

    public function update(Request $request)
    {
        /** @var User */
        $user = $request->user();

        $data = $request->validate([
            'name' => 'string|max:255|min:3',
        ]);

        $user->update($data);

        return $user->fresh();
    }

    public function updatePassword(Request $request)
    {
        /** @var User */
        $user = $request->user();

        $request->validate([
            'old_password' => [
                Rule::requiredIf($user->has_no_password ==  false),
                function ($attribute, $value, $fail) use ($user)
                {
                    if (Hash::check($value, $user->password) == false) {
                        $fail('The ' . $attribute . ' is not match.');
                    }
                }
            ],
            'password' => 'string|min:8|confirmed'
        ]);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return response([
            'success' => true
        ]);
    }
}
