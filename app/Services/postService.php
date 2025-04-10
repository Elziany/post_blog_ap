<?php
namespace App\Services;

use App\Repositories\PostRepository;

class PostService
{
    protected PostRepository $postRepository;
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function createPost($data)
    {
        $post = $this->postRepository->createPost($data);
        return $post;
       
    }
    public function updatePost($postId, $data)
    {
        $post = $this->postRepository->getPost($postId);
        if (!$post) {
            throw new \Exception('Post not found');
        }
        if ($post->user_id !== $data['user_id']) {
            throw new \Exception('Unauthorized action');
        }
        $post = $this->postRepository->updatePost($post, $data);
        return $post; 
       
    }   
    public function deletePost($postId)
    {
        $post = $this->postRepository->getPost($postId);
        if (!$post) {
            throw new \Exception('Post not found');
        }
        $this->postRepository->deletePost($post);
        return true;
     
    }
    public function getPost($postId)
    {
        return $this->postRepository->getPost($postId);
    }
    public function getAllPosts()
    {
        return $this->postRepository->getAllPosts();
    }
    public function getPostsByUser($userId)
    {
        return $this->postRepository->getPostsByUser($userId);
    }
}