@extends('layouts.app')

@section('title', $author->name)

@section('content')
    <header>
        <h1 class="text-2xl font-bold">{{ $author->name }}</h1>
        <p class="text-gray-500">{{ $author->position }}</p>
        <p class="mt-1">{{ $commentsReceived }} comments received</p>
    </header>

    <section class="rounded bg-white p-4 shadow">
        <h2 class="mb-2 text-lg font-semibold">Published posts</h2>
        <ul class="space-y-2">
            @forelse ($posts as $post)
                <li>
                    <a href="{{ route('posts.show', $post->id) }}" class="underline">{{ $post->title }}</a>
                    <span class="text-sm text-gray-500">
                        · {{ $post->category }} · {{ $post->published_at->format('M d, Y') }}
                    </span>
                </li>
            @empty
                <li>No published posts yet.</li>
            @endforelse
        </ul>
    </section>

    <p><a href="{{ route('posts.index') }}" class="underline">Back to all posts</a></p>
@endsection