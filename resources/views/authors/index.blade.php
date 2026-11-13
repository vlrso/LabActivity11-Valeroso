@extends('layouts.app')

@section('title', 'Authors')

@section('content')
    <h1 class="text-2xl font-bold">Authors</h1>

    <section class="grid gap-4 sm:grid-cols-2 md:grid-cols-3">
        @forelse ($authors as $author)
            <article class="rounded bg-white p-4 shadow">
                <h2 class="text-lg font-semibold">
                    <a href="{{ route('authors.show', $author) }}" class="hover:underline">{{ $author->name }}</a>
                </h2>
                <p class="text-sm text-gray-500">{{ $author->position }}</p>
                <p class="mt-1 text-sm">{{ $author->posts_count }} published posts</p>
            </article>
        @empty
            <p>No authors yet.</p>
        @endforelse
    </section>

    <p><a href="{{ route('posts.index') }}" class="underline">Back to all posts</a></p>
@endsection