@extends('admin.layouts.app')

@section('title')
{{'create new sector'}}
@endsection

@section('meta')

@endsection

@section('styles')
<link href="{{asset('admin/assets/css/users/account-setting.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="layout-px-spacing">

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        <form id="sector-info" autocomplete="off" class="section general-info">
                            @csrf
                            <div class="info">
                                <h6 class="">{{__('dashboard.create_new_sector')}}</h6>
                                <div class="row">
                                    <div class="col-lg-11 mx-auto">
                                        <div class="row">
                                            
                                            <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                <div class="form">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="sector_name_ar">{{__('dashboard.sector_arabic_name')}}</label>
                                                                <input required type="text" name="sector_name[ar]" class="form-control mb-4" id="sector_name_ar" placeholder="{{__('dashboard.sector_arabic_name')}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="sector_name_en">{{__('dashboard.sector_english_name')}}</label>
                                                                <input required type="text" name="sector_name[en]" class="form-control mb-4" id="sector_name_en" placeholder="{{__('dashboard.sector_english_name')}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group text-center">
                                                    <button type="submit" class="btn btn-outline-primary btn-rounded mb-4">{{__('dashboard.save_now')}}</button>
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
@include('admin.scripts.sector.create-sector')
@endsection