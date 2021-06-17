<?php

namespace App\Http\Controllers;

use App\Filters\SearchFilters;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
        ]);
        return response()->json($user, 201);
    }

    // model binding could be used
    public function show($id)
    {
        return response()->json(User::find($id));
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $request->updateUser($user);

        return response()->json($user, 201);
    }

    public function get(Request $request, SearchFilters $filters)
    {
        $query = $this->buildQueryFromRequest($request, $filters);
        return response()->json($query->get());
    }

    private function buildQueryFromRequest(Request $request, $filters)
    {
        return User::filter($filters);
    }
}
