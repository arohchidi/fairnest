@extends('layouts.frontend')


@section('content')


<body class="">
  
@include('components.header')

    <div class="breadcumb-wrapper" data-bg-src="assets/img/bg/breadcrumb-bg.jpg">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">FAQS</h1>
                <ul class="breadcumb-menu">
                    <li><a href="index.html">Home</a></li>
                    <li>FAQS</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="th-blog-wrapper blog-details space">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area">
                        <div class="title-area text-left pe-xxl-5">
                            <p class="sub-title text-anime-style-1"><span class="double-line"></span> FAQ</p>
                            <h2 class="sec-title text-anime-style-2">What would you like to know about {{config('app.name')}}?</h2>
                            <p class="sec-text text-anime-style-3">Find answers to the most common questions about our properties, inspection bookings, buying process, and real estate services. We've compiled this information to help make your experience as smooth and straightforward as possible.
</p><a href="{{route('faqs')}}" class="th-btn bg-theme pill">Free
                                Consultation</a>
                        </div>
                        <div class="widget bg-smoke faq">
                            <div class="th-widget-contact">
                                <div class="info-box">
                                    <div class="info-box_icon"><i class="fas fa-phone"></i></div>
                                    <p class="info-box_text"><a href="tel:{{$setting['phone'] ??  "Phone"}}" class="info-box_link">{{$setting['phone'] ??  "Phone"}}</a></p>
                                </div>
                                <div class="info-box">
                                    <div class="info-box_icon"><i class="fas fa-envelope"></i></div>
                                    <p class="info-box_text"><a href="{{$setting['email'] ??  "Email"}}"
                                            class="info-box_link">{{$setting['email'] ??  "E-mail"}}</a></p>
                                </div>
                                <div class="info-box">
                                    <div class="info-box_icon"><i class="fas fa-location-dot"></i></div>
                                    <p class="info-box_text">{{$setting['address'] ??  "Address"}}</p>
                                </div>
                            </div>
                        </div>
                      
                   
                    </aside>
                </div>
                <div class="col-xxl-7 col-lg-7">
                    <div class="th-faq-wrapper">
                        <div class="accordion-1 accordion" id="faqAccordion">
@if(isset($faqs))
                        @foreach($faqs as $faq)
                            <div class="accordion-card active wow fadeinup" data-wow-delay=".1s">
                                <div class="accordion-header" id="collapse-item-1"><button class="accordion-button"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1"
                                        aria-expanded="true" aria-controls="collapse-1"><span class="serial-numb">{{$faq->sort_id ?? "id"}}
                                        </span>{{$faq->question ?? "question"}}?</button></div>
                                <div id="collapse-1" class="accordion-collapse collapse show"
                                    aria-labelledby="collapse-item-1" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p class="faq-text">{!! $faq->answer !! ?? "answer"}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
          @else

<p class="sec-title text-anime-style-2 text-center">No FAQs yet</p>
          @endif                
                            
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="directorist-search-modal__contents__body">
        <div class="directorist-search-modal__input"></div>
        <div class="directorist-search-modal__input"></div>
        <div class="directorist-search-modal__input"></div>
        <div class="directorist-search-modal__input"></div>
    </div>
 
 
  @include('components.footer')

</body>

</html>
@endsection