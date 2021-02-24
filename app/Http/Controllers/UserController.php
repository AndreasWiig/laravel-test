<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function show($id)
    {
        return response()->json(User::find($id));
    }

    public function get(Request $request)
    {
        $query = $this->buildQueryFromRequest($request);
        return response()->json($query->get());
    }

    private function buildQueryFromRequest(Request $request)
    {
        $query = User::query();
        if ($request->has('filter') && isset($request->filter['created_after'])) {
            $query->createdAfter($request->filter['created_after']);
        }
        return $query;
    }
}
