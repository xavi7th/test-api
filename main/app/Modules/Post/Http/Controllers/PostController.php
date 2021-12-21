<?php

namespace App\Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Modules\Website\Models\Website;
use Illuminate\Contracts\Support\Renderable;
use App\Modules\Post\Http\Requests\CreatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('post::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('post::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param CreatePostRequest $request
     */
    public function store(CreatePostRequest $request, Website $website)
    {
      $post = $request->createPost();

      return response()->json($post, 201);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('post::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('post::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
