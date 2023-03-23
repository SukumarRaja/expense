<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\User;

class ExpenseController extends Controller
{
    public function addExpense(Request $request)
    {
        // validate
        $data = $request->validate([
            'expense_category' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        //create

        $token = auth()->user()->id;
        $name = auth()->user()->name;
        $email = auth()->user()->email;

        $expense = Expense::create([
            'user_id' => $token,
            'user_email' => $email,
            'user_name' => $name,
            'expense_category' => $data['expense_category'],
            'amount' => $data['amount'],
            'date' => $data['date'],
            'time' => $data['time'],
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Expense Created Successfully',
            'data' => $expense,
        ]);
    }
}
