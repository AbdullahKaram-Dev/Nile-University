@extends('layouts.app-dashboard')

@section('title')
    {{'edit deal'}}
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
                                    <form id="edit-deal" class="section general-info">
                                        <input type="hidden" name="deal_id" value="{{$deal['id']}}">
                                        @csrf
                                        <div class="info">
                                            <h6 class="">{{__('dashboard.edit_deal')}}</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="deal_name_en">{{__('dashboard.deal_name_en')}}</label>
                                                                            <input type="text"
                                                                                   class="form-control mb-4"
                                                                                   id="deal_name_en"
                                                                                   value="{{$deal['deal_name']['en']}}"
                                                                                   name="deal_name[en]"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="deal_name_ar">{{__('dashboard.deal_name_ar')}}</label>
                                                                            <input type="text"
                                                                                   class="form-control mb-4"
                                                                                   id="deal_name_ar"
                                                                                   value="{{$deal['deal_name']['ar']}}"
                                                                                   name="deal_name[ar]"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="deal_description_en">{{__('dashboard.deal_description_en')}}</label>
                                                                            <textarea rows="5" type="text" class="form-control mb-4" id="deal_description_en" name="deal_description[en]">{{$deal['deal_description']['en']}}</textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="deal_description_ar">{{__('dashboard.deal_description_ar')}}</label>
                                                                            <textarea rows="5" type="text" class="form-control mb-4" id="deal_description_ar" name="deal_description[ar]">{{$deal['deal_description']['ar']}}</textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="deal_value">{{__('dashboard.deal_value')}}</label>
                                                                            <input name="deal_value" type="text"
                                                                                   class="form-control mb-4"
                                                                                   id="deal_value"
                                                                                   placeholder="{{__('dashboard.deal_value')}}"
                                                                                   value="{{$deal['deal_value']}}"
                                                                            >
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="deal_logo">{{__('dashboard.deal_logo')}}</label>
                                                                            <input name="deal_logo" type="file"
                                                                                   class="form-control mb-4"
                                                                                   id="deal_logo">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-3">
                                                                        <div class="form-group">
                                                                            <label>{{__('dashboard.deal_logo')}}</label>
                                                                            <img src="{{asset('storage/deal-avatar/'.$deal['deal_logo'])}}" class="img-fluid border-dashed" alt="avatar">
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
@include('user.scripts.deal.edit-deal')
@endsection
