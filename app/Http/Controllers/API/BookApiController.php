<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;

class BookApiController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return response()->json($books);
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'nullable',
            'genre' => 'nullable',
            'publisher' => 'nullable',
            'description' => 'nullable',
            'rating' => 'nullable|numeric|between:0,5',
            'year' => 'nullable|date',
            'thumbnail' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $validator->validated();
        $data['bookId'] = Uuid::uuid4()->toString();

        $book = Book::create($data);

        return response()->json($book, 201);
    }

    /**
     * Display the specified book.
     */
    public function show(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book);
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'nullable',
            'genre' => 'nullable',
            'publisher' => 'nullable',
            'description' => 'nullable',
            'rating' => 'nullable|numeric|between:0,5',
            'year' => 'nullable|date',
            'thumbnail' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $book->update($validator->validated());

        return response()->json($book);
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}