<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expense;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function getTransations()
    {
        $user_id = auth()->user()->id;

        $d = Carbon::parse('2023-04-14 00:00:00.000');
        $dt= Carbon::now();
        $current_month = $dt->month;
        $current_year = $dt->year;
        
        return $dt->month;

        $income = Income::where(['user_id' => $user_id])
            ->whereDate('date', '=', $data['month'])
            ->whereMonth('date', '=', $data['year'])
            ->whereYear('date', '=', $data['year'])
            ->paginate(10);
        return $income;
        return $d->day;
        $expense = Expense::find($user_id)->all();
        $merged = array_merge($income->toArray(), $expense->toArray());
        return response()->json([
            'status' => 200,
            'message' => 'Successfully get all transactions',
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
