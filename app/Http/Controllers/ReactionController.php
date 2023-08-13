<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $existingReaction = Reaction::where('post_id', $request->post_id)->first();

        if ($existingReaction) {
            // Reaction exists, update it
            $existingReaction->update([
                'reaction' => $request->reaction,
            ]);

            return response()->json([
                'success' => true,
                'data' => $existingReaction,
                'message' => 'Reaction updated successfully',
            ]);
        } else {
            // Reaction doesn't exist, create it
            $newReaction = Reaction::create([
                'post_id' => $request->post_id,
                'reaction' => $request->reaction,
            ]);

            return response()->json([
                'success' => true,
                'data' => $newReaction,
                'message' => 'Reaction created successfully',
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
