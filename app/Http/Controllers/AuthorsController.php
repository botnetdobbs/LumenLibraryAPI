<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return all the authors
     *
     * @return void
     */
    public function index()
    {
        return Author::paginate(8);
    }

    /**
     * Create new author
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:55|unique:authors',
            'bio' => 'max:300',
            'email' => 'email|unique:authors'
        ]);

        $author = Author::create($request->all());
        return response()->json($author->only(['name', 'email', 'bio']), 201);
    }
    
}
