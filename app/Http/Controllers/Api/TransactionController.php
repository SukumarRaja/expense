<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expense;

class TransactionController extends Controller
{
    public function getTransations(Request $request)
    {
        $user_id = auth()->user()->id;
        $income = Income::find($user_id)->all();
        $expense = Expense::find($user_id)->all();
        $merged = array_merge($income->toArray(), $expense->toArray());
        return response()->json([
            'status' => 200,
            'message' => 'Successfully get all transactions',
            'data' => $merged,
        ]);
    }
}
