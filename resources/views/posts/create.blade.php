@extends('layouts.app')

@section('title', 'New post')

@section('content')
    <h1 class="text-2xl font-bold">New post</h1>

    @if ($errors->any())
        <section class="rounded bg-red-100 p-3 text-red-800">
            <h2 class="font-semibold">Please fix the following:</h2>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </section>
    @endif

    <form method="POST" action="{{ route('posts.store') }}" class="space-y-4 rounded bg-white p-6 shadow">
        @csrf

        <p>
            <label for="title" class="block font-semibold">Title</label>
            <input id="title" type="text" name="title" value="{{ old('title') }}" class="w-full rounded border p-2">
            @error('title') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </p>

        <p>
            <label for="body" class="block font-semibold">Body</label>
            <textarea id="body" name="body" rows="6" class="w-full rounded border p-2">{{ old('body') }}</textarea>
            @error('body') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </p>

        <p>
            <label for="category" class="block font-semibold">Category</label>
            <select id="category" name="category" class="rounded border p-2">
                <option value="">Choose a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>
                @endforeach
            </select>
            @error('category') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </p>

        <fieldset>
            <legend class="font-semibold">Tags</legend>
            @foreach ($tags as $tag)
                <label class="mr-3 inline-block">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                           @checked(in_array($tag->id, old('tags', [])))>
                    {{ $tag->name }}
                </label>
            @endforeach
            @error('tags') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            @error('tags.*') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </fieldset>

        <p>
            <label>
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published'))>
                Publish now
            </label>
            @error('is_published') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </p>

        <button type="submit" class="rounded bg-emerald-600 px-4 py-2 text-white">Save post</button>
    </form>

    <p><a href="{{ route('posts.index') }}" class="underline">Back to all posts</a></p>
@endsection