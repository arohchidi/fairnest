@extends('admin.layouts.app')

@section('title', 'Privacy Policy')
@section('header-title', 'Privacy Policy')
@section('header-description', 'Manage the privacy policy of your platform')

@section('content')
<div class="max-w-5xl mx-auto">
    
    <!-- Info Banner -->
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-3"></i>
            <div>
                <p class="text-sm text-blue-800">
                    <strong>Note:</strong> This privacy policy explains how user data is collected, used, and protected. 
                    Changes will take effect immediately after saving.
                </p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-[#2D6A4F]/10 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-shield-alt text-[#2D6A4F] text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Privacy Policy</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Last updated: <span id="lastUpdated">{{ $privacy->updated_at->format('F d, Y H:i A') ?? 'Never' }}</span></p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="text-xs text-gray-500">Status:</span>
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                        Published
                    </span>
                </div>
            </div>
        </div>
        
        <form method="POST" action="{{ route('admin.pages.privacy.update') }}" class="p-6">
            @csrf
            @method('PUT')
            
            <!-- Version -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Version <span class="text-red-500">*</span>
                </label>
                <input type="text" name="version" value="{{ old('version', $privacy->version ?? '1.0') }}"
                       class="w-full md:w-64 px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]"
                       placeholder="e.g., 1.0, 2.1">
                @error('version')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Title -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Page Title <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title', $privacy->title ?? 'Privacy Policy') }}"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Content -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Content <span class="text-red-500">*</span>
                </label>
                <textarea name="content" id="privacyEditor" rows="20"
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">{{ old('content', $privacy->content ?? '') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                <button type="button" onclick="previewContent()" class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium">
                    <i class="fas fa-eye mr-2"></i>Preview
                </button>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] hover:from-[#0D2A3A] hover:to-[#0A1928] text-white rounded-lg font-medium transition shadow-md">
                    <i class="fas fa-save mr-2"></i>Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Preview Modal -->
<div id="previewModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Preview</h3>
            <button onclick="closePreview()" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="previewContent" class="p-6 overflow-y-auto max-h-[70vh] prose prose-sm max-w-none">
            <!-- Preview content will be injected here -->
        </div>
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end">
            <button onclick="closePreview()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                Close
            </button>
        </div>
    </div>
</div>

@push('styles')
<style>
    .tox-tinymce {
        border-radius: 0.5rem !important;
        border-color: #d1d5db !important;
    }
    .tox-tinymce:focus-within {
        border-color: #2D6A4F !important;
        box-shadow: 0 0 0 2px rgba(45, 106, 79, 0.2) !important;
    }
    .prose h1 { font-size: 2em; margin-top: 1.5em; margin-bottom: 0.5em; }
    .prose h2 { font-size: 1.5em; margin-top: 1.25em; margin-bottom: 0.5em; }
    .prose h3 { font-size: 1.25em; margin-top: 1em; margin-bottom: 0.5em; }
    .prose p { margin-bottom: 1em; line-height: 1.7; }
    .prose ul, .prose ol { margin: 1em 0; padding-left: 1.5em; }
    .prose li { margin-bottom: 0.5em; }
</style>
@endpush

@push('scripts')
<!-- TinyMCE CDN -->
<script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    // Initialize TinyMCE
    tinymce.init({
        selector: '#privacyEditor',
        height: 500,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help | fullscreen',
        content_style: 'body { font-family: Inter, system-ui, sans-serif; font-size: 16px; line-height: 1.7; }',
        branding: false,
        promotion: false,
        skin: 'oxide',
        content_css: 'default',
        setup: function(editor) {
            editor.on('change', function() {
                tinymce.triggerSave();
            });
        }
    });
    
    // Preview functionality
    function previewContent() {
        const content = tinymce.get('privacyEditor').getContent();
        document.getElementById('previewContent').innerHTML = content;
        document.getElementById('previewModal').classList.remove('hidden');
        document.getElementById('previewModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closePreview() {
        document.getElementById('previewModal').classList.add('hidden');
        document.getElementById('previewModal').classList.remove('flex');
        document.body.style.overflow = '';
    }
    
    // Close modal on outside click
    document.getElementById('previewModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePreview();
        }
    });
    
    // Save on Ctrl+S
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            document.querySelector('form').submit();
        }
    });
</script>
@endpush
@endsection