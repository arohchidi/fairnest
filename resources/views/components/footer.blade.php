  <footer class="footer-wrapper footer-default">
        <div class="widget-area">
            <div class="container">
                <div class="footer-all-widget-wrapper">
                    <div class="footer-all-widget-item">
                        <div class="widget footer-widget">
                            <div class="th-widget-about">
                                <div class="about-logo"><a href="index.html"><img src="assets/img/logo-white.svg"
                                            alt="Piller-html"></a></div>
                                <p class="about-text">Pillar is a luxury to the resilience, adaptability, Spacious
                                    modern villa living room with centrally placed swimming pool blending indooroutdoor.
                                </p>
                               <div class="footer-info-wrap">
                                    <div class="footer-info"><i class="fas fa-phone"></i>
                                        <p class="info-box_link"><a href="tel:{{$settings['phone'] ?? 'phone'}}">{{$settings['phone'] ?? 'phone'}}
                                                012</a></p>
                                    </div>
                                    <div class="footer-info"><i class="fas fa-envelope"></i>
                                        <p class="info-box_link"><a
                                                href="mailto:{{$settings['email'] ?? 'email'}}">{{$settings['email'] ?? 'email'}}</a></p>
                                    </div>
                                    <div class="footer-info"><i class="fas fa-location-dot"></i>
                                        <p class="info-box_link"><span>{{$settings['address'] ?? 'address'}}</span></p>
                                    </div>
                                </div>
                            
                           
                            </div>
                        </div>
                    </div>
                    <div class="footer-all-widget-item">
                        <div class="footer-right-wrap">
                            <div class="footer-item-wrap">

<div class="footer-item">
                                    <div class="widget widget_nav_menu footer-widget">
                                        <h3 class="widget_title">Quick Links</h3>
                                        <div class="menu-all-pages-container">
                                            <ul class="menu">
                                                <li><a href="{{route('home')}}">Home</a></li>
                                                <li><a href="{{route('about')}}">About Us</a></li>
                                                <li><a href="{{route('faqs')}}">FAQs</a></li>
                                               
                                            </ul>
                                        </div>
                                    </div>
                                </div>



<div class="footer-item">
                                    <div class="widget widget_nav_menu footer-widget">
                                        <h3 class="widget_title">Support</h3>
                                        <div class="menu-all-pages-container">
                                            <ul class="menu">
                                                <li><a href="{{route('contact')}}">Help Center</a></li>
                                                <li><a href="{{route('faqs')}}">FAQs</a></li>
                                              
                                                <li><a href="#livesupport">Live Chat</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer-item">
                                    <div class="widget widget_nav_menu footer-widget">
                                        <h3 class="widget_title">Legal</h3>
                                        <div class="menu-all-pages-container">
                                            <ul class="menu">
                                                <li><a href="{{route('terms')}}">Terms</a></li>
                                                <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                                               
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="footer-item">
                                    <div class="widget widget_banner footer-widget">
                                        <h3 class="widget_title">Pillar Location</h3>
                                        <div class="widget-map"><iframe
                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3644.7310056272386!2d89.2286059153658!3d24.00527418490799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fe9b97badc6151%3A0x30b048c9fb2129bc!2sAngfuztheme!5e0!3m2!1sen!2sbd!4v1658812932163!5m2!1sen!2sbd"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-right-bottom-wrap">
                                <div class="footer-right-bottom-item">
                                    <div class="footer-right-bottom-item__thumb help"><img
                                            src="assets/img/icon/footer-default-icon-1-1.png" alt="img"></div>
                                    <div class="footer-right-bottom-item__content">
                                        <h4 class="box-title"><a href="{{route('contact')}}">Need Home to rent ?</a></h4>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-wrap">
            <div class="footer-bottom-top-shape animation-infinite"
                data-bg-src="assets/img/icon/footer-bottom-top-shape.png"></div>
            <div class="container">
                <div class="row gy-3 justify-content-lg-between justify-content-center align-items-center">
                    <div class="col-lg-7">
                        <p class="copyright-text">Copyright <i class="fal fa-copyright"></i> 2025 <a
                                href="index.html">Piller</a>. All Rights Reserved.</p>
                    </div>
                    <div class="col-auto">
                        <div class="footer-default-copy-right">
                            <p>Social Media:</p>
                                  <div class="th-social"><a href="{{$settings['facebook'] ?? 'facebook'}}"><i
                                        class="fab fa-facebook-f"></i></a> <a href="{{$settings['twitter'] ?? 'twitter'}}"><i
                                        class="fab fa-twitter"></i></a>  <a href="{{$settings['whatsapp'] ?? 'whatsapp'}}""><i
                                        class="fab fa-whatsapp"></i></a></div>
                        </div>
                    
                        
                        
                        
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
   