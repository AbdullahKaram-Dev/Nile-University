@extends('admin.layouts.app')

@section('title')
    {{'create new user startup'}}
@endsection

@section('meta')

@endsection

@section('styles')
    <link href="{{asset('admin/assets/css/users/account-setting.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css"/>
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
                                    <form id="create-user-startup" class="section general-info">
                                        @csrf
                                        <div class="info">
                                            <h6 class="">{{__('dashboard.create_startup')}}</h6>
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
                                                                                   placeholder="{{__('dashboard.user_email')}}"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="password">{{__('dashboard.user_password')}}</label>
                                                                            <input required autocomplete="off"
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
                                                                            <input required autocomplete="off"
                                                                                   name="password_confirmation"
                                                                                   type="password"
                                                                                   class="form-control mb-4"
                                                                                   id="password_confirmation"
                                                                                   placeholder="{{__('dashboard.confirm_password')}}">
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="startup_name">{{__('dashboard.startup_name')}}</label>
                                                                            <input name="startup_name" type="text"
                                                                                   class="form-control mb-4"
                                                                                   id="startup_name"
                                                                                   placeholder="{{__('dashboard.startup_name')}}"
                                                                            >
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="city_id">{{__('dashboard.select_city')}}</label>
                                                                            <select name="city_id" id="city_id"
                                                                                    class="form-control mb-4">
                                                                                <option selected>{{__('dashboard.select_city')}}</option>
                                                                                @forelse($cities as $city)
                                                                                <option value="{{$city['id']}}">{{$city['city_name']}}</option>
                                                                                @empty

                                                                                @endforelse
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="startup_logo">{{__('dashboard.startup_logo')}}</label>
                                                                            <input name="startup_logo" type="file"
                                                                                   class="form-control mb-4"
                                                                                   id="startup_logo">
                                                                        </div>
                                                                    </div>

                                                                    <div class="widget-content widget-content-area">
                                                                        <h6 class="mb-4">{{__('dashboard.select_sectors')}}</h6>

                                                                    <div class="row">
                                                                        @forelse($sectors as $sector)
                                                                        <div class="n-chk">
                                                                            <label for="{{$sector['id']}}" class="new-control new-checkbox checkbox-outline-primary new-checkbox-text">
                                                                                <input name="sector_ids[]" type="checkbox" value="{{$sector['id']}}" id="{{$sector['id']}}" class="new-control-input">
                                                                                <span class="new-control-indicator"></span><span class="new-chk-content">{{$sector['sector_name']}}</span>
                                                                            </label>
                                                                        </div>
                                                                        @empty

                                                                            <div class="col-12 mx-auto">
                                                                                <div class="alert alert-danger" role="alert">
                                                                                    <a href="{{route('sectors.create')}}" target="_blank">
                                                                                        {{__('dashboard.sorry_no_sectors_founded_you_must_create_at_least_one_before_creating_startup_click_here_to_add_sector')}}
                                                                                    </a>
                                                                                </div>
                                                                            </div>

                                                                        @endforelse

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
    <script src="{{asset('admin/assets/js/scrollspyNav.js')}}"></script>
    @include('admin.scripts.startup.create-user-startup')
@endsection
