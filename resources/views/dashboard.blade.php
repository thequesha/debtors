@extends('layouts.app')
@section('title')
    Дешборд
@endsection

@section('content')
    {{-- @include('dashboard.header') --}}

    {{-- 
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
                @include('dashboard.statistics.customers')
                @include('dashboard.statistics.orders')
                @include('dashboard.statistics.growth')
            </div>
        </div>
    </div> <!-- row -->

    <div class="row">
        @include('dashboard.statistics.revenue')
    </div> <!-- row -->

    <div class="row">
        @include('dashboard.statistics.monthly-sales')
        @include('dashboard.statistics.cloud-storage')
    </div> <!-- row -->

    <div class="row">
        @include('dashboard.inbox')
        @include('dashboard.projects')
    </div> <!-- row --> --}}
@endsection
