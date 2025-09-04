@extends('layouts.public')

@section('public')
    <!-- Blog Show Page -->
    <div class="max-w-6xl mx-auto md:p-10 rounded-md px-4 mt-6">

        <div class="flex flex-col md:flex-row gap-8 items-start">
            
            <!-- Post Image (Left Side on Desktop, Top on Mobile) -->
            @if($post->image)
                <div class="w-full md:max-w-4xl">
                    <img src="{{ asset('storage/' . $post->image) }}" 
                         alt="{{ $post->title }}"
                         class="w-full max-h-[450px] object-cover rounded-lg shadow">
                </div>
            @endif

            <!-- Post Content (Right Side on Desktop) -->
            <div class="w-full md:w-1/2 flex flex-col">
                <!-- Title -->
                <h1 class="text-3xl md:text-4xl font-bold text-[#0d6a7c] mb-4">
                    {{ $post->title }}
                </h1>

                <!-- Meta Info -->
                <p class="text-sm text-gray-500 mb-4">
                    Published on {{ $post->created_at->format('F d, Y') }} • By Admin
                </p>

                <!-- Content -->
                <div class="text-gray-700 leading-relaxed prose max-w-none">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#0d6a7c] text-white mt-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center md:text-left">

                <!-- About -->
                <div>
                    <h2 class="text-lg font-semibold mb-3">About</h2>
                    <p class="text-sm text-gray-200">
                        Blog Management System helps you create, publish, and manage blogs with ease.
                        A platform for writers, editors, and readers.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h2 class="text-lg font-semibold mb-3">Quick Links</h2>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/blogs') }}" class="hover:underline">Explore Blogs</a></li>
                        <li><a href="{{ url('/login') }}" class="hover:underline">Login</a></li>
                        <li><a href="{{ url('/register') }}" class="hover:underline">Register</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h2 class="text-lg font-semibold mb-3">Contact</h2>
                    <p class="text-sm">New Delhi, India</p>
                    <p class="text-sm">contact@blogms.com</p>
                    <p class="text-sm">+91 9876543210</p>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-500 mt-6 pt-4 text-center text-sm text-gray-200">
                © {{ date('Y') }} Blog Management System. All Rights Reserved.
            </div>
        </div>
    </footer>
@endsection
