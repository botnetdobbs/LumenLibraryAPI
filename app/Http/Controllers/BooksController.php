<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Book;

class BooksController extends Controller
{
    public function index()
    {
        return Book::with('author')->paginate(8);
    }
}