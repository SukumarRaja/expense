<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expense;
use App\Models\User;
use Carbon\Carbon;

class IncomeController extends Controller
{
    public function addIncome(Request $request)
    {
        $data = $request->validate([
            'income_name' => 'required',
            'amount' => 'required|min:2',
            'date' => 'required',
            'is_income' => 'required',
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
            'income_name' => $data['income_name'],
            'amount' => $data['amount'],
            'date' => $data['date'],
            'is_income' => $data['is_income'],
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Income Added Successfully',
            'data' => $income,
        ]);
    }

    public function getIncome()
    {
        $user_id = auth()->user()->id;
        $in = Income::where(['user_id' => $user_id])->paginate(10);
        return response()->json([
            'status' => 200,
            'message' => 'Successfully get all income',
            'data' => $in,
        ]);
    }

    public function getMonthlyWiseIncome(Request $request)
    {
        $data = $request->validate([
            'month' => 'required',
            'year' => 'required',
        ]);
        $user_id = auth()->user()->id;
        $data = Income::where(['user_id' => $user_id])
            ->whereMonth('date', '=', $data['month'])
            ->whereYear('date', '=', $data['year'])
            ->paginate(10);

        return response()->json([
            'status' => 200,
            'message' => 'Successfully get monthly income',
            'data' => $data,
        ]);
    }
}
