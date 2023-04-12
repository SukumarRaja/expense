<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expense;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function getTransations(Request $request)
    {
        $data = $request->validate([
            'date' => 'required',
        ]);

        $user_id = auth()->user()->id;

        // user requested date
        $parse = Carbon::parse($data['date']);

        // return $date;
        $income = Income::where(['user_id' => $user_id])
            ->whereDate('date', '=', $parse->format('y-m-d'))
            ->orderBy('created_at', 'ASC')
            ->get();
        $expense = Expense::where(['user_id' => $user_id])
            ->whereDate('date', '=', $parse->format('y-m-d'))
            ->orderBy('created_at', 'ASC')
            ->get();
        $merged = array_merge($income->toArray(), $expense->toArray());

        return response()->json([
            'status' => 200,
            'message' => 'Successfully get all transactions',
            // 'income'=>$income,
            // // 'expense'=>$expense,
            'data' => $merged,
        ]);
    }

    public function totalIncomeAndExpense(Request $request)
    {
        $data = $request->validate([
            // 'date' => 'required',
        ]);

        $user_id = auth()->user()->id;
        $income_total = Income::select('amount')
            ->where('user_id', '=', $user_id)
            ->get();
        $it = $income_total->sum('amount');
        $expense_total = Expense::select('amount')
            ->where('user_id', '=', $user_id)
            ->get();
        $et = $expense_total->sum('amount');
        return response()->json([
            'status' => 200,
            'message' => 'Successfully get total income',
            'total_income' => $it,
            'total_expense' => $et,
        ]);
    }
}
