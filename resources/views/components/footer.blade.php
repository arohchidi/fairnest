  <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-[#2D6A4F] rounded-lg flex items-center justify-center">
                            <i class="fas fa-building text-white text-sm"></i>
                        </div>
                        <span class="font-bold text-xl">{{ config('app.name') }}</span>
                    </div>
                    <p class="text-gray-400 text-sm">Find your perfect home away from home. Quality properties at competitive prices.</p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('property.listings') }}" class="hover:text-white transition">Browse Properties</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Contact</a></li>
                        <li><a href="{{route('faqs')}}" class="hover:text-white transition">FAQs</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                       
                        <li><a href="{{route('privacy-policy')}}" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="{{route('terms')}}" class="hover:text-white transition">Terms & Condition</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Contact Us</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-envelope w-4"></i>
                            <span>{{$settings['email'] ?? ''}}</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-phone w-4"></i>
                            <span>{{$settings['phone'] ?? ''}}</span>
                        </li>
                    </ul>
                    <div class="flex space-x-4 mt-4">
                        <a href="{{$settings['facebook_url'] ?? ''}}" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{$settings['twitter_url'] ?? ''}}" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                        <a href="{{$settings['instagram_url'] ?? ''}}" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                        <a href="{{$settings['linkedin_url'] ?? ''}}" class="text-gray-400 hover:text-white transition"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
    