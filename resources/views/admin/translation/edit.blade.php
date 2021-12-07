@extends('admin.layouts.app')

@section('title')
    {{'translation page'}}
@endsection

@section('meta')

@endsection

@section('styles')

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
                                        <h4>{{__('dashboard.translation')}} <span class="badge badge-info">{{request()->segment(4)}}</span> </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <form action="{{route('admin.update.translations',request()->segment(4))}}" method="POST">
                                    @csrf
                                    <div class="form-row mb-3">
                                        @foreach($content as $key => $value)

                                            <div class="form-group col-md-4">
                                                <label for="{{$key}}" style="word-break:break-all !important;"
                                                       class="btn btn-light-default">{{ __('dashboard.key') .': '. str_replace('_',' ',$key)}}</label>
                                                <input name="{{$key}}" value="{{$value}}" type="text"
                                                       class="form-control" id="{{$key}}"
                                                       placeholder="{{__('dashboard.value')}}">
                                            </div>

                                        @endforeach
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <button type="submit"
                                                    class="btn btn-outline-primary btn-rounded mb-4">{{__('dashboard.save')}}</button>
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
@endsection
