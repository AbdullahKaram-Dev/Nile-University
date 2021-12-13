@extends('admin.layouts.app')

@section('title')
    {{'index page'}}
@endsection

@section('meta')

@endsection

@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('admin/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/css/components/custom-counter.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">

                <div class="row layout-top-spacing">

                    <div id="counterIcon" class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header text-center bg-light-primary">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>{{__('dashboard.deals_statistics')}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area text-center">

                                <div class="icon--counter-container">

                                    <div class="counter-container">

                                        <div class="counter-content">
                                            <h1 class="ico-counter2 ico-counter">{{$deals['approval_deals']}}</h1>
                                        </div>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        <p class="ico-counter-text badge badge-success text-white d-block">{{__('dashboard.approvals')}}</p>
                                    </div>

                                    <div class="counter-container">
                                        <div class="counter-content">
                                            <h1 class="ico-counter3 ico-counter">{{$deals['pending_deals']}}</h1>
                                        </div>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                        <p class="ico-counter-text badge badge-warning text-white d-block">{{__('dashboard.pending')}}</p>
                                    </div>

                                    <div class="counter-container">

                                        <div class="counter-content">
                                            <h1 class="ico-counter1 ico-counter">{{$deals['rejected_deals']}}</h1>
                                        </div>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                        <p class="ico-counter-text badge badge-danger text-white d-block">{{__('dashboard.rejected')}}</p>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">

                <div class="row layout-top-spacing">

                    <div id="counterIcon" class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header text-center bg-light-primary">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>{{__('dashboard.startups_statistics')}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area text-center">

                                <div class="icon--counter-container">

                                    <div class="counter-container">

                                        <div class="counter-content">
                                            <h1 class="ico-counter c-counter5 ico-counter">{{$startups['active_startups']}}</h1>
                                        </div>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        <p class="ico-counter-text badge badge-success text-white d-block">{{__('dashboard.active')}}</p>
                                    </div>

                                    <div class="counter-container">
                                        <div class="counter-content">
                                            <h1 class="ico-counter c-counter6 ico-counter">{{$startups['blocked_startups']}}</h1>
                                        </div>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                        <p class="ico-counter-text badge badge-danger text-white d-block">{{__('dashboard.blocked')}}</p>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">

                <div class="row layout-top-spacing">

                    <div id="counterIcon" class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header text-center bg-light-primary">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>{{__('dashboard.users_statistics')}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area text-center">

                                <div class="icon--counter-container">

                                    <div class="counter-container">

                                        <div class="counter-content">
                                            <h1 class="ico-counter c-counter7 ico-counter">{{$users['users_count']}}</h1>
                                        </div>

                                        <p class="ico-counter-text badge badge-success text-white d-block">{{__('dashboard.users')}}</p>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>


        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{asset('admin/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('admin/plugins/counter/jquery.countTo.js')}}"></script>
    <script src="{{asset('admin/assets/js/components/custom-counter.js')}}"></script>
@endsection

