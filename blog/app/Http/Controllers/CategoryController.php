<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Category::paginate(10);

        return CategoryResource::collection($cats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat = $request->isMethod('put') ? Category::findOrFail($request->cat_id) : new Category;

        $cat->id = $request->input('cat_id');

        $cat->name = $request->input('name');
        
        $cat->description = $request->input('desc');

        if($cat->save()){
            return new CategoryResource($cat);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = Category::findOrFail($id);

        return new CategoryResource($cat);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::findOrFail($id);

        if($cat->delete()){
            return new CategoryResource($cat);
        }
    }
}
