@extends('admin.layouts.app')

@section('title')
    {{'translation page'}}
@endsection

@section('meta')

@endsection

@section('styles')
<link href="{{asset('admin/assets/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')


    <div class="layout-px-spacing">

        <div class="row layout-top-spacing ">


            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

                <div class="row">
                    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>{{__('dashboard.files_translations')}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-4">
                                        <thead>
                                        <tr>
                                            <th>{{__('dashboard.language')}}</th>
                                            <th>{{__('dashboard.language_code')}}</th>
                                            <th class="text-center">{{__('dashboard.Status')}}</th>
                                            <th>{{__('dashboard.Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($languages as $language => $code)
                                        <tr>
                                            <td>{{$language}}</td>
                                            <td>{{$code}}</td>
                                            @if (app()->getLocale() === $code)
                                                <td class="text-center"><span class="badge badge-success">{{__('dashboard.active')}}</span></td>
                                            @else
                                                <td class="text-center"></td>
                                            @endif
                                            <td>
                                            <a href="{{route('admin.edit.translations',$code)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg><span class="icon-name">{{__('dashboard.edit')}}</span>
                                            </a>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                            <td colspan="4" class="text-center">{{__('dashboard.no_data_founded_yet_!')}}</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>
@endsection
