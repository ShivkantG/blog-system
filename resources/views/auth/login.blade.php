@extends('layouts.guest')
@section('section')
    <div
        class="w-full min-h-svh bg-gradient-to-r from-[#a2f0f2] via-[#3ebfc1] to-[#91f0f2] grid place-items-center p-2 sm:p-0">
        <style>
            input:-webkit-autofill {
                -webkit-box-shadow: 0 0 0px 1000px #0d6a7c inset !important;
                -webkit-text-fill-color: #ffffff !important;
                caret-color: #ffffff;
            }
        </style>
        @if ($errors->any())
            <div id="alert_2" class="!gap-5 border !px-5 !py-2 mb-6 bg-red-500 text-white relative">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="font-semibold text-color-2">{{ $error }}</li>
                    @endforeach
                </ul>
                <i id="alert_btn_2"
                    class="fa-solid fa-xmark absolute text-color-2 top-1/2 right-5 translate-y-[-50%] text-xl cursor-pointer"></i>
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}"
            class="max-w-[600px] w-full m-auto border-[5px] border-[#91f0f2] bg-[#0d6a7c] p-4 md:p-8 shadow-md">
            @csrf

            <div class="flex flex-col gap-4 py-4">
                <div>
                    {{-- <img class="w-[80px] m-auto rounded-xl" src="{{ asset('images/auth/website.png') }}" alt="login
                    banner"> --}}
                </div>
            </div>

            <!-- Email Address -->
            <div>
                <div class="border-b-2 border-[#5efcff] flex gap-2 sm:gap-4 items-center">
                    <i class="fa-solid fa-envelope text-[#5efcff]"></i>
                    <input type="email" name="email" id="email"
                        class="border-none focus:border-none focus:outline-none focus:ring-0 w-full bg-transparent text-white placeholder:text-[#5efcff]"
                        placeholder="Email ID" value="{{ old('email') }}" required autofocus autocomplete="username">
                </div>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <div class="border-b-2 border-[#5efcff] flex gap-2 sm:gap-4 items-center mt-4">
                    <i class="fa-solid fa-lock-keyhole text-[#5efcff]"></i>
                    <input type="password" name="password" id="password"
                        class="border-none focus:border-none focus:outline-none focus:ring-0 w-full bg-transparent text-white placeholder:text-[#5efcff]"
                        placeholder="Password" value="{{ old('password') }}" required autofocus autocomplete="username">
                </div>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="mt-4 flex justify-between items-center">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-[#5efcff] text-[#5efcff] focus:ring-0 focus:ring-offset-0 bg-transparent">
                    <span class="ml-2 text-sm text-[#5efcff]">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-[#5efcff] hover:underline transition duration-150 ease-in-out">
                        Forgot Password?
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <div class="flex items-center justify-end mt-6">
                <button type="submit"
                    class="w-full bg-[#00252c] text-white font-semibold py-2 px-4 transition duration-300">
                    Login
                </button>
            </div>
            <div class="text-center mt-6 text-white text-sm sm:text-base">
                <span>Don't have an account? Sign up</span><br />
                <a href="{{ route('register') }}"
                    class="text-[#5efcff] hover:underline hover:text-[#5efcff] transition duration-200">
                    Sign Up
                </a>
            </div>
        </form>
    </div>
@endsection