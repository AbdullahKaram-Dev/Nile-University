@extends('admin.layouts.app')

@section('title')
    {{'startup page'}}
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

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">

                        <table id="startups-datatable" class="table table-striped" style="padding-top:10px;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('dashboard.startup_name')}}</th>
                                <th>{{__('dashboard.startup_logo')}}</th>
                                <th>{{__('dashboard.user_name')}}</th>
                                <th>{{__('dashboard.user_email')}}</th>
                                <th>{{__('dashboard.arabic_city_name')}}</th>
                                <th>{{__('dashboard.english_city_name')}}</th>
                                <th>{{__('dashboard.created_at')}}</th>
                                <th>{{__('dashboard.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>


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
    <script type="text/javascript">
        $(function () {
            let table = $('#startups-datatable').DataTable({
                processing: true,
                serverSide: true,
                cache: false,
                ajax: "{{ LaravelLocalization::localizeUrl('/administration-dashboard/startups') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id', searchable: false},
                    {data: 'startup_name', name: 'startup_name', searchable: true},
                    {data: 'startup_logo', name: 'startup_logo', orderable: false, searchable: false},
                    {data: 'user.name', name: 'user.name', orderable: false, searchable: false},
                    {data: 'user.email', name: 'user.email', orderable: false, searchable: false},
                    {data: 'city.city_name.ar', name: 'city.city_name.ar', orderable: false, searchable: false},
                    {data: 'city.city_name.en', name: 'city.city_name.en', orderable: false, searchable: false},
                    {data: 'created_at', name: 'created_at', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            /* to draw object of datatable and log it */
            /*table.on('draw', function () {
                console.log(table.ajax.json());
            });*/
        });
    </script>
@endsection
