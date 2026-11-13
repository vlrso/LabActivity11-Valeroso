<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Barangay Bulletin – Purok Valeroso')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">
    <header class="bg-emerald-700 text-white">
        <nav class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-2 p-4">
            <a href="{{ route('posts.index') }}" class="font-semibold hover:underline">
                Barangay Bulletin – Purok Valeroso
            </a>

            <div class="flex items-center gap-3">
                <a href="{{ route('authors.index') }}" class="hover:underline">Authors</a>

                @auth
                    @php
                        // direct query, so preventLazyLoading doesn't complain
                        $myAuthor = auth()->user()->author()->first();
                    @endphp

                    @if ($myAuthor)
                        <a href="{{ route('posts.create') }}" class="hover:underline">New post</a>
                    @endif

                    <div class="leading-tight">
                        <p>Hi, {{ auth()->user()->name }}</p>
                        @if ($myAuthor)
                            <p class="text-xs">
                                <a href="{{ route('authors.show', $myAuthor) }}" class="underline">Check profile</a>
                            </p>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="underline">Logout</button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="underline">Sign in</a>
                @endguest
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-5xl space-y-4 p-4 sm:px-6">
        @if (session('status'))
            <p class="rounded bg-green-100 p-3 text-green-800">{{ session('status') }}</p>
        @endif

        @yield('content')
    </main>

    <footer class="mx-auto max-w-5xl p-4 text-sm text-gray-500">
        <p>Barangay Matina Crossing Hall, Davao City</p>
    </footer>
</body>
</html>