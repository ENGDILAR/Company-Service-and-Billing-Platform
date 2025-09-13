@extends('layouts.master')
@section('css')
<link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">السجلات</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة سجل جديد</span>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">إضافة جدول مع أسطره</h4>
            </div>
            <div class="card-body">
                <form action="{{route('Table.Store')}}" method="POST">
                    @csrf

                    <!-- إدخال اسم الجدول -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">اسم الجدول</label>
                        <input type="text" name="table_name" class="form-control" required>
                    </div>

                    <hr>

                    <!-- الأسطر -->
                    <h5>إضافة أسطر</h5>
                    <div id="rows-container">

                        <div class="row mb-3 single-row">
                            <div class="col-md-3">
                                <label class="form-label">البيان</label>
                                <input type="text" name="rows[0][statement]" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">له</label>
                                <input type="number" name="rows[0][credit]" class="form-control" value="0" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">عليه</label>
                                <input type="number" name="rows[0][debit]" class="form-control" value="0" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">التفاصيل</label>
                                <textarea name="rows[0][details]" class="form-control" rows="1"></textarea>
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm remove-row">-</button>
                            </div>
                        </div>

                    </div>

                    <!-- زر إضافة سطر جديد -->
                    <button type="button" id="add-row" class="btn btn-success btn-sm mb-3">+ إضافة سطر</button>

                    <div class="d-flex justify-content-end">
                        <a href="" class="btn btn-secondary me-2">إلغاء</a>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('Dashboard.messages_alert')
@endsection

@section('js')
<script>
    let rowIndex = 1;

    document.getElementById('add-row').addEventListener('click', function () {
        let container = document.getElementById('rows-container');

        let newRow = document.createElement('div');
        newRow.classList.add('row', 'mb-3', 'single-row');

        newRow.innerHTML = `
            <div class="col-md-3">
                <label class="form-label">البيان</label>
                <input type="text" name="rows[${rowIndex}][statement]" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">له</label>
                <input type="number" name="rows[${rowIndex}][credit]" class="form-control" value="0" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">عليه</label>
                <input type="number" name="rows[${rowIndex}][debit]" class="form-control" value="0" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">التفاصيل</label>
                <textarea name="rows[${rowIndex}][details]" class="form-control" rows="1"></textarea>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm remove-row">-</button>
            </div>
        `;

        container.appendChild(newRow);
        rowIndex++;
    });

    // حذف السطر
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('.single-row').remove();
        }
    });
</script>
@endsection
