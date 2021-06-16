<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LoginUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ];
    }

    public function existingUser()
    {
        return User::userByEmail($this->email)->first();
    }

    public function checkCredentials()
    {
        return !$this->existingUser() || !Hash::check($this->password, $this->existingUser()->password);
    }

    public function generateToken()
    {
        return $this->existingUser()->createToken('secret')->plainTextToken;
    }
}
