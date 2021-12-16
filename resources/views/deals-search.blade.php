@if(!empty($deals))
@foreach($deals as $deal)
<div class="col-12 mb-4">
    <div class="deals-box d-flex align-items-center flex-column flex-md-row">
        <div>
            <img src="{{asset('storage/deal-avatar/'.$deal['deal_logo'])}}" alt="" srcset="">
        </div>
        <div class="w-100 pe-3">
            <h5>{{$deal['deal_name']}}</h5>
            <p class="mb-0 mt-0">{{$deal['deal_description']}}</p>
        </div>
        <div class="d-flex flex-row flex-md-column align-items-center justify-content-between w-sm-100 mt-4 mt-md-0">
            <span class="mb-0 mb-md-2">{{$deal['deal_value']}}</span>
            <a href="{{route('web.site.show.deal',$deal['id'])}}">تفاصيل</a>
        </div>
    </div>
</div>
@endforeach
@endif
