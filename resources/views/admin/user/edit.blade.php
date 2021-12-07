@extends('admin.layouts.app')

@section('title')
    {{'user edit profile page'}}
@endsection

@section('meta')

@endsection

@section('styles')
    <link href="{{asset('admin/assets/css/users/account-setting.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <div class="layout-px-spacing">

        <div class="account-settings-container layout-top-spacing">

            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll"
                     data-offset="-100">
                    <div class="row">

                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form id="contact" class="section contact">
                                @csrf
                                <input required name="user_id" type="hidden" value="{{$user->id}}">
                                <div class="info">
                                    <h5 class="">{{__('dashboard.update_user_password')}}</h5>
                                    <div class="row">
                                        <div class="col-md-11 mx-auto">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password">{{__('dashboard.new_password')}}</label>
                                                        <input required autocomplete="off" name="password"
                                                               type="password" class="form-control mb-4" id="password"
                                                               placeholder="{{__('dashboard.new_password')}}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="password_confirmation">{{__('dashboard.confirm_password')}}</label>
                                                        <input required autocomplete="off" name="password_confirmation"
                                                               type="password" class="form-control mb-4"
                                                               id="password_confirmation"
                                                               placeholder="{{__('dashboard.confirm_password')}}">
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
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('scripts')
    @include('admin.scripts.user.update-user-profile')
@endsection
