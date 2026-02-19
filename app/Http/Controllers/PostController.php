<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $posts = Post::latest()->get();

    return response()->json([
        'posts' => $posts,
        'success' => true,
    ], 200);
}


  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
   {
        // Validate request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable',
        ]);

        // Create post using validated data
        $post = Post::create($validated);

        if ($post) {
            return response()->json([
                'post' => $post,
                'message' => 'Post created successfully',
                'success' => true,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Post not created',
                'success' => false,
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find post by ID
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found',
                'success' => false,
            ], 404);
        }

        return response()->json([
            'post' => $post,
            'success' => true,
        ], 200);
    }


  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find post
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found',
                'success' => false,
            ], 404);
        }

        // Validate input
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'sometimes|nullable|string', // or file later
        ]);

        // Update post
        $post->update($validated);

        return response()->json([
            'post' => $post,
            'message' => 'Post updated successfully',
            'success' => true,
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find post
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found',
                'success' => false,
            ], 404);
        }

        // Delete post
        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully',
            'success' => true,
        ], 200);
    }

}
