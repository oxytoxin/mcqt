<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubcategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(Category::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $questionCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Category $questionCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $questionCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $questionCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $questionCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $questionCategory)
    {
        //
    }

    public function subcategories(Category $category)
    {
        return SubcategoryResource::collection($category->subcategories()->withCount('mcqt_items')->get());
    }
}
