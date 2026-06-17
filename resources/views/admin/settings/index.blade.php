@extends('admin.layouts.app')

@section('title', 'Settings')
@section('header-title', 'System Settings')
@section('header-description', 'Configure and manage your platform settings')

@section('content')
<div class="space-y-6">
    
    <!-- Settings Tabs -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="border-b border-gray-200">
            <nav class="flex overflow-x-auto">
                <button type="button" onclick="switchTab('general')" id="tab-general" 
                        class="px-5 py-3 text-sm font-medium border-b-2 transition whitespace-nowrap border-[#2D6A4F] text-[#2D6A4F]">
                    <i class="fas fa-cog mr-2"></i>General
                </button>
                <button type="button" onclick="switchTab('social')" id="tab-social" 
                        class="px-5 py-3 text-sm font-medium border-b-2 transition whitespace-nowrap border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="fas fa-share-alt mr-2"></i>Social Media
                </button>
                <button type="button" onclick="switchTab('seo')" id="tab-seo" 
                        class="px-5 py-3 text-sm font-medium border-b-2 transition whitespace-nowrap border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="fas fa-search mr-2"></i>SEO
                </button>
                <button type="button" onclick="switchTab('security')" id="tab-security" 
                        class="px-5 py-3 text-sm font-medium border-b-2 transition whitespace-nowrap border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="fas fa-shield-alt mr-2"></i>Security
                </button>
                <button type="button" onclick="switchTab('email')" id="tab-email" 
                        class="px-5 py-3 text-sm font-medium border-b-2 transition whitespace-nowrap border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="fas fa-envelope mr-2"></i>Email Templates
                </button>
                <button type="button" onclick="switchTab('maintenance')" id="tab-maintenance" 
                        class="px-5 py-3 text-sm font-medium border-b-2 transition whitespace-nowrap border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="fas fa-tools mr-2"></i>Maintenance
                </button>
            </nav>
        </div>
        
        <div class="p-6">
            
            <!-- ==================== GENERAL TAB ==================== -->
            <div id="panel-general" class="settings-panel">
                <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="tab" value="general">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Site Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? config('app.name')) }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Site Tagline
                            </label>
                            <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? 'Find your perfect home') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Default Currency <span class="text-red-500">*</span>
                            </label>
                            <select name="currency" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                                <option value="USD" {{ old('currency', $settings['currency'] ?? 'USD') == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                                <option value="EUR" {{ old('currency', $settings['currency'] ?? 'USD') == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                                <option value="GBP" {{ old('currency', $settings['currency'] ?? 'USD') == 'GBP' ? 'selected' : '' }}>GBP - British Pound</option>
                                <option value="CAD" {{ old('currency', $settings['currency'] ?? 'USD') == 'CAD' ? 'selected' : '' }}>CAD - Canadian Dollar</option>
                                <option value="NGN" {{ old('currency', $settings['currency'] ?? 'USD') == 'NGN' ? 'selected' : '' }}>NGN - Nigerian Naira</option>
                                <option value="KES" {{ old('currency', $settings['currency'] ?? 'USD') == 'KES' ? 'selected' : '' }}>KES - Kenyan Shilling</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Default Language
                            </label>
                            <select name="locale" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                                <option value="en" {{ old('locale', $settings['locale'] ?? 'en') == 'en' ? 'selected' : '' }}>English</option>
                                <option value="fr" {{ old('locale', $settings['locale'] ?? 'en') == 'fr' ? 'selected' : '' }}>French</option>
                                <option value="es" {{ old('locale', $settings['locale'] ?? 'en') == 'es' ? 'selected' : '' }}>Spanish</option>
                                <option value="de" {{ old('locale', $settings['locale'] ?? 'en') == 'de' ? 'selected' : '' }}>German</option>
                                <option value="pt" {{ old('locale', $settings['locale'] ?? 'en') == 'pt' ? 'selected' : '' }}>Portuguese</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Site Timezone
                            </label>
                            <select name="timezone" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                                <option value="UTC" {{ old('timezone', $settings['timezone'] ?? 'UTC') == 'UTC' ? 'selected' : '' }}>UTC</option>
                                <option value="America/New_York" {{ old('timezone', $settings['timezone'] ?? 'UTC') == 'America/New_York' ? 'selected' : '' }}>New York</option>
                                <option value="America/Chicago" {{ old('timezone', $settings['timezone'] ?? 'UTC') == 'America/Chicago' ? 'selected' : '' }}>Chicago</option>
                                <option value="America/Los_Angeles" {{ old('timezone', $settings['timezone'] ?? 'UTC') == 'America/Los_Angeles' ? 'selected' : '' }}>Los Angeles</option>
                                <option value="Europe/London" {{ old('timezone', $settings['timezone'] ?? 'UTC') == 'Europe/London' ? 'selected' : '' }}>London</option>
                                <option value="Europe/Paris" {{ old('timezone', $settings['timezone'] ?? 'UTC') == 'Europe/Paris' ? 'selected' : '' }}>Paris</option>
                                <option value="Africa/Lagos" {{ old('timezone', $settings['timezone'] ?? 'UTC') == 'Africa/Lagos' ? 'selected' : '' }}>Lagos</option>
                                <option value="Africa/Nairobi" {{ old('timezone', $settings['timezone'] ?? 'UTC') == 'Africa/Nairobi' ? 'selected' : '' }}>Nairobi</option>
                                <option value="Asia/Dubai" {{ old('timezone', $settings['timezone'] ?? 'UTC') == 'Asia/Dubai' ? 'selected' : '' }}>Dubai</option>
                                <option value="Asia/Singapore" {{ old('timezone', $settings['timezone'] ?? 'UTC') == 'Asia/Singapore' ? 'selected' : '' }}>Singapore</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Contact Email
                            </label>
                            <input type="email" name="email" value="{{ old('email', $settings['email'] ?? config('mail.from.address')) }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                        </div>

<div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                               Year
                            </label>
                            <input type="text" name="year" value="{{ old('year', $settings['year'] ?? '2026') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                          </div>
                          <div>
                             <label class="block text-sm font-medium text-gray-700 mb-2">
                              Address
                            </label>
                            <input type="text" name="address" value="{{ old('address', $settings['address'] ?? '') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                       
                       
                        </div>

                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-[#2D6A4F] hover:bg-[#1B4D3E] text-white rounded-lg transition shadow-md">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- ==================== SOCIAL MEDIA TAB ==================== -->
            <div id="panel-social" class="settings-panel hidden">
                <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="tab" value="social">
                    
                    <div class="space-y-4">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-3"></i>
                                <p class="text-sm text-blue-800">Enter your social media profile URLs. These will appear in the website footer and contact sections.</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-facebook text-blue-600 mr-2"></i>Facebook
                                </label>
                                <input type="url" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                       placeholder="https://facebook.com/yourpage">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-twitter text-blue-400 mr-2"></i>Twitter / X
                                </label>
                                <input type="url" name="twitter_url" value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                       placeholder="https://twitter.com/yourprofile">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-instagram text-pink-600 mr-2"></i>Instagram
                                </label>
                                <input type="url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                       placeholder="https://instagram.com/yourprofile">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-linkedin text-blue-700 mr-2"></i>LinkedIn
                                </label>
                                <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                       placeholder="https://linkedin.com/company/yourcompany">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-youtube text-red-600 mr-2"></i>YouTube
                                </label>
                                <input type="url" name="youtube_url" value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                       placeholder="https://youtube.com/yourchannel">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-tiktok text-black mr-2"></i>TikTok
                                </label>
                                <input type="url" name="tiktok_url" value="{{ old('tiktok_url', $settings['tiktok_url'] ?? '') }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                       placeholder="https://tiktok.com/@yourprofile">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-pinterest text-red-500 mr-2"></i>Pinterest
                                </label>
                                <input type="url" name="pinterest_url" value="{{ old('pinterest_url', $settings['pinterest_url'] ?? '') }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                       placeholder="https://pinterest.com/yourprofile">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fab fa-whatsapp text-green-500 mr-2"></i>WhatsApp
                                </label>
                                <input type="url" name="whatsapp_url" value="{{ old('whatsapp_url', $settings['whatsapp_url'] ?? '') }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                       placeholder="https://wa.me/1234567890">
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-[#2D6A4F] hover:bg-[#1B4D3E] text-white rounded-lg transition shadow-md">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- ==================== SEO TAB ==================== -->
            <div id="panel-seo" class="settings-panel hidden">
                <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="tab" value="seo">
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Title
                            </label>
                            <input type="text" name="meta_title" value="{{ old('meta_title', $settings['meta_title'] ?? config('app.name')) }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                            <div class="flex justify-between mt-1">
                                <p class="text-xs text-gray-500">Recommended length: 50-60 characters</p>
                                <span class="text-xs text-gray-400" id="metaTitleCount">0</span>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Description
                            </label>
                            <textarea name="meta_description" rows="3" 
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">{{ old('meta_description', $settings['meta_description'] ?? 'Find the perfect rental property for your next stay') }}</textarea>
                            <div class="flex justify-between mt-1">
                                <p class="text-xs text-gray-500">Recommended length: 150-160 characters</p>
                                <span class="text-xs text-gray-400" id="metaDescCount">0</span>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Keywords
                            </label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $settings['meta_keywords'] ?? 'rental, apartments, property, booking') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                            <p class="text-xs text-gray-500 mt-1">Separate keywords with commas</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Google Analytics ID
                            </label>
                            <input type="text" name="ga_id" value="{{ old('ga_id', $settings['ga_id'] ?? '') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                   placeholder="UA-XXXXX-X or G-XXXXXXX">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Google Site Verification
                            </label>
                            <input type="text" name="google_verification" value="{{ old('google_verification', $settings['google_verification'] ?? '') }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                   placeholder="Google Site Verification Code">
                        </div>
                        
                        <div class="flex items-center justify-between py-3 border-y border-gray-100">
                            <div>
                                <label class="font-medium text-gray-800">Search Engine Indexing</label>
                                <p class="text-sm text-gray-500">Allow search engines to index your site</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="search_engine_indexing" value="1" 
                                       class="sr-only peer"
                                       {{ old('search_engine_indexing', $settings['search_engine_indexing'] ?? true) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-[#2D6A4F] after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-[#2D6A4F] hover:bg-[#1B4D3E] text-white rounded-lg transition shadow-md">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- ==================== SECURITY TAB ==================== -->
            <div id="panel-security" class="settings-panel hidden">
                <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="tab" value="security">
                    
                    <div class="space-y-4">
                        <!-- 2FA -->
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div>
                                <label class="font-medium text-gray-800">Two-Factor Authentication</label>
                                <p class="text-sm text-gray-500">Require 2FA for all admin users</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="two_factor_enabled" value="1" 
                                       class="sr-only peer"
                                       {{ old('two_factor_enabled', $settings['two_factor_enabled'] ?? false) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-[#2D6A4F] after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        
                        <!-- IP Whitelisting -->
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div>
                                <label class="font-medium text-gray-800">IP Whitelisting</label>
                                <p class="text-sm text-gray-500">Restrict admin access to specific IP addresses</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="ip_whitelist_enabled" value="1" 
                                       class="sr-only peer"
                                       {{ old('ip_whitelist_enabled', $settings['ip_whitelist_enabled'] ?? false) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-[#2D6A4F] after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </div>
                        
                        <!-- IP Whitelist Input (conditional) -->
                        <div id="ipWhitelistInput" class="{{ old('ip_whitelist_enabled', $settings['ip_whitelist_enabled'] ?? false) ? '' : 'hidden' }}">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Allowed IP Addresses
                            </label>
                            <textarea name="whitelisted_ips" rows="3" 
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                      placeholder="Enter one IP per line&#10;192.168.1.1&#10;10.0.0.1">{{ old('whitelisted_ips', $settings['whitelisted_ips'] ?? '') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Enter one IP address per line. Leave empty to allow all.</p>
                        </div>
                        
                        <!-- Session Timeout -->
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div>
                                <label class="font-medium text-gray-800">Session Timeout</label>
                                <p class="text-sm text-gray-500">Automatically logout inactive users</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="number" name="session_timeout" value="{{ old('session_timeout', $settings['session_timeout'] ?? 60) }}" min="5"
                                       class="w-24 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] text-center">
                                <span class="text-sm text-gray-500">minutes</span>
                            </div>
                        </div>
                        
                        <!-- Max Login Attempts -->
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div>
                                <label class="font-medium text-gray-800">Max Login Attempts</label>
                                <p class="text-sm text-gray-500">Lock account after failed attempts</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="number" name="max_login_attempts" value="{{ old('max_login_attempts', $settings['max_login_attempts'] ?? 5) }}" min="3"
                                       class="w-24 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] text-center">
                                <span class="text-sm text-gray-500">attempts</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-[#2D6A4F] hover:bg-[#1B4D3E] text-white rounded-lg transition shadow-md">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- ==================== EMAIL TEMPLATES TAB ==================== -->
            <div id="panel-email" class="settings-panel hidden">
                <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="tab" value="email">
                    
                    <div class="space-y-4">
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <i class="fas fa-info-circle text-yellow-600 mt-0.5 mr-3"></i>
                                <p class="text-sm text-yellow-800">
                                    <strong>Note:</strong> Email templates support HTML. Use <code class="bg-yellow-100 px-1 py-0.5 rounded">{placeholder}</code> for dynamic content.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Welcome Email -->
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Welcome Email</h4>
                                        <p class="text-sm text-gray-500">Sent when a new user registers</p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs text-gray-400">Subject:</span>
                                        <input type="text" name="welcome_subject" value="{{ old('welcome_subject', $settings['welcome_subject'] ?? 'Welcome to our platform!') }}"
                                               class="text-sm px-3 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#2D6A4F] w-48">
                                    </div>
                                </div>
                            </div>
                            <div class="p-4">
                                <textarea name="welcome_email" rows="5" 
                                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] font-mono text-sm">{{ old('welcome_email', $settings['welcome_email'] ?? "<h2>Welcome {name}!</h2>\n<p>Thank you for joining our platform. We're excited to have you on board.</p>\n<p>Get started by exploring our properties.</p>\n<p>Best regards,<br>The Team</p>") }}</textarea>
                            </div>
                        </div>
                        
                        <!-- Booking Confirmation Email -->
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Booking Confirmation</h4>
                                        <p class="text-sm text-gray-500">Sent when a booking is confirmed</p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs text-gray-400">Subject:</span>
                                        <input type="text" name="booking_subject" value="{{ old('booking_subject', $settings['booking_subject'] ?? 'Booking Confirmation #{reference}') }}"
                                               class="text-sm px-3 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#2D6A4F] w-48">
                                    </div>
                                </div>
                            </div>
                            <div class="p-4">
                                <textarea name="booking_email" rows="5" 
                                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] font-mono text-sm">{{ old('booking_email', $settings['booking_email'] ?? "<h2>Booking Confirmed!</h2>\n<p>Dear {name},</p>\n<p>Your booking has been confirmed successfully.</p>\n<p><strong>Details:</strong></p>\n<p>Property: {property}<br>Check-in: {check_in}<br>Check-out: {check_out}</p>\n<p>Thank you for choosing us.</p>") }}</textarea>
                            </div>
                        </div>
                        
                        <!-- Password Reset Email -->
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Password Reset</h4>
                                        <p class="text-sm text-gray-500">Sent when a user requests password reset</p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs text-gray-400">Subject:</span>
                                        <input type="text" name="reset_subject" value="{{ old('reset_subject', $settings['reset_subject'] ?? 'Reset Your Password') }}"
                                               class="text-sm px-3 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-[#2D6A4F] w-48">
                                    </div>
                                </div>
                            </div>
                            <div class="p-4">
                                <textarea name="reset_email" rows="5" 
                                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] font-mono text-sm">{{ old('reset_email', $settings['reset_email'] ?? "<h2>Reset Your Password</h2>\n<p>Hello {name},</p>\n<p>We received a request to reset your password. Click the link below to set a new password:</p>\n<p><a href=\"{reset_link}\">{reset_link}</a></p>\n<p>This link will expire in 60 minutes.</p>\n<p>If you didn't request this, please ignore this email.</p>") }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-[#2D6A4F] hover:bg-[#1B4D3E] text-white rounded-lg transition shadow-md">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- ==================== MAINTENANCE TAB ==================== -->
            <div id="panel-maintenance" class="settings-panel hidden">
                <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="tab" value="maintenance">
                    
                    <div class="space-y-4">
                        <!-- Maintenance Mode Toggle -->
                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-800">Maintenance Mode</h4>
                                    <p class="text-sm text-gray-500 mt-1">Put the website into maintenance mode. Only admins can access the site.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="maintenance_mode" value="1" 
                                           class="sr-only peer"
                                           {{ old('maintenance_mode', $settings['maintenance_mode'] ?? false) ? 'checked' : '' }}
                                           onchange="toggleMaintenanceFields(this.checked)">
                                    <div class="w-14 h-7 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-red-500 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all"></div>
                                    <span class="ml-3 text-sm font-medium text-gray-700" id="maintenanceStatus">
                                        {{ old('maintenance_mode', $settings['maintenance_mode'] ?? false) ? 'Enabled' : 'Disabled' }}
                                    </span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Maintenance Settings (conditional) -->
                        <div id="maintenanceFields" class="{{ old('maintenance_mode', $settings['maintenance_mode'] ?? false) ? '' : 'hidden' }} space-y-4">
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Maintenance Title
                                </label>
                                <input type="text" name="maintenance_title" value="{{ old('maintenance_title', $settings['maintenance_title'] ?? 'We\'ll Be Back Soon') }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Maintenance Message
                                </label>
                                <textarea name="maintenance_message" rows="4" 
                                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                          placeholder="Enter your maintenance message...">{{ old('maintenance_message', $settings['maintenance_message'] ?? 'We are currently performing scheduled maintenance. We apologize for the inconvenience and will be back shortly.') }}</textarea>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Estimated Return Time
                                </label>
                                <input type="datetime-local" name="maintenance_return_time" value="{{ old('maintenance_return_time', $settings['maintenance_return_time'] ?? '') }}"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                                <p class="text-xs text-gray-500 mt-1">Optional. Estimated time when the site will be back online.</p>
                            </div>
                            
                            <!-- Allow IPs -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Allowed IP Addresses (During Maintenance)
                                </label>
                                <textarea name="maintenance_allowed_ips" rows="3" 
                                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                                          placeholder="Enter one IP per line"> {{ old('maintenance_allowed_ips', $settings['maintenance_allowed_ips'] ?? '') }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Users from these IPs can still access the site during maintenance. Enter one IP per line.</p>
                            </div>
                            
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <div class="flex items-start">
                                    <i class="fas fa-exclamation-triangle text-red-500 mt-0.5 mr-3"></i>
                                    <div>
                                        <p class="text-sm font-medium text-red-800">Warning</p>
                                        <p class="text-sm text-red-700">Enabling maintenance mode will make the website inaccessible to all users except administrators.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-[#2D6A4F] hover:bg-[#1B4D3E] text-white rounded-lg transition shadow-md">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Tab switching
    function switchTab(tabName) {
        // Hide all panels
        document.querySelectorAll('.settings-panel').forEach(panel => {
            panel.classList.add('hidden');
        });
        
        // Show selected panel
        document.getElementById(`panel-${tabName}`).classList.remove('hidden');
        
        // Update tab styles
        document.querySelectorAll('[id^="tab-"]').forEach(tab => {
            tab.classList.remove('border-[#2D6A4F]', 'text-[#2D6A4F]');
            tab.classList.add('border-transparent', 'text-gray-500');
        });
        
        const activeTab = document.getElementById(`tab-${tabName}`);
        activeTab.classList.remove('border-transparent', 'text-gray-500');
        activeTab.classList.add('border-[#2D6A4F]', 'text-[#2D6A4F]');
    }
    
    // Preserve active tab after form submission
    const activeTab = new URLSearchParams(window.location.search).get('tab') || 'general';
    switchTab(activeTab);
    
    // Character counter for meta title
    const metaTitle = document.querySelector('input[name="meta_title"]');
    const metaTitleCount = document.getElementById('metaTitleCount');
    if (metaTitle && metaTitleCount) {
        metaTitleCount.textContent = metaTitle.value.length;
        metaTitle.addEventListener('input', function() {
            metaTitleCount.textContent = this.value.length;
        });
    }
    
    // Character counter for meta description
    const metaDesc = document.querySelector('textarea[name="meta_description"]');
    const metaDescCount = document.getElementById('metaDescCount');
    if (metaDesc && metaDescCount) {
        metaDescCount.textContent = metaDesc.value.length;
        metaDesc.addEventListener('input', function() {
            metaDescCount.textContent = this.value.length;
        });
    }
    
    // Toggle maintenance fields
    function toggleMaintenanceFields(checked) {
        const fields = document.getElementById('maintenanceFields');
        const status = document.getElementById('maintenanceStatus');
        
        if (checked) {
            fields.classList.remove('hidden');
            status.textContent = 'Enabled';
            status.className = 'ml-3 text-sm font-medium text-red-700';
        } else {
            fields.classList.add('hidden');
            status.textContent = 'Disabled';
            status.className = 'ml-3 text-sm font-medium text-gray-700';
        }
    }
    
    // Toggle IP whitelist input
    const ipWhitelistToggle = document.querySelector('input[name="ip_whitelist_enabled"]');
    const ipWhitelistInput = document.getElementById('ipWhitelistInput');
    
    if (ipWhitelistToggle && ipWhitelistInput) {
        ipWhitelistToggle.addEventListener('change', function() {
            if (this.checked) {
                ipWhitelistInput.classList.remove('hidden');
            } else {
                ipWhitelistInput.classList.add('hidden');
            }
        });
    }
    
    // Maintenance mode toggle - show/hide fields
    const maintenanceToggle = document.querySelector('input[name="maintenance_mode"]');
    const maintenanceFields = document.getElementById('maintenanceFields');
    
    if (maintenanceToggle && maintenanceFields) {
        maintenanceToggle.addEventListener('change', function() {
            if (this.checked) {
                maintenanceFields.classList.remove('hidden');
            } else {
                maintenanceFields.classList.add('hidden');
            }
        });
    }
</script>
@endpush
@endsection