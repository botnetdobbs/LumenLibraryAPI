<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    public function index(Request $request, Author $author)
    {
        if ($request->has('name')) {
            // Convert to lowercase due to postgres errors with using "ILIKE" on tests.
            $name = strtolower(htmlentities($request->name));
            $result = $author->whereRaw('LOWER(name) like (?)',"%{$name}%")->get()->toArray();
            return !empty($result) ? $result : response()->json(["status" => "error", "message" => "author not in our records"], 404);
        }
        return $author->paginate(8);
    }

    /**
     * Return a specific author
     *
     * @param [type] $id
     * @return void
     */
    public function show($id)
    {
        try {
            $author = Author::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            
            return response()->json(["status" => "error", "message" => $e->getMessage()], 404);
        }
        return response()->json($author, 200);
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

    /**
     * Update an existing author's details
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:55',
            'bio' => 'max:300',
            'email' => 'email|unique:authors'
        ]);
        
        try {
            $author = Author::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            
            return response()->json(["status" => "error", "message" => $e->getMessage()], 404);
        }
        $author->update($request->all());

        return response()->json([], 200);
    }

    /**
     * Delete an author
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        try {
            $author = Author::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(["status" => "error", "message" => $e->getMessage()], 404);
        }
        $author->delete();
        return response()->json([], 200);
    }
    
}
