<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 9;

        $query = Post::query()
            ->with(['author', 'tags'])
            ->withCount('comments')
            ->where('is_published', true);

        if ($request->filled('q')) {
                $query->where('title', 'like', '%' . $request->q . '%');
            }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('name', $request->tag);
            });
        }

        $posts = $query
            ->orderByDesc('is_pinned')
            ->latest('published_at')
            ->paginate($perPage)
            ->withQueryString(); // keeps ?q= and ?category= on page links

        $categories = Post::query()->distinct()->orderBy('category')->pluck('category');
        $tags = Tag::orderBy('name')->pluck('name');

        return view('posts.index', compact('posts', 'categories', 'tags'));
    }

    public function show($id)
    {
        // drafts are filtered out, so a draft id gives a 404
        $post = Post::where('is_published', true)->findOrFail($id);

        $post->views = $post->views + 1;
        $post->save();

        // newest comments first, with each commenter loaded too
        $post->load([
            'author',
            'tags',
            'comments' => fn ($q) => $q->latest(),
            'comments.user',
        ]);

        return view('posts.show', compact('post'));
    }

    public function create(Request $request)
    {
        abort_unless($request->user()->author()->exists(), 403);

        $categories = Post::CATEGORIES;
        $tags = Tag::orderBy('name')->get();

        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        // tags go to the pivot table through sync(), not into the post row
        $tagIds = $data['tags'];
        unset($data['tags']);

        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        $post = $request->user()->author->posts()->create($data);
        $post->tags()->sync($tagIds);

        if ($post->is_published) {
            return redirect()->route('posts.show', $post->id)->with('status', 'Post published.');
        }

        // drafts are hidden from the show page (404), so go to the list
        return redirect()->route('posts.index')->with('status', 'Draft saved.');
    }
}