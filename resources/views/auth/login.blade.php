<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login - {{ config('app.name', 'Laravel') }}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite('resources/css/app.css')
    </head>

    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full max-w-md">

            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-2 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Login untuk memulai</h2>
            </div>

            @if($errors->any())
                <div class="bg-red-100 text-red-700 text-sm p-3 rounded mt-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-sm">
                <form method="POST" action="{{ route('authenticate') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email Address</label>
                        <div class="mt-2">
                            <input
                                id="email"
                                type="email"
                                name="email"
                                required
                                placeholder="Masukkan Email Address"
                                autocomplete="email"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            />
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        <div class="mt-2">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan Password"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            />
                        </div>

                        <div class="mt-2 text-sm text-right">
                            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Lupa password?</a>
                        </div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Masuk
                        </button>
                    </div>
                </form>

                <p class="mt-2 text-right text-sm/6 text-gray-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">
                        Registrasi di sini</a>
                </p>
            </div>
        </div>
    </body>
</html>
