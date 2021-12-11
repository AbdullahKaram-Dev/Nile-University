@extends('admin.layouts.app')

@section('title')
    {{'startup profile and deals'}}
@endsection

@section('meta')

@endsection

@section('styles')
<link href="{{asset('admin/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('admin/assets/css/components/cards/card.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="{{asset('admin/plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/plugins/table/datatable/custom_dt_html5.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/plugins/table/datatable/dt-global_style.css')}}">
@endsection

@section('content')
    <div class="layout-px-spacing">
        <div class="account-settings-container layout-top-spacing">

            <div class="widget-content widget-content-area">
                <div class="card component-card_4 w-auto p-4">
                    <div class="card-body">
                        <div class="user-profile text-center">
                            <img style="border: solid 20px aliceblue;" src="{{asset("storage/startup-avatar/".$startup['startup_logo'])}}" alt="...">
                        </div>
                        <div class="user-info">
                            <div class="badge outline-badge-info d-block text-left p-3">
                                ({{__('dashboard.startup_name')}}) : {{$startup['startup_name']}}
                            </div>
                            <div class="badge outline-badge-info d-block text-left p-3">
                                ({{__('dashboard.owner_name')}}) : {{$startup['user']['name']}}
                            </div>
                            <div class="badge outline-badge-info d-block text-left p-3">
                                ({{__('dashboard.owner_email')}}) : {{$startup['user']['email']}}
                            </div>
                            <div class="card-star_rating">

                            <div class="badge outline-badge-info d-block text-left p-3">
                                ({{__('dashboard.startup_sectors')}}) :
                            </div>
                                @foreach($startup['sectors'] as $sector)
                                <div class="badge outline-badge-info mt-2">
                                    <span class="d-block">{{__('dashboard.english_sector_name')}} : {{$sector['sector_name']['en']}}</span>
                                    <span class="d-block">{{__('dashboard.arabic_sector_name')}} : {{$sector['sector_name']['ar']}}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="widget-content widget-content-area pt-5">
                <div class="col-12 text-center">
                    <button class="btn btn-info btn-lg btn-block">{{__('dashboard.all_startup_deals')}}</button>
                </div>
                    <div class="table-responsive mb-4 mt-4">
                        <table id="deals-datatable" class="table table-striped" style="padding-top:10px;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('dashboard.deal_logo')}}</th>
                                <th>{{__('dashboard.deal_name_en')}}</th>
                                <th>{{__('dashboard.deal_name_ar')}}</th>
                                <th>{{__('dashboard.deal_description_en')}}</th>
                                <th>{{__('dashboard.deal_description_ar')}}</th>
                                <th>{{__('dashboard.deal_value')}}</th>
                                <th>{{__('dashboard.status')}}</th>
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
@endsection

@section('scripts')
    <script src="{{asset('admin/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('admin/plugins/table/datatable/datatables.js')}}"></script>
    <script src="{{asset('admin/plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
    <script src="{{asset('admin/plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
    @include('admin.scripts.deal.update-deal-status')
    @include('admin.scripts.deal.delete-deal')
    <script type="text/javascript">
        $(function () {
            let table = $('#deals-datatable').DataTable({
                processing: true,
                serverSide: true,
                cache: false,
                ajax: "{{ LaravelLocalization::localizeUrl('/administration-dashboard/deals-startup/'.$startup['id']) }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id', searchable: false,orderable: false},
                    {data: 'deal_logo', name: 'deal_logo', orderable: false, searchable: false},
                    {data: 'deal_name_en', name: 'deal_name_en'},
                    {data: 'deal_name_ar', name: 'deal_name_ar'},
                    {data: 'deal_description_en', name: 'deal_description_en'},
                    {data: 'deal_description_ar', name: 'deal_description_ar'},
                    {data: 'deal_value', name: 'deal_value'},
                    {data: 'status', name: 'status', orderable: false, searchable: false},
                    {data: 'created_at', name: 'created_at', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection
