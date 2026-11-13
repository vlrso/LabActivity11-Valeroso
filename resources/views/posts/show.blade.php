@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article class="rounded bg-white p-6 shadow">
        <header>
            @if ($post->is_pinned)
                <span class="rounded bg-yellow-400 px-2 py-1 text-xs font-semibold">Pinned</span>
            @endif
            <h1 class="mt-2 text-2xl font-bold">{{ $post->title }}</h1>
            <p class="mt-1 text-sm text-gray-500">
                {{ $post->category }} · {{ $post->published_at->format('M d, Y') }}
                · {{ $post->views }} views ·
                By <a href="{{ route('authors.show', $post->author) }}" class="underline">{{ $post->author->name }}</a>
            </p>
            <ul class="mt-2 flex flex-wrap gap-1">
                @foreach ($post->tags as $tag)
                    <li class="rounded bg-blue-100 px-2 py-1 text-xs text-blue-800">{{ $tag->name }}</li>
                @endforeach
            </ul>
        </header>

        <p class="mt-4 whitespace-pre-line">{{ $post->body }}</p>
    </article>

    <section class="rounded bg-white p-6 shadow">
        <h2 class="text-lg font-semibold">Comments ({{ $post->comments->count() }})</h2>

        @auth
            @if ($errors->any())
                <section class="mt-3 rounded bg-red-100 p-3 text-red-800">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </section>
            @endif

            <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-3 space-y-2">
                @csrf
                <label for="body" class="block font-semibold">Add a comment</label>
                <textarea id="body" name="body" rows="3" class="w-full rounded border p-2">{{ old('body') }}</textarea>
                @error('body') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                <button type="submit" class="rounded bg-emerald-600 px-4 py-2 text-white">Post comment</button>
            </form>
        @endauth

        @guest
            <p class="mt-3"><a href="{{ route('login') }}" class="underline">Sign in to comment</a></p>
        @endguest

        <ul class="mt-4 space-y-3">
            @forelse ($post->comments as $comment)
                <li class="border-b pb-2">
                    <p class="text-sm font-semibold">{{ $comment->user->name }}</p>
                    <p>{{ $comment->body }}</p>
                    <p class="text-xs text-gray-500">{{ $comment->created_at->format('M d, Y g:i A') }}</p>
                </li>
            @empty
                <li>No comments yet.</li>
            @endforelse
        </ul>
    </section>

    <p><a href="{{ route('posts.index') }}" class="underline">Back to all posts</a></p>
@endsection