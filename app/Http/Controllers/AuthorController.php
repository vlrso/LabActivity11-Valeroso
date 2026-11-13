<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        // count only published posts; withCount avoids a query per author
        $authors = Author::withCount(['posts' => function ($q) {
            $q->where('is_published', true);
        }])->orderBy('name')->get();

        return view('authors.index', compact('authors'));
    }

    public function show(Author $author)
    {
        $posts = $author->posts()
            ->where('is_published', true)
            ->latest('published_at')
            ->get();

        // hasManyThrough: comments on this author's posts
        $commentsReceived = $author->comments()->count();

        return view('authors.show', compact('author', 'posts', 'commentsReceived'));
    }
}
