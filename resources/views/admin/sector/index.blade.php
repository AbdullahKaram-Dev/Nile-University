@extends('admin.layouts.app')

@section('title')
    {{'Sectors page'}}
@endsection

@section('meta')

@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/plugins/table/datatable/custom_dt_html5.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/plugins/table/datatable/dt-global_style.css')}}">
@endsection

@section('content')


    <div class="layout-px-spacing">

        <div class="row layout-top-spacing ">

            <div class="col-lg-12">
                <a href="{{route('sectors.create')}}"
                   class="btn btn-info btn-rounded mb-4 float-right">{{__('dashboard.create_new_sector')}}</a>
            </div>


            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>


        </div>

    </div>


@endsection

@section('scripts')
    <script src="{{asset('admin/plugins/table/datatable/datatables.js')}}"></script>
    <script src="{{asset('admin/plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
    <script src="{{asset('admin/plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
    {{ $dataTable->scripts() }}
@endsection
