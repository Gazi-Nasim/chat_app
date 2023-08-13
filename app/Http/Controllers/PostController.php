<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $datas = Post::with('comnts', 'reacts')->orderByDesc('id')->get();
        // dd($datas);
        // return view('post', compact('datas'));
        return response()->json([
            'datas' => $datas,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            // Add more validation rules as needed
        ]);

        $image = Image::make($request->file('picture'));
        $imageName = time() . '_' . $request->file('picture')->getClientOriginalName();
        $image->resize(1920, 1080);
        $image->save(public_path('assets/images/posts/') . $imageName);

        $data = Post::create([
            'picture' => $imageName,
            'caption' => $request->input('caption'),
        ]);

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Posted Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, Post $post)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function getLatestPosts()
    {
        // $latestPosts = Post::orderByDesc('created_at')->take(10)->get();
        // return response()->json([
        //     'success' => true,
        //     'posts' => $latestPosts,
        // ]);
    }
}
