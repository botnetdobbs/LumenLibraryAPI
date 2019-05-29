<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Book;

class BooksController extends Controller
{
    /**
     * Returns all the books
     *
     * @return void
     */
    public function index(Request $request)
    {
        return Book::with('author')->paginate(8);
    }

    /**
     * Returns a single book
     *
     * @param [type] $isbn
     * @return void
     */
    public function show($isbn)
    {
        try {
            $book = Book::with('author')->findOrFail($isbn);
        } catch (ModelNotFoundException $e) {
            return response()->json(["status" => "error", "message" => $e->getMessage()], 404);
        }
        return $book;
    }

    /**
     * Store a book in the records
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'genre' => 'required',
            'isbn' => 'required|unique:books',
            'author_id' => 'required'
        ]);

        $book = Book::create($request->all());
        return response()->json($book, 201);
    }

    /**
     * @test
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request, $isbn)
    {
        try {
            $book = Book::findOrFail($isbn);
        } catch (ModelNotFoundException $e) {
            
            return response()->json(["status" => "error", "message" => $e->getMessage()], 404);
        }
        $book->update($request->all());

        return response()->json([], 200);
    }

    /**
     * Delete a specific book
     *
     * @param mixed $isbn
     * @return void
     */
    public function destroy($isbn)
    {
        try {
            $book = Book::findOrFail($isbn);
        } catch (ModelNotFoundException $e) {
            
            return response()->json(["status" => "error", "message" => $e->getMessage()], 404);
        }
        $book->delete();
        return response()->json([], 204);
    }
}