@extends('layouts.app')

@section('title', 'Barangay Bulletin – Purok Valeroso')

@section('content')
    <h1 class="text-2xl font-bold">Barangay Bulletin – Purok Valeroso</h1>

    <form method="GET" action="{{ route('posts.index') }}" class="flex flex-col gap-2 sm:flex-row">
        <label for="q" class="sr-only">Search title</label>
        <input id="q" name="q" value="{{ request('q') }}" placeholder="Search title"
               class="w-full rounded border p-2">

        <label for="category" class="sr-only">Category</label>
        <select id="category" name="category" class="rounded border p-2">
            <option value="">All categories</option>
            @foreach ($categories as $c)
                <option value="{{ $c }}" @selected(request('category') === $c)>{{ $c }}</option>
            @endforeach
        </select>

        <label for="tag" class="sr-only">Tag</label>
        <select id="tag" name="tag" class="rounded border p-2">
            <option value="">All tags</option>
            @foreach ($tags as $t)
                <option value="{{ $t }}" @selected(request('tag') === $t)>{{ $t }}</option>
            @endforeach
        </select>

        <button type="submit" class="rounded bg-emerald-600 px-4 py-2 text-white">Filter</button>
    </form>

    <section class="grid gap-4 sm:grid-cols-2 md:grid-cols-3">
        @forelse ($posts as $post)
            <article class="rounded bg-white p-4 shadow">
                @if ($post->is_pinned)
                    <span class="rounded bg-yellow-400 px-2 py-1 text-xs font-semibold">Pinned</span>
                @endif

                <h2 class="mt-2 text-lg font-semibold">
                    <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">
                        {{ $post->title }}
                    </a>
                </h2>

                <p class="mt-1">
                    <span class="rounded bg-emerald-100 px-2 py-1 text-xs text-emerald-800">
                        {{ $post->category }}
                    </span>
                </p>

                <ul class="mt-2 flex flex-wrap gap-1">
                    @foreach ($post->tags as $tag)
                        <li class="rounded bg-blue-100 px-2 py-1 text-xs text-blue-800">{{ $tag->name }}</li>
                    @endforeach
                </ul>

                <p class="mt-2 text-sm text-gray-500">
                    {{ $post->published_at->format('M d, Y') }}
                    · {{ $post->views }} views · {{ $post->comments_count }} comments
                </p>
                <p class="text-sm text-gray-500">
                    By <a href="{{ route('authors.show', $post->author) }}" class="underline">{{ $post->author->name }}</a>
                </p>
            </article>
        @empty
            <p>No posts match your search.</p>
        @endforelse
    </section>

    <nav>
        {{ $posts->links() }}
    </nav>

    <p class="text-sm text-gray-500">
        Showing {{ $posts->firstItem() }}–{{ $posts->lastItem() }} of {{ $posts->total() }} posts
    </p>
@endsection