@extends('layouts.public')

@section('public')
    <div class="w-full flex flex-col gap-4 sm:gap-6">
        <!-- Welcome Header Section -->
        <div
            class="bg-white  shadow-md p-6 md:p-12 text-center rounded-md min-h-[calc(100vh-73px)] flex flex-col justify-center items-center transition-all duration-300">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-[#0d6a7c]  mb-4 leading-tight">
                Welcome to Blog Management System </h1>
            <p class="text-[#0d6a7c]  text-base sm:text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">
                A complete solution to track, manage, and analyze every phase of your shrimp operations – from raw material
                entries to grading, headless tracking, yield reports, and beyond. Built for efficiency, accuracy, and
                productivity.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row items-center gap-4">
                <a href="/login"
                    class="px-6 py-3 bg-[#0d6a7c] text-white text-lg rounded-lg hover:shadow-md transition-all duration-200 ease-in-out font-semibold">
                    Get Started
                </a>
                <a href="#"
                    class="px-6 py-3 border-2 border-[#0d6a7c]  text-[#0d6a7c]  text-lg rounded-lg hover:bg-[#0d6a7c]/10 transition-all duration-200 font-semibold">
                    Learn More
                </a>
            </div>
        </div>
    </div>
@endsection