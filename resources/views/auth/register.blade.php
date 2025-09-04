@extends('layouts.guest')

@section('section')
    <div
        class="w-full min-h-svh bg-gradient-to-r from-[#a2f0f2] via-[#3ebfc1] to-[#91f0f2] grid place-items-center p-2 sm:p-0">

        @if ($errors->any())
            <div id="alert_2" class="!gap-5 border !px-5 !py-2 mb-6 bg-red-500 text-white relative">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="font-semibold">{{ $error }}</li>
                    @endforeach
                </ul>
                <i id="alert_btn_2"
                    class="fa-solid fa-xmark absolute top-1/2 right-5 translate-y-[-50%] text-xl cursor-pointer"></i>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}"
            class="max-w-[600px] w-full m-auto border-[16px] border-[#91f0f2] bg-[#0d6a7c] p-4 md:p-8 shadow-md">
            @csrf

            <div class="flex flex-col gap-4 py-4">
                <div>
                    {{-- <img class="w-[80px] m-auto rounded-xl" src="{{ asset('images/auth/website.png') }}"
                    alt="register banner"> --}}
                </div>
            </div>

            <!-- Name -->
            <div class="mb-4">
                <div class="border-b-2 border-[#5efcff] flex gap-2 items-center">
                    <i class="fa-solid fa-user text-[#5efcff]"></i>
                    <input type="text" name="name" id="name"
                        class="w-full bg-transparent text-white border-none focus:ring-0 placeholder:text-[#5efcff]"
                        placeholder="Full Name" value="{{ old('name') }}" required autofocus autocomplete="name">
                </div>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <div class="border-b-2 border-[#5efcff] flex gap-2 items-center">
                    <i class="fa-solid fa-envelope text-[#5efcff]"></i>
                    <input type="email" name="email" id="email"
                        class="w-full bg-transparent text-white border-none focus:ring-0 placeholder:text-[#5efcff]"
                        placeholder="Email Address" value="{{ old('email') }}" required autocomplete="username">
                </div>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <div class="border-b-2 border-[#5efcff] flex gap-2 items-center">
                    <i class="fa-solid fa-lock text-[#5efcff]"></i>
                    <input type="password" name="password" id="password"
                        class="w-full bg-transparent text-white border-none focus:ring-0 placeholder:text-[#5efcff]"
                        placeholder="Password" required autocomplete="new-password">
                </div>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <div class="border-b-2 border-[#5efcff] flex gap-2 items-center">
                    <i class="fa-solid fa-lock-keyhole text-[#5efcff]"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full bg-transparent text-white border-none focus:ring-0 placeholder:text-[#5efcff]"
                        placeholder="Confirm Password" required autocomplete="new-password">
                </div>
                @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Register Button -->
            <div class="flex items-center justify-end mt-6">
                <button type="submit"
                    class="w-full bg-[#00252c] text-white font-semibold py-2 px-4 transition duration-300">
                    Register
                </button>
            </div>

            <!-- Already Registered -->
            <div class="text-center mt-6 text-white text-sm sm:text-base">
                <span>Already have an account?</span><br />
                <a href="{{ route('login') }}"
                    class="text-[#5efcff] hover:underline hover:text-[#5efcff] transition duration-200">
                    Login
                </a>
            </div>
        </form>
    </div>
@endsection