@extends('layouts.app')
@section('content')
    <main class="flex items-center justify-center min-h-[calc(100vh-12rem)]">
        <div class="text-center max-w-3xl">
            <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                <span class="block xl:inline">Selamat Datang di</span>
                <span class="block text-indigo-600 xl:inline">{{ config('app.name') }}</span>
            </h1>
            <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg md:mt-5 md:text-xl">
                Sistem informasi modern untuk mengelola layanan dan informasi secara mudah, cepat, dan aman.
            </p>
            <div class="mt-5 sm:mt-8 flex justify-center">
                <a href="{{ route('loan.form') }}"
                   class="rounded-md bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-md hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Ajukan Pinjaman
                </a>
            </div>
        </div>
    </main>
@endsection
