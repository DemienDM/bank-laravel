<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transaction.list', [
            'transactions' => Transaction::orderBy('id')->get()
        ]);
    }
}