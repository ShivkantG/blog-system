@extends('layouts.app')
@section('dashboard')
<div class="w-full flex flex-col gap-4 sm:gap-6">
    <!-- Page Heading -->
    <div class="bg-white dark:bg-[#0d6a7c] shadow-md p-[18px]  flex justify-center items-center">
        <h1 class="text-xl font-bold text-[#0d6a7c] dark:text-[#5efcff]">Dashboard Overview</h1>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-4">
        <!-- Total Hon Entries -->
        <div class="bg-white dark:bg-[#0d6a7c] shadow-md p-4 border-l-4 border-[#0d6a7c] dark:border-[#5efcff]">
            <h2 class="text-sm font-semibold text-[#0d6a7c] dark:text-[#5efcff] mb-2">Total Hon Entries</h2>
            {{-- <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $honCount }}</p> --}}
        </div>
    </div>
</div>