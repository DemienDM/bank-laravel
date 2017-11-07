<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Deposit;

class DepositController extends Controller
{
    public function index()
    {
        return view('deposit.list', [
            'deposits' => Deposit::orderBy('created_at')->get()
        ]);
    }

    public function view($id)
    {
        return view('deposit.view', [
            'deposit' => Deposit::findOrFail($id)
        ]);
    }
}