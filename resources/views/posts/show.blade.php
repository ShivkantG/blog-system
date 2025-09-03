@extends('layouts.app')
@section('dashboard')

    <div class="max-w-3xl mx-auto bg-white shadow-md p-6 rounded-md mt-6">
        <h1 class="text-3xl font-bold text-[#0d6a7c] mb-4">{{ $post->title }}</h1>

        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                class="w-full max-h-96 object-cover rounded-lg mb-6">
        @endif

        <p class="text-gray-700 leading-relaxed">{{ $post->content }}</p>
    </div>

@endsection