@extends('layouts.master')

@section('content')
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">تعديل الجدول</h4>
            </div>
            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('Table.Update', $table->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">اسم الجدول</label>
                        <input type="text" name="table_name" class="form-control" value="{{ old('table_name', $table->name) }}" required>
                        @error('table_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <hr>
                    <h5>السجلات الحالية</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>البيان</th>
                                <th>له</th>
                                <th>عليه</th>
                                <th>التفاصيل</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($table->rows as $row)
                            <tr>
                                <td>
                                    <input type="text" name="rows[{{ $row->id }}][statement]" value="{{ old("rows.$row->id.statement", $row->statement) }}" class="form-control">
                                    @error("rows.$row->id.statement") <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                <td>
                                    <input type="number" name="rows[{{ $row->id }}][credit]" value="{{ old("rows.$row->id.credit", $row->credit) }}" class="form-control">
                                    @error("rows.$row->id.credit") <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                <td>
                                    <input type="number" name="rows[{{ $row->id }}][debit]" value="{{ old("rows.$row->id.debit", $row->debit) }}" class="form-control">
                                    @error("rows.$row->id.debit") <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                <td>
                                    <input type="text" name="rows[{{ $row->id }}][details]" value="{{ old("rows.$row->id.details", $row->details) }}" class="form-control">
                                </td>
                                <td>
                                    <input type="checkbox" name="rows[{{ $row->id }}][_delete]" value="1"> حذف
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <hr>
                    <h5>إضافة أسطر جديدة</h5>
                    <div id="new-rows"></div>
                    <button type="button" class="btn btn-success btn-sm mb-3" id="add-row">+ إضافة سطر جديد</button>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('Table.all') }}" class="btn btn-secondary me-2">رجوع</a>
                        <button type="submit" class="btn btn-primary">تحديث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
let rowIndex = 0;
document.getElementById('add-row').addEventListener('click', function () {
    let container = document.getElementById('new-rows');
    let row = `
        <div class="row mb-2">
            <div class="col-md-3"><input type="text" name="rows[new][${rowIndex}][statement]" placeholder="البيان" class="form-control"></div>
            <div class="col-md-2"><input type="number" name="rows[new][${rowIndex}][credit]" value="0" class="form-control"></div>
            <div class="col-md-2"><input type="number" name="rows[new][${rowIndex}][debit]" value="0" class="form-control"></div>
            <div class="col-md-4"><input type="text" name="rows[new][${rowIndex}][details]" placeholder="التفاصيل" class="form-control"></div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', row);
    rowIndex++;
});
</script>
@endsection
