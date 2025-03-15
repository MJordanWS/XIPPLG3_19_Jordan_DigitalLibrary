<?php

namespace App\Http\Controllers;

use App\Models\loans;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    public function index()
    {
        $loans = loans::all();

        return response()->json([
            'status' => 200,
            'message' => 'loans retrieved successfully',
            'data' => $loans
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer',
            'user_id' => 'required|integer',
            'loan_date' => 'required|date',
            'return_date' => 'required|date',
            'status' => 'required|string|max:255'
        ]);

        $loans = loans::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'loans created successfully',
            'data' => $loans
        ], 201);
    }

    public function show($id)
    {
        $loans = loans::find($id);

        if (!$loans) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found',
                'data' => null
                ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'loans retrieved successfully',
            'data' => $loans
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $loans = loans::find($id);

        if (!$loans) {
            return response()->json([
                'status' => 404,
                'message' => 'loans not found',
                'data' => null
            ], 404);
        }

        $request->validate([
            'book_id' => 'required|integer',
            'user_id' => 'required|integer',
            'loan_date' => 'required|date',
            'return_date' => 'required|date',
            'status' => 'required|string|max:255'
        ]);
        
        $loans->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'loans updated successfully',
            'data' => $loans
        ], 200);
    }

    public function destroy($id)
    {
        $loans = loans::find($id);

        if (!$loans) {
            return response()->json([
                'status' => 404,
                'message' => 'loans not found',
                'data' => null
            ], 404);
        }

        $loans->delete();

        return response()->json([
            'status' => 200,
            'message' => 'loans deleted successfully',
            'data' => null
        ], 200);
    }
}
