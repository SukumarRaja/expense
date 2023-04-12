<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\IncomeController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile/get', [AuthController::class, 'profile']);
    Route::post('profile/update', [AuthController::class, 'update']);
    Route::get('logout', [AuthController::class, 'logout']);

    //add income
    Route::post('income/add', [IncomeController::class, 'addIncome']);
    Route::get('income/get', [IncomeController::class, 'getIncome']);
    Route::get('income/getMonthly', [
        IncomeController::class,
        'getMonthlyWiseIncome',
    ]);

    // add expesne
    Route::post('expense/add', [ExpenseController::class, 'addExpense']);
    Route::get('expense/get', [ExpenseController::class, 'getExpense']);
    Route::get('expense/getMonthly', [
        ExpenseController::class,
        'getMonthlyWiseExpense',
    ]);

    //transactions
    Route::get('allTransactions', [
        TransactionController::class,
        'getTransations',
    ]);
    Route::get('getTotalIncomeAndExpense', [
        TransactionController::class,
        'totalIncomeAndExpense',
    ]);
});

//auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//categories
Route::post('category/add', [CategoriesController::class, 'addCategorey']);
Route::get('category/get', [CategoriesController::class, 'getCategories']);
Route::get('category/delete', [
    CategoriesController::class,
    'deleteCategories',
]);
