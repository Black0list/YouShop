@extends('welcome')
@section('title', 'Product View')
@section('view')
<div class="max-w-8xl">
    <!-- Product Header -->
    <div class="bg-white p-8 rounded-lg shadow-sm mb-8">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-400 bg-clip-text text-transparent">
            {{ $product->title }}
        </h1>
        <div class="flex gap-8 flex-wrap mt-4">
            <div class="flex items-center gap-2 text-gray-600">
                <i class="fas fa-user-graduate text-indigo-600"></i>
                <span>Instructor Name</span>
            </div>
            <div class="flex items-center gap-2 text-gray-600">
                <i class="fas fa-bookmark text-indigo-600"></i>
                <span>Category</span>
            </div>
        </div>
        <div class="flex items-center gap-2 mt-4 text-gray-600">
            <i class="fas fa-tags text-indigo-600"></i>
            <span>Tag1, Tag2, Tag3</span>
        </div>
    </div>

    <!-- Product Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column -->
        <div class="lg:col-span-2">
            <!-- Product Description -->
            <div class="bg-white p-8 rounded-lg shadow-sm">
                <h2 class="text-2xl font-semibold mb-6">Product Description</h2>
                <p class="text-gray-600 leading-relaxed">
                    This is a detailed description of the product. It explains the features, benefits, and what users can expect.
                </p>
                <div class="w-full bg-gray-200 rounded-full h-2 mt-6">
                    <div class="bg-indigo-600 h-2 rounded-full" style="width: 75%;"></div>
                </div>
            </div>

            <!-- Curriculum Section -->
            <div class="bg-white p-8 rounded-lg shadow-sm mt-8">
                <h2 class="text-2xl font-semibold mb-6">Product Content</h2>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-gray-50 p-4 flex justify-between items-center cursor-pointer">
                        <h3 class="text-lg font-semibold">Module 1</h3>
                        <i class="fas fa-chevron-down text-indigo-600"></i>
                    </div>
                    <div class="p-4 border-t border-gray-200">
                        <div class="flex items-center gap-4 py-2 text-gray-600">
                            <i class="fas fa-play-circle text-indigo-600"></i>
                            <span>Video Lesson</span>
                        </div>
                        <div class="flex items-center gap-4 py-2 text-gray-600">
                            <i class="fas fa-file-alt text-indigo-600"></i>
                            <span>Document</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instructor Section -->
            <div class="bg-white p-8 rounded-lg shadow-sm mt-8">
                <h2 class="text-2xl font-semibold mb-6">Instructor</h2>
                <div class="flex items-center gap-6">
                    <img src="https://via.placeholder.com/80" alt="Instructor" class="w-20 h-20 rounded-full">
                    <div>
                        <h4 class="text-xl font-semibold">Instructor Name</h4>
                        <p class="text-gray-600 mt-2">
                            Expert in the field with years of experience. Passionate about teaching and sharing knowledge.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white p-8 rounded-lg shadow-sm sticky top-8">
                <div class="text-4xl font-bold text-indigo-600 mb-6">$99.99</div>
                <button class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-all">
                    Buy Now
                </button>
                <div class="mt-6">
                    <div class="flex items-center gap-4 py-3 text-gray-600">
                        <i class="fas fa-video text-green-600"></i>
                        <span>24 hours on-demand video</span>
                    </div>
                    <div class="flex items-center gap-4 py-3 text-gray-600">
                        <i class="fas fa-infinity text-green-600"></i>
                        <span>Full lifetime access</span>
                    </div>
                    <div class="flex items-center gap-4 py-3 text-gray-600">
                        <i class="fas fa-mobile-alt text-green-600"></i>
                        <span>Access on mobile and TV</span>
                    </div>
                    <div class="flex items-center gap-4 py-3 text-gray-600">
                        <i class="fas fa-certificate text-green-600"></i>
                        <span>Certificate of completion</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Accordion functionality
    document.querySelectorAll('.bg-gray-50').forEach(header => {
        header.addEventListener('click', () => {
            const module = header.parentElement;
            module.classList.toggle('active');

            const icon = header.querySelector('i');
            if (module.classList.contains('active')) {
                icon.classList.replace('fa-chevron-down', 'fa-chevron-up');
            } else {
                icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
            }
        });
    });
</script>

@endsection
