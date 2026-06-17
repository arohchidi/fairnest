@extends('layouts.frontend')


@section('content')


<body class="">
  
@include('components.header')

    <div class="breadcumb-wrapper" data-bg-src="assets/img/blog/breadcrumb-bg.jpg">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Contact Us</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
    </div>
  
  <div class="contact-area-2 space-top" id="contact-sec">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-xl-4 col-lg-6 contact-feature-wrap">
                    <div class="contact-feature">
                        <div class="contact-feature-icon"><i class="fas fa-location-dot"></i></div>
                        <div class="media-body">
                            <p class="contact-feature_label">Mosque Address</p><a href="https://www.google.com/maps"
                                class="contact-feature_link">{{$settings['address'] ?? "Address"}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 contact-feature-wrap">
                    <div class="contact-feature">
                        <div class="contact-feature-icon"><i class="fas fa-phone"></i></div>
                        <div class="media-body">
                            <p class="contact-feature_label">Phone Number</p><a href="tel:{{$settings['phone'] ?? "Phone"}}"
                                class="contact-feature_link">+011 (123) 234 567 890</a> 
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 contact-feature-wrap">
                    <div class="contact-feature">
                        <div class="contact-feature-icon"><i class="fas fa-envelope"></i></div>
                        <div class="media-body">
                            <p class="contact-feature_label">Email Address</p><a href="mailto:{{$settings['email'] ?? 'E-mail'}}"
                                class="contact-feature_link">{{$settings['email'] ?? 'E-mail'}}</a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-form-area">
        <div class="container">
            <div class="row gx-0">
                <div class="col-xl-12">
                    <div class="contact-all-wrapper">
                        <div class="contact-form-wrap">
                            <form action="{{route('store.feedback')}}" method="POST"
                                class="contact-form ">
                                @csrf
                                <h3 class="form-title text-anime-style-2">Do you have questions? Contact Us</h3>
                                <div class="row">
                                    <div class="form-group col-md-6"><input type="text" class="form-control" name="name"
                                            id="name" placeholder="Name *" value="{{old('name')}}"></div>
                                    <div class="form-group col-md-6"><input type="tel" class="form-control"
                                            name="phone" id="number" placeholder="Phone *" value="{{old('phone')}}"></div>
                                    <div class="form-group col-md-12"><input type="email" class="form-control"
                                            name="email" id="email" placeholder="Email Address *" value="{{old('email')}}"></div>
                                             <div class="form-group col-md-12">
                                              <select name="feedback_type" class="form-control" required>
                                              <option value="">Choose type of feedback</option>
                                              <option value="waitlist">Wait List</option>
                                              <option value="fraud">Fraudlent Activity</option>
                                              <option value="enquiry">Enquiry</option>
                                              <option value="compalin">Complain</option>
                                              <option value="others">Others</option>
                                               </select>
                                             
                                             </div>
                                    <div class="form-group col-md-12">
                                    <input type="text" class="form-control"
                                            name="subject" id="subject" placeholder="Subject *" value="{{old('subject')}}">
                                    </div>
                                    <div class="form-group col-12"><textarea name="message" id="message"
                                            cols="30" rows="3" class="form-control"
                                            placeholder="Your Message *">{{old('message')}}</textarea></div>
                                    <div class="form-btn text-start col-12"><button class="th-btn radius" type="submit">Send
                                            message</button></div>
                                </div>
                                <p class="form-messages mb-0 mt-3"></p>
                            </form>
                        </div>
                        <div class="contact-form-thumb overflow-hidden"><img
                                src="assets/img/contact/contact-page-thumb.jpg" alt="img"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="space-top">
        <div class="container-fluid p-0">
            <div class="contact-map"><iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3644.7310056272386!2d89.2286059153658!3d24.00527418490799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fe9b97badc6151%3A0x30b048c9fb2129bc!2sAngfuztheme!5e0!3m2!1sen!2sbd!4v1651028958211!5m2!1sen!2sbd"
                    allowfullscreen="" loading="lazy"></iframe>
                <div class="contact-icon"><img src="assets/img/icon/con-location-dot.svg" alt="img"></div>
            </div>
        </div>
    </div>
   


  @include('components.footer')

</body>

</html>
@endsection