@extends('layouts.frontend')


@section('content')


<body class="">
  
@include('components.header')

    <div class="breadcumb-wrapper" data-bg-src="{{Storage::url($property->images[0])}}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Properties</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li>Properties</li>
                </ul>
            </div>
        </div>
    </div>
  

  <section class="property-details space overflow-hidden">
        <div class="container">
            <div class="row gy-40 gx-50">
                <div class="col-xxl-8 col-lg-7">
                    <div class="row gy-30">
                        <div class="slider-area property-slider1">
                            <div class="swiper th-slider panoramaSlide2 mb-4" id="panoramaSlide2"
                                data-slider-options='{"autoplay":false,"effect":"fade","loop":true, "simulateTouch": false,"thumbs":{"swiper":".property-thumb-slider"},"autoplayDisableOnInteraction":"true"}'>
                               
@php
    $firstImage = $property->images[0] ?? null;
    $otherImages = array_slice($property->images ?? [], 1);
@endphp



   

                              
                                <div class="swiper-wrapper">
                                  
                                    <div class="swiper-slide">
                                        <div class="property-slider-img propery-single-slides" id="panorama1i">
                                        @if($firstImage)
    


                                        <img src="{{ asset('storage/' . $firstImage) }}" alt="img">

                                          @endif      
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="property-slider-img propery-single-slides" id="panorama2">
                                        
                                        </div>
                                    </div>
                                    
                                   
                                </div>
                         

                            </div>
                            <div class="swiper th-slider property-thumb-slider slider-tab"
                                data-slider-options='{"effect":"slide","loop":true, "simulateTouch": true,"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}},"autoplayDisableOnInteraction":"true"}'>
                                <div class="swiper-wrapper">
                                   

                                    @foreach($otherImages as $image)
                                        
                                    <div class="swiper-slide" data-bg-src="">
                                        <div class="tab-btn property-slider-img">
                                        <img src="{{ asset('storage/' . $image) }}" alt="{{$property->title}}">
                                     
                                                
                                                </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div><button data-slider-prev="#panoramaSlide2" class="slider-arrow slider-prev"><i
                                    class="far fa-arrow-left"></i></button> <button data-slider-next="#panoramaSlide2"
                                class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>
                        </div>
                        <div class="property-page-single">
                            <div class="page-content">
                                <div class="property-meta-wrap mb-55 fadeinup wow">
                                    <div class="property-meta"><a class="property-tag" href="{{route('book.inspection', $property)}}">Book</a> <a
                                            href="{{route('book.inspection', $property)}}"><i class="fa-solid fa-calendar-days"></i> {{$property->created_at->diffForHumans() }}</a>
                                        </div>
                                    <div class="wishlist-icon"><a href="" class="icon-btn"><i
                                                class="fa-solid fa-heart"></i></a></div>
                                </div>
                                <div class="page-title-wrap fadeinup wow">
                                    <h2 class="page-title mb-2">About This Property</h2>
                                    <h4 class="page-title">{{App\Helper::formatNaira(number_format($property->rent_fee))}}</h4>
                                </div>
                                <div class="page-features fadeinup wow">
                                    <div class="box-text">
                                        <div class="icon"><img src="{{asset('assets/img/icon/popular-location.svg')}}" alt="icon">
                                        </div>{{$property->address}},{{$property->city}},{{$property->country}}
                                    </div>
                                    <ul class="property-featured">
                                        <li>
                                            <div class="icon"><img src="{{asset('assets/img/icon/bed.svg')}}" alt="icon"></div>Bed {{number_format($property->number_of_bedrooms)}}
                                        </li>
                                        <li>
                                            <div class="icon"><img src="{{asset('assets/img/icon/bath.svg')}}" alt="icon"></div>Bath
                                             {{number_format($property->number_of_bathrooms)}}
                                        </li>
                                        <li>
                                            <div class="icon"><img src="{{asset('assets/img/icon/sqft.svg')}}" alt="icon"></div>N/A
                                        </li>
                                    </ul>
                                </div>
                                <p class="mb-30 fadeinup wow">{{$property->description}}</p>
                               
                                <div class="hightlighes-title-wrap mb-25 fadeinup wow">
                                    <h2 class="page-title mb-2">Property Hightlights</h2>
                                    <h5 class="house-sell">House for rent</h5>
                                </div>
                                <ul class="property-grid-list fadeinup wow">
                                    <li>
                                        <div class="property-grid-list-icon"><img
                                                src="https://img.icons8.com/?size=100&id=BKEPOJM7m0xn&format=png&color=000000" alt="img"></div>
                                        <div class="property-grid-list-details">
                                            <h4 class="property-grid-list-title">ID NO.</h4>
                                            <p class="property-grid-list-text">#{{$property->id}}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="property-grid-list-icon"><img
                                                src="https://img.icons8.com/?size=100&id=abOVqqiMik6F&format=png&color=000000" alt="img"></div>
                                        <div class="property-grid-list-details">
                                            <h4 class="property-grid-list-title">Type</h4>
                                            <p class="property-grid-list-text">Residencial</p>
                                        </div>
                                    </li>
                                   
                                    <li>
                                        <div class="property-grid-list-icon"><img
                                                src="https://img.icons8.com/?size=100&id=pJhRIPh4BoRE&format=png&color=000000" alt="img"></div>
                                        <div class="property-grid-list-details">
                                            <h4 class="property-grid-list-title">Bedroom</h4>
                                            <p class="property-grid-list-text">{{$property->number_of_bedrooms}}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="property-grid-list-icon"><img
                                                src="https://img.icons8.com/?size=100&id=ScnZMMzLgN5p&format=png&color=000000" alt="img"></div>
                                        <div class="property-grid-list-details">
                                            <h4 class="property-grid-list-title">Bath</h4>
                                            <p class="property-grid-list-text">{{$property->number_of_bathrooms}}</p>
                                        </div>
                                    </li>
                                    
                                    <li>
                                        <div class="property-grid-list-icon"><img
                                                src="https://img.icons8.com/?size=100&id=tNcJ7GGjHsUq&format=png&color=000000" alt="img"></div>
                                        <div class="property-grid-list-details">
                                            <h4 class="property-grid-list-title">Purpose</h4>
                                            <p class="property-grid-list-text">For Rent</p>
                                        </div>
                                    </li>
                                   
                                    
                                    <li>
                                        <div class="property-grid-list-icon"><img width="94" height="94" src="https://img.icons8.com/3d-fluency/94/armchair.png" alt="armchair"/></div>
                                        <div class="property-grid-list-details">
                                            <h4 class="property-grid-list-title">Furnished</h4>
                                            <p class="property-grid-list-text">@if($property->is_furnished == true) Yes @else No @endif</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="property-grid-list-icon"><img width="64" height="64" src="https://img.icons8.com/?size=100&id=RTM6m9ZxX9gM&format=png&color=000000" alt="external-roommate-university-flaticons-flat-flat-icons"/></div>
                                        <div class="property-grid-list-details">
                                            <h4 class="property-grid-list-title">Roommate</h4>
                                            <p class="property-grid-list-text">@if($property->roommate_preferences == true) Yes @else No @endif</p>
                                        </div>
                                    </li>
                                    
                                </ul>
                                <h3 class="page-title mt-50 mb-30 fadeinup wow">{{ucfirst($property->title)}}'s' Amazing Gallery</h3>
                                <div class="row gy-4 fadeinup wow">

                                 @foreach($otherImages as $image)
                                    <div class="col-xl-4">
                                        <div class="property-gallery-card">
                                            <div class="property-gallery-card-img"><img class="w-100"
                                                    src="{{ asset('storage/' . $image) }}" alt="{{$property->title}}"
                                                    alt="img"></div><a class="icon-btn popup-image"
                                                href="{{ asset('storage/' . $image) }}" alt="{{$property->title}}"><i
                                                    class="fa-solid fa-eye"></i></a>
                                        </div>
                                    </div>
                                   @endforeach
                               
                               
                                </div>
                                <h3 class="page-title mt-50 mb-25 fadeinup wow">Features & amenities</h3>

                                <div class="fea-anim-checklist fadeinup wow">
                                 @if($property->meta_data && count($property->meta_data) > 0)
                                    <div class="checklist style2 list-six-column">
                                    @foreach($property->meta_data as $amenities)
                                        
                                          <span class="amenity-item">
        <i class="fa fa-check-square"></i>
        <span>{{ (strtolower(str_replace('_', ' ', $amenities))) }}</span>
    </span>
                                       
                                   @endforeach
                                    </div>
                                @endif
                                </div>
                     
                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area">
                        
                        <div class="widget">
                            <h3 class="widget_title">Similar Listings</h3>
                            <div class="recent-post-wrap featured-listing">
          @if($similarProperties->count())
                            
                            @foreach($similarProperties as $similarProperty)
                                <div class="recent-post">
                                    <div class="media-img"><a href="{{route('property.details', $similarProperty->id)}}"><img
                                                src="{{asset('assets/img/blog/featured-listing-sidebar-1-1.jpg')}}" alt="Image"></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="post-title"><a class="text-inherit"
                                                href="{{route('property.details', $similarProperty->id)}}">{{ucfirst($similarProperty->title)}}</a></h4>
                                        <div class="property-features-wrap">
                                            <div class="property-features-item">
                                                <div class="thumb"><img src="{{asset('assets/img/icon/bed.svg')}}" alt="icon"></div>
                                                <h5 class="feature-title">Bed {{$similarProperty->number_of_bedrooms}}</h5>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="property-features-item">
                                                <div class="thumb"><img src="{{asset('assets/img/icon/bath.svg')}}" alt="icon"></div>
                                                <h5 class="feature-title">Bath {{$similarProperty->number_of_bathrooms}}</h5>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="property-features-item">
                                                <div class="thumb"><img src="{{asset('assets/img/icon/sqft.svg')}}" alt="icon"></div>
                                                <h5 class="feature-title">N/A</h5>
                                            </div>
                                        </div>
                                        <div class="recent-post-meta"><a href="{{route('property.details', $similarProperty->id)}}" target="_blank">{{$similarProperty->rent_fee}}</a></div>
                                    </div>
                                </div>
@endforeach

@else

<p>No similar property

@endif
                           
                           
                            </div>
                        </div>
                    @include('components.contact-cta')
                  
                    </aside>
                </div>
            </div>
        </div>
    </section>
   


  @include('components.footer')

</body>

</html>
@endsection