<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('user.list', [
            'users' => User::orderBy('id')->get()
        ]);
    }

    public function view($id)
    {
        return view('user.view', [
            'user' => User::findOrFail($id)
        ]);
    }
}