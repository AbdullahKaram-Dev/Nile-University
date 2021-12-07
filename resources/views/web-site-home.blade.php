@extends('layouts.app-website')

@section('content')

<div class="deals">
    <div class="container">
        <div class="deals-head d-flex justify-content-between align-items-center">
            <div class="m-auto">
                <h3 class="d-inline-block">الصفقات <span></span></h3>

            </div>
        </div>
        <div class="deals-boxes">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="deals-box">
                        <div>
                            <img src="{{asset('front/images/products/aws.webp')}}" alt="" srcset="">
                        </div>
                        <div class="w-100">
                            <h5>ما يصل إلى 25 ألف دولار في AWS Web Hosting</h5>
                            <p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم </p>
                            <div class="d-flex justify-content-between">
                                <span>$25,000</span>
                                <a href="#">تفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="deals-box">
                        <div>
                            <img src="{{asset('front/images/products/aws.webp')}}" alt="" srcset="">
                        </div>
                        <div class="w-100">
                            <h5>ما يصل إلى 25 ألف دولار في AWS Web Hosting</h5>
                            <p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم </p>
                            <div class="d-flex justify-content-between">
                                <span>$25,000</span>
                                <a href="#">تفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="deals-box">
                        <div>
                            <img src="{{asset('front/images/products/aws.webp')}}" alt="" srcset="">
                        </div>
                        <div class="w-100">
                            <h5>ما يصل إلى 25 ألف دولار في AWS Web Hosting</h5>
                            <p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم </p>
                            <div class="d-flex justify-content-between">
                                <span>$25,000</span>
                                <a href="#">تفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="deals-box">
                        <div>
                            <img src="{{asset('front/images/products/aws.webp')}}" alt="" srcset="">
                        </div>
                        <div class="w-100">
                            <h5>ما يصل إلى 25 ألف دولار في AWS Web Hosting</h5>
                            <p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم </p>
                            <div class="d-flex justify-content-between">
                                <span>$25,000</span>
                                <a href="#">تفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="deals-box">
                        <div>
                            <img src="{{asset('front/images/products/aws.webp')}}" alt="" srcset="">
                        </div>
                        <div class="w-100">
                            <h5>ما يصل إلى 25 ألف دولار في AWS Web Hosting</h5>
                            <p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم </p>
                            <div class="d-flex justify-content-between">
                                <span>$25,000</span>
                                <a href="#">تفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="deals-box">
                        <div>
                            <img src="{{asset('front/images/products/aws.webp')}}" alt="" srcset="">
                        </div>
                        <div class="w-100">
                            <h5>ما يصل إلى 25 ألف دولار في AWS Web Hosting</h5>
                            <p>لوريم إيبسوم(Lorem Ipsum) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) ويُستخدم </p>
                            <div class="d-flex justify-content-between">
                                <span>$25,000</span>
                                <a href="#">تفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="#">عرض المزيد</a>
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
