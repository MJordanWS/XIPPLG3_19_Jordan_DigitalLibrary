<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $review = Reviews::all();

        return response()->json([
            'status' => 200,
            'message' => 'Reviews retrieved successfully',
            'data' => $review
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer',
            'user_id' => 'required|integer',
            'rating' => 'required|integer',
            'comment' => 'required|string|max:255',
            'created_date' => 'required|date'
        ]);

        $review = Reviews::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Reviews created successfully',
            'data' => $review
        ], 201);
    }

    public function show($id)
    {
        $review = Reviews::find($id);

        if (!$review) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found',
                'data' => null
                ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Reviews retrieved successfully',
            'data' => $review
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $review = Reviews::find($id);

        if (!$review) {
            return response()->json([
                'status' => 404,
                'message' => 'Reviews not found',
                'data' => null
            ], 404);
        }

        $request->validate([
            'book_id' => 'required|integer',
            'user_id' => 'required|integer',
            'rating' => 'required|integer',
            'comment' => 'required|string|max:255',
            'created_date' => 'required|date'
        ]);

        $review->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Reviews updated successfully',
            'data' => $review
        ], 200);
    }

    public function destroy($id)
    {
        $review = Reviews::find($id);

        if (!$review) {
            return response()->json([
                'status' => 404,
                'message' => 'Reviews not found',
                'data' => null
            ], 404);
        }

        $review->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Reviews deleted successfully',
            'data' => null
        ], 200);
    }
}
