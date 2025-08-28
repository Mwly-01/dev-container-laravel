<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Traits\ApiResponse;
//importar TODO eliminar
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
        use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //hacer un select * from posts
        // return  response()->json(DB::table("posts"))->get();
        return $this->ok("Todo bueno", Post::get());    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $newPost = new Post();
        // $result = $newPost->fill($request->only(['title', 'content','status']))->save();
        // return $this->ok("Post creado", $result);

        $newPost = Post::updateOrcreate(
            ['title'=>$request->title],
            $request->only(['title', 'content','status']));
        return $this->ok("Post creado", [$newPost]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = Post::find($id);
        if($result){
            return $this->ok("WESNO", $result);
        }else{
            return $this->success("No se encontro el post", $result, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
