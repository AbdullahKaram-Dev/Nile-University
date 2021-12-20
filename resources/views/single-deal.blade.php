@extends('layouts.app-website')

@section('title')
    {{"single deal"}}
@endsection

@section('content')


    <div class="deals-header single-deal">
        <div class="container">
            <h4 class="mb-4"><i class="fas fa-caret-left"></i>
                <nav class="d-inline-block mb-0 ms-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">{{$deal['deal_name']}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">استضافة</li>
                    </ol>
                </nav>
            </h4>
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <p class="mb-3 mb-md-0">{{$deal['deal_description']}}</p>
                <span class="price">{{$deal['deal_value']}}</span>
            </div>
        </div>
    </div>
    <!-- End Header -->
    <!-- Start deals -->
    <div class="deals deals-p single-deal-banner">
        <div class="container">
            <a href="https://www.youtube.com/watch?v=oyZcdRA4q5g" class="position-relative d-block w-100 d-flex align-items-center justify-content-center" data-lity>
                <img src="assets/images/banners/what-is-aws.webp" class="w-100" alt="">
                <div class="position-absolute video-icon"><i class="fas fa-play"></i></div>
            </a>
            <a href="#" class="get-deal mt-4">احصل علي الصفقه</a>
            <div class="about-deal">
                <h4>شركه AWS LOGISTICS:</h4>
                <p>• رصيد ترويجي AWS بقيمة 5000 دولار أو 25000 دولار صالح لمدة عامين • دعم أعمال AWS لمدة عام واحد (يصل إلى 5000 دولار أمريكي) هذه الصفقة متاحة فقط لمؤسسي بدء التشغيل الذين يستوفون متطلبات الموافقة. غير صالح للهند. تأكد من أن ملفات التعريف الشخصية والفريق الخاصة بك في F6S مكتملة حتى نتمكن من تأكيد الأهلية• رصيد ترويجي AWS بقيمة 5000 دولار أو 25000 دولار صالح لمدة عامين • دعم أعمال AWS لمدة عام واحد (يصل إلى 5000 دولار أمريكي) هذه الصفقة متاحة فقط لمؤسسي بدء التشغيل الذين يستوفون متطلبات الموافقة. غير صالح للهند. تأكد من أن ملفات التعريف الشخصية والفريق الخاصة بك في F6S مكتملة حتى نتمكن من تأكيد الأهلية• رصيد ترويجي AWS بقيمة 5000 دولار أو 25000 دولار صالح لمدة عامين • دعم أعمال AWS لمدة عام واحد (يصل إلى 5000 دولار أمريكي) هذه الصفقة متاحة فقط لمؤسسي بدء التشغيل الذين يستوفون متطلبات الموافقة. غير صالح للهند. تأكد من لمدة عامين • دعم أعمال AWS لمدة عام واحد (يصل إلى 5000 دولار أمريكي) هذه الصفقة متاحة فقط لمؤسسي بدء التشغيل الذين يستوفون متطلبات الموافقة. غير صالح للهند. تأكد من أن ملفات التعريف الشخصية والفريق الخاصة بك في F6S مكتملة </p>
                <div class="comment-boxes">
                    <div class="d-flex align-items-center mb-3">
                        <img src="assets/images/man.jpg" alt="">
                        <p class="mb-0">من الجيد أن يكون لدى شركة ناشئة شريك سحابي مثل AWS - abraham azuka</p>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <img src="assets/images/man.jpg" alt="">
                        <p class="mb-0">جيد لرجال الأعمال. لا توفر AWS ميزة تقنية رائعة فحسب ، بل توفر أيضًا بنية تحتية قوية لأي شركة ناشئة. - روبرتو روميرو</p>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <img src="assets/images/man.jpg" alt="">
                        <p class="mb-0">سيء جدًا ، حيث لا توجد شفافية حول معايير القبول وستتلقى رسالة تفيد بأنك لا تفي بمعايير القبول. هذه الصفقات مخصصة للتسويق التجاري فقط - إلير غاشي</p>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <img src="assets/images/man.jpg" alt="">
                        <p class="mb-0">سيقطع شوطًا طويلاً للمساعدة في بدء الشركات الناشئة والآخرين إلى المستوى التالي. - نذير محمد</p>
                    </div>
                </div>
            </div>
            <div class="deals-boxes related-deals">
                <div class="deals-head d-flex justify-content-between align-items-center">
                    <h3 class="d-inline-block">صفقات مشابهة <span></span></h3>
                </div>
                <div class="row">
                    @foreach($randomDeals as $randomDeal)
                    <div class="col-12 mb-4">
                        <div class="deals-box d-flex align-items-center flex-column flex-md-row">
                            <div>
                                <img src="{{asset('storage/deal-avatar/'.$randomDeal['deal_logo'])}}" alt="" srcset="">
                            </div>
                            <div class="w-100 pe-3">
                                <h5>{{$randomDeal['startup']['startup_name']}}</h5>
                                <h6>{{$randomDeal['deal_name']}}</h6>
                                <p class="mb-0 mt-0">{{$randomDeal['deal_description']}}</p>
                            </div>
                            <div class="d-flex flex-row flex-md-column align-items-center justify-content-between w-sm-100 mt-4 mt-md-0">
                                <span class="mb-0 mb-md-2">{{$randomDeal['deal_value']}}</span>
                                <a href="{{route('web.site.show.deal',$randomDeal['id'])}}">تفاصيل</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection
