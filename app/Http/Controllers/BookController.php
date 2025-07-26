<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('books.index', compact('books'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'nullable',
            'genre' => 'nullable',
            'publisher' => 'nullable',
            'description' => 'nullable',
            'rating' => 'nullable|numeric|between:0,5',
            'year' => 'nullable|date',
            'thumbnail' => 'nullable',
        ]);

        $data['bookId'] = Uuid::uuid4()->toString();

        Book::create($data); 

        return redirect()->route('books.index')
                         ->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::find($id);
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'nullable',
            'genre' => 'nullable',
            'publisher' => 'nullable',
            'description' => 'nullable',
            'rating' => 'nullable|numeric|between:0,5',
            'year' => 'nullable|date',
            'thumbnail' => 'nullable',
        ]);

        $book = Book::find($id);
        $book->update($request->all());

        return redirect()->route('books.index')
                         ->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('books.index')
                         ->with('success', 'Book deleted successfully.');
    }
}
