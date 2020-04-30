<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User as UserRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
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
        if (sizeof(User::all()) < 1) {
            return json_encode([
                'errors' => 'No saved users found'
            ]);
        }

        return UserCollection::collection(User::latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return json_encode([
            'message' => 'User added successfully',
            'data'  => new UserResource($user)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return json_encode([
                'errors' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return json_encode([
                'errors' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $user->update($request->all());

        return json_encode([
            'data' => new UserResource($user)
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return json_encode([
                'errors' => 'User profile not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $user->delete();
        
        return json_encode(
            ['message' => 'User profile deleted successfully'],
            Response::HTTP_NO_CONTENT
        );
    }
}
