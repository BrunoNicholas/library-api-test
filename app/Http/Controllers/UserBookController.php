<?php

namespace App\Http\Controllers;

use App\Models\UserBook;
use Illuminate\Http\Request;
use App\Http\Requests\UserBook as UserBookRequest;
use App\Http\Resources\UserBook as UserBookResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\UserBookCollection;
use App\Models\Book;

class UserBookController extends Controller
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
        if (sizeof(UserBook::all()) < 1) {
            return json_encode([
                'errors' => 'No saved users with books found'
            ]);
        }
        
        return UserBookCollection::collection(UserBook::latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userbook           = new UserBook();
        $userbook->user_id  = $request->user;
        $userbook->book_id  = $request->book;
        $userbook->due_at   = $request->time_due;
        $userbook->save();

        return json_encode([

            'message' => 'User book record saved successfully',
            'data'  => new UserBookResource($userbook)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserBook  $userBook
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userbook = Book::find($id);

        if (!$userbook) {
            return json_encode([
                'errors' => 'Record not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new UserBookResource($userbook);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserBook  $userBook
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

        $request['user_id']  = $request->user;
        $request['book_id']  = $request->book;
        $request['due_at']   = $request->time_due;
        $request['returned_at']      = $request->date_returned;
        unset($request['user']);
        unset($request['year']);
        unset($request['time_due']);
        unset($request['date_returned']);

        $book->update($request->all());

        return json_encode([
            'data' => new UserBookResource($book)
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserBook  $userBook
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userbook = UserBook::find($id);
        
        if (!$userbook) {
            return json_encode([
                'errors' => 'No user with the book record found'
            ], Response::HTTP_NOT_FOUND);
        }

        $userbook->delete();
        
        return json_encode(
            ['message' => 'User book record deleted successfully'],
            Response::HTTP_NO_CONTENT
        );
    }
}
