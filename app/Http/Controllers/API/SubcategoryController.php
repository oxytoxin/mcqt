<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\McqtItemResource;
use App\Http\Resources\SubcategoryResource;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string',
        ]);
        $subcategories = Subcategory::query()
            ->when($request->has('search'), function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->search}%");
            })
            ->with('category')
            ->paginate();
        return SubcategoryResource::collection($subcategories);
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
     * @param  \App\Models\Subcategory  $questionSubcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $questionSubcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $questionSubcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $questionSubcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $questionSubcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $questionSubcategory)
    {
        //
    }

    public function mcqt_items(Subcategory $subcategory)
    {
        return McqtItemResource::collection($subcategory->mcqt_items()->paginate(5))
            ->additional([
                'meta' => [
                    'subcategory' => SubcategoryResource::make($subcategory),
                ],
            ]);
    }
}
