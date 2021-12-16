@extends('layouts.app-website')

@section('content')

    <x-header-component></x-header-component>
    <x-banner-component></x-banner-component>
    <x-about-us></x-about-us>

    <div class="deals">
    <div class="container">
        <div class="deals-head d-flex justify-content-between align-items-center">
            <div class="m-auto">
                <h3 class="d-inline-block">الصفقات <span></span></h3>

            </div>
        </div>
        <div class="deals-boxes">
            <div class="row">
                @forelse($deals as $startup)
                @if(!empty($startup['deals']))
                <div class="col-lg-6 mb-4">
                    <div class="deals-box">
                        <div>
                            <img src="{{asset('storage/deal-avatar/'.$startup['deals'][0]['deal_logo'])}}" alt="" srcset="">
                        </div>
                        <div class="w-100">
                            <h5>{{$startup['deals'][0]['deal_name']}}</h5>
                            <p>{{$startup['deals'][0]['deal_description']}}</p>
                            <div class="d-flex justify-content-between">
                                <span>{{$startup['deals'][0]['deal_value']}}</span>
                                <a href="{{route('web.site.show.deal',$startup['deals'][0]['id'])}}">تفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @empty

                @endforelse
            </div>
            <div class="text-center mt-5">
                <a href="{{route('web.site.deals')}}">عرض المزيد</a>
            </div>
        </div>
    </div>
</div>




@endsection

@section('scripts')
@include('scripts.website.login-script')
@include('scripts.website.register-script')
@include('scripts.website.clean-input-script')
@endsection
