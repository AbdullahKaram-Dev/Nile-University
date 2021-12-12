@extends('admin.layouts.app')

@section('title')
    {{'update user information'}}
@endsection

@section('meta')

@endsection

@section('styles')
    <link href="{{asset('admin/assets/css/users/account-setting.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing ">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll"
                             data-offset="-100">
                            <div class="row">

                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="update-user-general-info" class="section general-info">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <div class="info">
                                            <h6 class="">{{__('dashboard.update_user_general_information')}}</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="name">{{__('dashboard.user_name')}}</label>
                                                                            <input name="name" type="text" class="form-control mb-4"
                                                                                   id="name" placeholder="{{__('dashboard.user_name')}}"
                                                                                   value="{{$user->name}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="email">{{__('dashboard.user_email')}}</label>
                                                                            <input name="email" type="email" class="form-control mb-4"
                                                                                   id="email" placeholder="{{__('dashboard.user_email')}}"
                                                                                   value="{{$user->email}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group text-center">
                                                                        <button type="submit"
                                                                                class="btn btn-outline-primary btn-rounded mb-4">{{__('dashboard.save')}}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
    @include('admin.scripts.user.update-user-general-info')
@endsection
