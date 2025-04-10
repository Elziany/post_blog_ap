<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\updatePostRequest;
use App\Services\PostService;
use App\Services\ResponseService;

class PostController extends Controller
{
    protected PostService $postService;
    protected ResponseService $responseService;
    public function __construct(PostService $postService , ResponseService $responseService)
    {
        $this->responseService = $responseService;
        $this->postService = $postService;
    }
    

    public function getPosts()
    {
        $posts = $this->postService->getAllPosts();
        return $this->responseService->success($posts);
    }
    public function getPostsByUser($userId)
    {
        $posts = $this->postService->getPostsByUser($userId);
        return $this->responseService->success($posts);
    }

    public function getPost($id)
    {
        $post = $this->postService->getPost($id);
        if (!$post) {
            return $this->responseService->error('Post not found', 404);
        }
        return $this->responseService->success($post);
    }

    public function createPost(CreatePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $post = $this->postService->createPost($data);
        return $this->responseService->success($post, 'Post created successfully', 201);
        
    }

    public function updatePost(updatePostRequest $request, $id)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $post = $this->postService->updatePost($id, $data);
        return $this->responseService->success($post, 'Post updated successfully');
    }

    public function deletePost($id)
    {
        $this->postService->deletePost($id);
        return $this->responseService->success(null, 'Post deleted successfully');
    }
}
