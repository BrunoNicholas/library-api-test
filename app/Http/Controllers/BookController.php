<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\Book as BookRequest;
use App\Http\Resources\Book as BookResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\BookCollection;

class BookController extends Controller
{
    /**
     * Display the constructor of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('auth:api')->except('index','show'); // uncomment to restrict to auth
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (sizeof(Book::all()) < 1) {
            return json_encode([
                'errors' => 'No saved books found'
            ], Response::HTTP_NOT_FOUND);
        }
        
        return BookCollection::collection(Book::latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book           = new Book();
        $book->title    = $request->title;
        $book->original_title   = $request->original;
        $book->publication_year = $request->year;
        $book->isbn     = $request->isbn;
        $book->language_code    = $request->language;
        $book->image    = $request->image;
        $book->thumbnail        = $request->thumbnail;
        $book->average_rating   = $request->average_rating;
        $book->total_ratings    = $request->total_ratings;
        $book->save();

        return json_encode([

            'message' => 'Book added successfully',
            'data'  => new BookResource($book)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return json_encode([
                'errors' => 'Book not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return json_encode([
                'errors' => 'Book not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $request['original_title']  = $request->original;
        $request['publication_year']  = $request->year;
        $request['language_code']   = $request->language;
        unset($request['original']);
        unset($request['year']);
        unset($request['language']);

        $book->update($request->all());

        return json_encode([
            'data' => new BookResource($book)
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        
        if (!$book) {
            return json_encode([
                'errors' => 'Book record not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $book->delete();
        
        return json_encode(
            ['message' => 'Book record deleted successfully'],
            Response::HTTP_NO_CONTENT
        );
    }
}
