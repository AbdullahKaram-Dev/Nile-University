@extends('layouts.app-dashboard')

@section('title')
    {{'update account information'}}
@endsection

@section('meta')

@endsection

@section('styles')
    <link href="{{asset('user/assets/css/users/account-setting.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('user/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('user/assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css"/>
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
                                    <form id="edit-user-info" class="section general-info">
                                        @csrf
                                        <div class="info">
                                            <h6 class="">{{__('dashboard.update_user_information')}}</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="name">{{__('dashboard.user_name')}}</label>
                                                                            <input name="name" type="text"
                                                                                   class="form-control mb-4"
                                                                                   id="name"
                                                                                   value="{{$user->name}}"
                                                                                   placeholder="{{__('dashboard.user_name')}}"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="email">{{__('dashboard.user_email')}}</label>
                                                                            <input name="email" type="email"
                                                                                   class="form-control mb-4"
                                                                                   id="email"
                                                                                   value="{{$user->email}}"
                                                                                   placeholder="{{__('dashboard.user_email')}}"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="password">{{__('dashboard.user_password')}}</label>
                                                                            <input autocomplete="off"
                                                                                   name="password"
                                                                                   type="password"
                                                                                   class="form-control mb-4"
                                                                                   id="password"
                                                                                   placeholder="{{__('dashboard.user_password')}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="password_confirmation">{{__('dashboard.confirm_password')}}</label>
                                                                            <input autocomplete="off"
                                                                                   name="password_confirmation"
                                                                                   type="password"
                                                                                   class="form-control mb-4"
                                                                                   id="password_confirmation"
                                                                                   placeholder="{{__('dashboard.confirm_password')}}">
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
<script src="{{asset('user/assets/js/scrollspyNav.js')}}"></script>
@include('user.scripts.account.update-user-info')
@endsection
