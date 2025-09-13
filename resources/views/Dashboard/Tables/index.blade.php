@extends('layouts.master')
@section('css')
<link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">السجلات</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة السجلات</span>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row row-sm">
    <div class="col-xl-12">
        <h5 class="mb-3"><a href="{{route('Table.Create')}}">إضافة سجل جديد</a></h5>
        <div class="card">
            <div class="card-body">
                <div id="table-container" class="table-responsive">
                    @foreach ($tables as $table)
                    <table class="table table-bordered text-md-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 50px;"></th>
                                <th>اسم الجدول</th>
                                <th>الصافي</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <button class="btn btn-sm btn-link" type="button" data-toggle="collapse" data-target="#rows-{{$table->id}}" aria-expanded="false">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </td>
                                <td>{{$table->name}}</td>
                                <td>
                                  <span class="{{ ($table->total) < 0 ? 'text-danger' : 'text-success' }}">{{$table->total}}</span>
                                </td>
                                <td>
                                    <a href="{{route('Table.Edit',$table->id)}}" class="btn btn-sm btn-success">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{route('Table.Destroy',$table->id)}}" method="POST" style="display:inline-block;" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا الجدول مع أسطره؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                      <a href="{{ route('Table.Print', $table->id) }}" class="btn btn-sm btn-info">
                                         <i class="fas fa-file-pdf"></i>
                                      </a>
                                </td>
                            </tr>

                            <tr class="collapse" id="rows-{{$table->id}}">
                                <td colspan="3">
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>البيان</th>
                                                <th>له</th>
                                                <th>عليه</th>
                                                <th>الصافي</th>
                                                <th>التاريخ</th>
                                                <th>التفاصيل</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($table->rows as $row)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$row->statement}}</td>
                                                <td><span class="text-body">{{$row->credit}}</span></td>
                                                <td>{{$row->debit}}</td>
                                                <td>
                                                     <span class="{{ ($row->debit - $row->credit) < 0 ? 'text-danger' : 'text-success' }}">
                                                                  {{$row->debit - $row->credit}}
                                                     </span>
                                                </td>
                                                <td>{{$row->created_at->format('Y-m-d')}}</td>
                                                <td>{{$row->details}}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">لا توجد سجلات بعد</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endforeach
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>

@include('Dashboard.messages_alert')
@endsection

@section('js')
@endsection
