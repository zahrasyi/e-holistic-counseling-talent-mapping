<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('asset/homepage/logo-konseling.png') }}">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-sky-50">

    <div class="flex h-screen">
        <div class="hidden lg:flex w-[45%] bg-cover bg-center relative"
            style="background-image: url('{{ asset('asset/login/masjidz3a.png') }}')">
            <div class="absolute top-10 left-10">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-4">
                    <img class="h-14 w-14" src="{{ asset('asset/homepage/logo-konseling.png') }}"
                        alt="UNIDA Gontor Logo">
                    {{-- <div class="text-unida-blue font-semibold leading-tight">
                        <p class="font-arabic text-lg tracking-wider">جامعة دار السلام كونتور</p>
                        <p class="text-xs  tracking-widest">UNIVERSITAS DARUSSALAM GONTOR</p>
                    </div> --}}
                </a>
            </div>
        </div>

        <div class="w-full lg:w-[55%] flex items-center justify-center bg-white lg:rounded-l-[70px]">
            <div class="w-full max-w-sm p-4">

                <div class="text-center mb-8">
                    <h2 class="text-4xl font-bold text-gray-800">Sign In</h2>
                </div>

                @error('email')
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p>{{ $message }}</p>
                </div>
                @enderror

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                <path
                                    d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full p-4 pl-12 pr-4 bg-gray-100 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition">
                    </div>

                    <div class="relative mb-4" x-data="{ show: false }">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input id="password" :type="show ? 'text' : 'password'" name="password" required
                            class="w-full p-4 pl-12 pr-12 bg-gray-100 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition">
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                            <button type="button" @click="show = !show" class="text-gray-400 hover:text-gray-600">
                                <svg x-show="!show" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.243 4.243L6.228 6.228" />
                                </svg>
                                <svg x-show="show" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit"
                            class="w-full p-4 bg-unida-blue hover:bg-blue-800 text-white font-bold rounded-lg transition-colors mt-4">
                            Sign In
                        </button>
                    </div>
                </form>

                <p class="text-center text-gray-600 mt-6">
                    Don't Have an Account?
                    <a href="{{ route('register.show') }}" class="font-semibold text-sky-500 hover:underline">Register
                        Now!</a>
                </p>
                <p class="text-center text-gray-600 mt-6">
                    <a href="{{ route('home') }}" class="font-semibold  text-sky-500 hover:underline"> back to
                        home</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>