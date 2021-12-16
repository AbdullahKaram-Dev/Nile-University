@extends('layouts.app-website')

@section('content')


    <div class="deals-header">
        <div class="container">
            <h2 class="mb-4"><i class="fas fa-caret-left"></i> أحدث الصفقات</h2>
            <p>لوريم ابيسوم (Lorem Ipsum) هو ببساطة نص شكلى</p>
            <div class="deals-search-box mt-5">
                <input type="text" class="form-control" id="search_deal" placeholder="كلمات البحث" name="search_product" autocomplete="off">
            </div>
        </div>
    </div>
    <!-- End Header -->
    <!-- Start deals -->
    <div class="deals deals-p">
        <div class="container">
            @if(!empty($deal[0]))
            <div class="deals-banner d-flex justify-content-between align-items-md-end flex-column flex-md-row">
                <div>
                    <h5>value <span>{{$deal[0]['deal_value']}}</span></h5>
                    <p class="my-2">{{$deal[0]['deal_name']}}</p>
                    <p class="mb-0">{{$deal[0]['deal_description']}}</p>
                </div>
                <div class="mt-4 mt-md-0">
                    <a href="{{route('web.site.show.deal',$deal[0]['id'])}}">تفاصيل</a>
                </div>
            </div>
            @endif
            <div class="deals-boxes">
                <div class="row" id="deals-area">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @include('scripts.website.login-script')
    @include('scripts.website.register-script')
    @include('scripts.website.clean-input-script')
    <script>

        let myInput = document.getElementById('search_deal');
        myInput.addEventListener('keyup', () => {

            let value = $('#search_deal').val();
            $.ajax({
                type : 'get',
                url : '{{route('web.site.search.deals')}}',
                data:{'search':value},
                success:function(data){
                    $('#deals-area').html(data);
                }
            });

        });

    </script>
@endsection
