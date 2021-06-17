<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function index()
    {
        return response()->json(['version' => '0.0.1']);
    }
}
