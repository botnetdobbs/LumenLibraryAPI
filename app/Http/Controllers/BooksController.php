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
    public function index()
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
}