@extends('admin.layouts.app')

@section('title')
    {{'user page'}}
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

                        <table id="users-datatable" class="table table-striped" style="padding-top:10px;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('dashboard.user_name')}}</th>
                                <th>{{__('dashboard.user_email')}}</th>
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
@include('admin.scripts.user.delete-user-profile')
<script type="text/javascript">
    $(function () {
        let table = $('#users-datatable').DataTable({
            processing: true,
            serverSide: true,
            cache:false,
            ajax: "{{ LaravelLocalization::localizeUrl('/administration-dashboard/users') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {
                    data: 'action', name: 'action', orderable: false, searchable: false
                },
            ]
        });
    });
</script>
@endsection
