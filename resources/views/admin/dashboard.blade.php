@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('admin-content')

<div class="grid grid-cols-12 gap-4 md:gap-6">

    <div class="col-span-12 space-y-6 xl:col-span-7">
        @include('admin.components.metric-group.metric-group-01')
        @include('admin.components.chart.chart-01')
    </div>

    <div class="col-span-12 xl:col-span-5">
        @include('admin.components.chart.chart-02')
    </div>

    <div class="col-span-12">
        @include('admin.components.chart.chart-03')
    </div>

    <div class="col-span-12 xl:col-span-5">
        @include('admin.components.map-01')
    </div>

    <div class="col-span-12 xl:col-span-7">
        @include('admin.components.table.table-01')
    </div>

</div>

@endsection
