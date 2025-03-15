<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Books::all();

        return response()->json([
            'status' => 200,
            'message' => 'books retrieved successfully',
            'data' => $books
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'writer' => 'required|string|max:255',
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer'
        ]);

        $books = Books::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Books created successfully',
            'data' => $books
        ], 201);
    }

    public function show($id)
    {
        $books = Books::find($id);

        if (!$books) {
            return response()->json([
                'status' => 404,
                'message' => 'Books not found',
                'data' => null
                ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Books retrieved successfully',
            'data' => $books
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $books = Books::find($id);

        if (!$books) {
            return response()->json([
                'status' => 404,
                'message' => 'Books not found',
                'data' => null
            ], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'writer' => 'required|string|max:255',
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer'
        ]);
        $books->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Books updated successfully',
            'data' => $books
        ], 200);
    }

    public function destroy($id)
    {
        $books = Books::find($id);

        if (!$books) {
            return response()->json([
                'status' => 404,
                'message' => 'Books not found',
                'data' => null
            ], 404);
        }

        $books->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Books deleted successfully',
            'data' => null
        ], 200);
    }
}
