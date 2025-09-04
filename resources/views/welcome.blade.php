@extends('layouts.public')

@section('public')
    <div class="w-full flex flex-col gap-4 sm:gap-6">
        <!-- Welcome Header Section -->
        <div
            class="bg-gradient-to-r mt-[-4px] from-[#76e0e4a9] via-[#3ebfc136] to-[#45d6d85e] p-6 md:p-12 text-center rounded-md min-h-[600px] flex flex-col justify-center items-center transition-all duration-300">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-[#0d6a7c] mb-4 leading-tight">
                Welcome to Blog Management System
            </h1>

            <p class="text-[#0d6a7c] text-base sm:text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">
                Create, publish, and manage blogs with ease. Whether you're a writer, editor, or reader —
                our platform gives you all the tools to express and explore ideas.
            </p>

            <!-- Call to Actions -->
            <div class="mt-8 flex flex-col sm:flex-row items-center gap-4">
                <a href="/login"
                    class="px-6 py-3 bg-[#0d6a7c] text-white text-lg rounded-lg hover:shadow-md transition-all duration-200 ease-in-out font-semibold">
                    Get Started
                </a>
                <a href="/blogs"
                    class="px-6 py-3 border-2 border-[#0d6a7c] text-[#0d6a7c] text-lg rounded-lg hover:bg-[#0d6a7c]/10 transition-all duration-200 font-semibold">
                    Explore Blogs
                </a>
            </div>
        </div>
    </div>
    <div class="w-full px-4 md:px-0 min-h-[200px] grid place-items-center sm:p-2 py-6 sm:py-10 md:py-16">
        <!-- Post List -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-7xl">
            @forelse ($posts as $post)
                <!-- Blog Card -->
                <div class="p-5 bg-white border rounded-lg shadow-md flex flex-col transition-all duration-300 hover:shadow-lg">
                    <!-- Image Section -->
                    <div class="w-full h-48 overflow-hidden rounded-md">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                        @else
                            <img src="https://via.placeholder.com/400x250?text=No+Image" class="w-full h-full object-cover">
                        @endif
                    </div>

                    <!-- Content Section -->
                    <div class="flex-1 mt-4 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-[#0d6a7c] mb-2 line-clamp-2">
                                {{ $post->title }}
                            </h3>
                            <p class="text-gray-700 text-sm leading-relaxed line-clamp-3">
                                {{ $post->content }}
                            </p>
                        </div>

                        <!-- Footer -->
                        <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center gap-2">
                                <span>✍️ {{ $post->user->name }}</span>
                                <span>•</span>
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            <a href="{{ route('posts.show', $post->slug) }}"
                                class="px-3 py-1 bg-indigo-500 text-white rounded-lg text-xs sm:text-sm hover:bg-indigo-600 transition">
                                Read More
                            </a>
                        </div>

                        <!-- Reactions -->
                        <div class="flex items-center gap-4 mt-3">
                            @if($post->user_id !== auth()->id())
                                <button class="like-btn flex items-center gap-1 text-gray-600 hover:text-green-600"
                                    data-id="{{ $post->id }}">
                                    👍 <span id="like-count-{{ $post->id }}">
                                        {{ $post->reactions()->where('reaction', 1)->count() }}
                                    </span>
                                </button>
                                <button class="dislike-btn flex items-center gap-1 text-gray-600 hover:text-red-600"
                                    data-id="{{ $post->id }}">
                                    👎 <span id="dislike-count-{{ $post->id }}">
                                        {{ $post->reactions()->where('reaction', -1)->count() }}
                                    </span>
                                </button>
                            @else
                                <p class="text-xs text-gray-400">You cannot react on your own post</p>
                            @endif
                        </div>

                        <!-- Edit/Delete Buttons -->
                        @if($post->user_id == auth()->id())
                            <div class="flex gap-3 mt-4">
                                <button onclick="location.href='{{ route('posts.edit', $post) }}'"
                                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
                                    Edit
                                </button>
                                <form id="delete-form-{{ $post->id }}" action="{{ route('posts.destroy', $post) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $post->id }})"
                                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 text-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <!-- Static Fallback Cards -->
                @foreach(range(1, 3) as $i)
                    <div class="p-5 bg-white border rounded-lg shadow-md flex flex-col transition-all duration-300 hover:shadow-lg">
                        <!-- Image Section -->
                        <div class="w-full h-48 overflow-hidden rounded-md">
                            <img src="https://st3.depositphotos.com/3591429/13269/i/450/depositphotos_132694218-stock-photo-woman-writing-notes-in-diary.jpg"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                        </div>

                        <!-- Content Section -->
                        <div class="flex-1 mt-4 flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-[#0d6a7c] mb-2 line-clamp-2">
                                    Welcome to Our Blog
                                </h3>
                                <p class="text-gray-700 text-sm leading-relaxed line-clamp-3">
                                    This is a sample blog post. Start creating your own posts to see them appear here!
                                </p>
                            </div>

                            <!-- Footer -->
                            <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <span>✍️ Admin</span>
                                    <span>•</span>
                                    <span>Just now</span>
                                </div>
                                <a href="#"
                                    class="px-3 py-1 bg-indigo-500 text-white rounded-lg text-xs sm:text-sm hover:bg-indigo-600 transition">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforelse
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#0d6a7c] text-white">
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
                        <li><a href="/blogs" class="hover:underline">Explore Blogs</a></li>
                        <li><a href="/login" class="hover:underline">Login</a></li>
                        <li><a href="/register" class="hover:underline">Register</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h2 class="text-lg font-semibold mb-3">Contact</h2>
                    <p class="text-sm"> New Delhi, India</p>
                    <p class="text-sm"> contact@blogms.com</p>
                    <p class="text-sm"> +91 9876543210</p>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-500 mt-6 pt-4 text-center text-sm text-gray-200">
                © {{ date('Y') }} Blog Management System. All Rights Reserved.
            </div>
        </div>
    </footer>

@endsection