@extends('admin.layouts.app')

@section('title', 'Send Email')
@section('header-title', 'Send Email')
@section('header-description', 'Send emails to users and property owners')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-[#2D6A4F]/10 rounded-xl flex items-center justify-center mr-3">
                    <i class="fas fa-envelope text-[#2D6A4F] text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Compose Email</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Send emails to users, landlords, or property owners</p>
                </div>
            </div>
        </div>
        
        <form method="POST" action="{{ route('admin.emails.send') }}" class="p-6 space-y-5">
            @csrf
            
            <!-- Recipient Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Recipient Type <span class="text-red-500">*</span></label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="recipient_type" value="all_users" class="hidden peer" checked>
                        <div class="p-4 border-2 rounded-xl transition-all peer-checked:border-[#2D6A4F] peer-checked:bg-[#2D6A4F]/5 hover:border-gray-300 border-gray-200">
                            <div class="text-center">
                                <i class="fas fa-users text-2xl text-[#2D6A4F] mb-2"></i>
                                <p class="font-medium text-gray-800">All Users</p>
                                <p class="text-xs text-gray-500">Send to all registered users</p>
                            </div>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="recipient_type" value="landlords" class="hidden peer">
                        <div class="p-4 border-2 rounded-xl transition-all peer-checked:border-[#2D6A4F] peer-checked:bg-[#2D6A4F]/5 hover:border-gray-300 border-gray-200">
                            <div class="text-center">
                                <i class="fas fa-building text-2xl text-[#2D6A4F] mb-2"></i>
                                <p class="font-medium text-gray-800">Landlords</p>
                                <p class="text-xs text-gray-500">Send to all property owners</p>
                            </div>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="recipient_type" value="tenants" class="hidden peer">
                        <div class="p-4 border-2 rounded-xl transition-all peer-checked:border-[#2D6A4F] peer-checked:bg-[#2D6A4F]/5 hover:border-gray-300 border-gray-200">
                            <div class="text-center">
                                <i class="fas fa-user text-2xl text-[#2D6A4F] mb-2"></i>
                                <p class="font-medium text-gray-800">Tenants</p>
                                <p class="text-xs text-gray-500">Send to all renters</p>
                            </div>
                        </div>
                    </label>
                </div>
                @error('recipient_type')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Specific Recipients -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Specific Recipients (Optional)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-at text-gray-400 text-sm"></i>
                    </div>
                    <input type="text" name="specific_recipients" value="{{ old('specific_recipients') }}"
                           class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                           placeholder="Enter email addresses separated by commas">
                </div>
                <p class="text-xs text-gray-500 mt-1">Example: user1@email.com, user2@email.com</p>
            </div>
            
            <!-- Subject -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Subject <span class="text-red-500">*</span>
                </label>
                <input type="text" name="subject" value="{{ old('subject') }}" required
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                       placeholder="Enter email subject">
                @error('subject')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Content -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Message <span class="text-red-500">*</span>
                </label>
                <textarea name="content" id="emailEditor" rows="12" required
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                          placeholder="Write your email content...">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Template Options -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email Template</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                    <button type="button" onclick="insertTemplate('welcome')" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition">
                        Welcome
                    </button>
                    <button type="button" onclick="insertTemplate('booking')" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition">
                        Booking
                    </button>
                    <button type="button" onclick="insertTemplate('announcement')" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition">
                        Announcement
                    </button>
                    <button type="button" onclick="insertTemplate('reminder')" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition">
                        Reminder
                    </button>
                </div>
            </div>
            
            <!-- Preview -->
            <div class="flex items-center">
                <input type="checkbox" name="send_copy" value="1" class="w-4 h-4 text-[#2D6A4F] border-gray-300 rounded">
                <label class="ml-2 text-sm text-gray-600">Send a copy to myself</label>
            </div>
            
            <!-- Actions -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                <button type="button" onclick="previewEmail()" class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium">
                    <i class="fas fa-eye mr-2"></i> Preview
                </button>
                <button type="submit" class="px-6 py-2.5 bg-[#2D6A4F] text-white rounded-lg font-medium hover:bg-[#1B4D3E] transition shadow-md">
                    <i class="fas fa-paper-plane mr-2"></i> Send Email
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Preview Modal -->
<div id="previewModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-3xl w-full mx-4 max-h-[90vh] overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Email Preview</h3>
            <button onclick="closePreview()" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="previewContent" class="p-6 overflow-y-auto max-h-[70vh] prose max-w-none">
            <!-- Preview content will be injected here -->
        </div>
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end">
            <button onclick="closePreview()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                Close
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Simple WYSIWYG-like functionality
    function insertTemplate(type) {
        const textarea = document.getElementById('emailEditor');
        const templates = {
            welcome: 'Dear {{ $user_name }},\n\nWelcome to {{ config('app.name') }}! We are excited to have you on board.\n\nGet started by exploring our properties.\n\nBest regards,\nThe {{ config('app.name') }} Team',
            booking: 'Dear {{ $user_name }},\n\nYour booking for {{ $property_title }} has been confirmed!\n\nCheck-in: {{ $check_in }}\nCheck-out: {{ $check_out }}\n\nThank you for choosing us.',
            announcement: 'Dear {{ $user_name }},\n\nWe have an exciting announcement! We are pleased to inform you about our new features.\n\nStay tuned for more updates.\n\nBest regards,\nThe {{ config('app.name') }} Team',
            reminder: 'Dear {{ $user_name }},\n\nThis is a friendly reminder about your upcoming booking.\n\nDon\'t forget to prepare for your stay.\n\nBest regards,\nThe {{ config('app.name') }} Team'
        };
        textarea.value = templates[type] || '';
    }
    
    function previewEmail() {
        const content = document.getElementById('emailEditor').value;
        document.getElementById('previewContent').innerHTML = content.replace(/\n/g, '<br>');
        document.getElementById('previewModal').classList.remove('hidden');
        document.getElementById('previewModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closePreview() {
        document.getElementById('previewModal').classList.add('hidden');
        document.getElementById('previewModal').classList.remove('flex');
        document.body.style.overflow = '';
    }
</script>
@endpush
@endsection