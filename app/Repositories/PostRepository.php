<?php 
namespace App\Repositories;
use App\Models\Post;
use App\Models\User;
class PostRepository
{

    public function createPost(array $data)
    {
        $post = new Post();
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->user_id = $data['user_id'];
        $post->save();
        return $post;
    }

    public function updatePost($post, array $data)
    {
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->user_id = $data['user_id'];
        $post->save();
        return $post;
    }
    public function deletePost($post)
    {
        return $post->delete();
    }
    public function getPost($id)
    {
        return Post::findOrFail($id);
    }
    public function getAllPosts()
    {
        return Post::with('user')->get();
    }
    public function getPostsByUser($userId)
    {
        return Post::where('user_id', $userId)->get();
    }
}
