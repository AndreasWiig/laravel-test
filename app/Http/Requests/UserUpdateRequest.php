<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    // add auth logic through policy or directly
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
        ];
    }

    public function updateUser(User $user)
    {
        return $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
    }
}
