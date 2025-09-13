<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordeRequest;
use App\Models\Row;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
     public function index() 
  {
    $tables= Table::with('rows')->get();
    return view('Dashboard.Tables.index',compact('tables'));
  }

  public function Create()
  {
    return view('Dashboard.Tables.CreateTable');
  }
public function store(RecordeRequest $request)
{
    DB::transaction(function () use ($request) {
        $table = new Table();
        $table->name = $request->table_name;
        $table->save();

        $totalCredit = 0;
        $totalDebit  = 0;

        if ($request->has('rows')) {
            foreach ($request->rows as $rowData) {
                if (!empty($rowData['statement'])) {
                    $row = new Row();
                    $row->statement = $rowData['statement'];
                    $row->credit    = $rowData['credit'] ?? 0;
                    $row->debit     = $rowData['debit'] ?? 0;
                    $row->details   = $rowData['details'] ?? null;

                 
                    $table->rows()->save($row);

                    $totalCredit += $row->credit;
                    $totalDebit  += $row->debit;
                }
            }
        }

        if ($totalCredit > 0 || $totalDebit > 0) {
            $table->total = $totalDebit - $totalCredit;
            $table->save();
        }
    });

    return redirect()->route('Table.all')->with('success', 'تم حفظ الجدول مع الأسطر بنجاح');
}


    public function edit($id)
{
    $table = Table::with('rows')->findOrFail($id);
    return view('Dashboard.Tables.edit', compact('table'));
}


public function update(RecordeRequest $request, $id)
{
    $table = Table::findOrFail($id);

    // تحديث اسم الجدول
    $table->name = $request->table_name;
    $table->save();

    if ($request->has('rows')) {
        foreach ($request->rows as $rowId => $rowData) {

            // حذف صف
            if (isset($rowData['_delete']) && $rowData['_delete'] == 1) {
                $row = Row::find($rowId);
                if ($row) $row->delete();
                continue;
            }


            if ($rowId === "new") {
                foreach ($rowData as $newRow) {
                    if (!empty($newRow['statement'])) {
                        $table->rows()->create([
                            'statement' => $newRow['statement'],
                            'credit'    => $newRow['credit'] ?? 1,
                            'debit'     => $newRow['debit'] ?? 1,
                            'details'   => $newRow['details'] ?? null,
                        ]);
                    }
                }
                continue;
            }

            // تحديث الأسطر القديمة
            $row = Row::find($rowId);
            if ($row) {
                $row->update([
                    'statement' => $rowData['statement'],
                    'credit'    => $rowData['credit'] ?? 1,
                    'debit'     => $rowData['debit'] ?? 1,
                    'details'   => $rowData['details'] ?? null,
                ]);
            }
        }
    }

    // حساب الصافي
    $table->total = $table->rows()->sum('debit') - $table->rows()->sum('credit');
    $table->save();

    return redirect()->route('Table.all')->with('success', 'تم تحديث الجدول بنجاح');
}
public function Destroy($id)
{
    $table =Table::findOrFail($id);

    $table->rows()->delete();
    $table->delete();

    return redirect()->route('Table.all');

}

public function print($id)
{
    $table = Table::with('rows')->findOrFail($id);
    return view('Dashboard.Tables.print', compact('table'));
}
}