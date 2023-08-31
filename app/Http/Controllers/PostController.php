<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreUpdateRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index(): JsonResponse
    {
        $posts = Post::all();

        return response()->json($posts);
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json($post);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $requestForm = new PostStoreUpdateRequest();
        $validator = Validator::make(request()->all(), $requestForm->rules(), [], $requestForm->attributes() );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $data = $validator->validated();

        Post::create(
            array_merge($data, [
                'title' => json_encode($data['title']),
                'body' => json_encode($data['body']),
                'userId' => request()->user()->id
            ])
        );

        return response()->json(['success' => 'Record has been created']);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Post $post): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $requestForm = new PostStoreUpdateRequest();
        $validator = Validator::make(request()->all(), $requestForm->rules(), [], $requestForm->attributes() );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $data = $validator->validated();

        $post->update($data);

        return response()->json(['success' => 'Record has been updated']);
    }
}
