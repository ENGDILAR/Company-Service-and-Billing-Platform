<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class UserController extends Controller
{
   function index()
   {
 $tables = Table::with('rows')->get();
    $totalDebit = $tables->sum(fn($table) => $table->rows->sum('debit'));
    $totalCredit = $tables->sum(fn($table) => $table->rows->sum('credit'));
    $totalDifference = $totalDebit - $totalCredit;

    return view('Dashboard.dashboard', [
        'debits' => $totalDebit,
        'credits' => $totalCredit,
        'differences' => $totalDifference,
    ]);

   }
}
