<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\User;

class IncomeController extends Controller
{
    public function addIncome(Request $request)
    {
        $data = $request->validate([
            'category_name' => 'required',
            'amount' => 'required|min:2',
            'date' => 'required',
            'user_id' => '',
            'user_name' => '',
            'user_email' => '',
        ]);
        $token = auth()->user()->id;
        $name = auth()->user()->name;
        $email = auth()->user()->email;
        // return $name;
        $income = Income::create([
            'user_id' => $token,
            'user_name' => $name,
            'user_email' => $email,
            'category_name' => $data['category_name'],
            'amount' => $data['amount'],
            'date' => $data['date'],
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Income Added Successfully',
            'data' => $income,
        ]);
    }
}
