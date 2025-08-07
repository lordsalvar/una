<?php

namespace App\Http\Controllers;

use App\Enums\PostType;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Enums\PostTypeResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class PostsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Posts/Index', [
            'posts' => PostResource::collection(
                Post::query()
                    ->with([
                        'creator',
                    ])
                    ->latest()
                    ->paginate(5)
                    ->withQueryString()
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Posts/Create', [
            'types' => PostTypeResource::unwrapped(
                PostType::cases()
            ),
        ]);
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        $post = Post::create($request->only(
            'title',
            'content',
            'type',
            'is_exclusive',
        ));

        return Redirect::route('posts.show', $post)
            ->withSuccess('Successfully created new post');
    }

    public function show(Post $post): Response
    {
        return Inertia::render('Posts/Show', [
            'post' => PostResource::make($post),
        ]);
    }

    public function edit(Post $post): Response
    {
        return Inertia::render('Posts/Edit', [
            'post' => PostResource::make($post),
            'types' => PostTypeResource::unwrapped(
                PostType::cases()
            ),
        ]);
    }

    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->only(
            'title',
            'content',
            'type',
            'is_exclusive',
        ));

        return Redirect::route('posts.show', $post)
            ->withSuccess('Successfully updated post details');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return Redirect::route('posts.index')
            ->withSuccess('Post has been deleted');
    }
}
