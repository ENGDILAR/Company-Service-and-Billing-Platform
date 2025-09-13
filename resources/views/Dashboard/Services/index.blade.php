@extends('layouts.master')

@section('css')
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet"/>
@endsection

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الخدمات</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الخدمات</span>
        </div>
    </div>
</div>
@endsection

@section('content')
@include('Dashboard.messages_alert')

<!-- زر إضافة خدمة جديدة -->
<div class="row mb-3">
    <div class="col-sm-6 col-md-3">
        <button type="button" class="btn btn-primary-gradient btn-block" data-toggle="modal" data-target="#addServiceModal">
            إضافة خدمة جديدة
        </button>
    </div>
</div>

@include('Dashboard.Services.AddServiceModal')

<!-- عرض الخدمات -->
<div class="row">
  @foreach ($services as $service)
    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
        <div class="card item-card h-100">
            <div class="card-body pb-0 h-100 text-center">
                <h5>{{ $service->name }}</h5>
                
                <!-- الوصف -->
                <p>
                    {{ $service->description ?? 'الوصف لم يحدد بعد' }}
                </p>
                
                <!-- السعر -->
                <span class="font-weight-bold">
                    {{ $service->price !== null ? $service->price . '$' : 'السعر لم يحدد بعد' }}
                </span>
            </div>
            <div class="text-center border-top pt-3 pb-3">
                <!-- زر الحذف -->
                <form action="{{ route('Services.destroy', $service->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">حذف الخدمة</button>
                </form>

                <!-- زر التعديل -->
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editServiceModal{{ $service->id }}">
                    تعديل
                </button>
            </div>
        </div>
    </div>

    <!-- تضمين مودال التعديل لكل خدمة -->
    @include('Dashboard.Services.EditServiceModal', ['service' => $service])
  @endforeach
</div>

@endsection

@section('js')
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
