<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\McqtCategoryResource;
use App\Http\Resources\McqtItemResource;
use App\Models\McqtCategory;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return McqtCategoryResource::collection(McqtCategory::get());
    }

    public function items(McqtCategory $category)
    {
        return response()->json([
            'category' => $category->name,
            'data' => McqtItemResource::collection($category->mcqt_items()->paginate(200)),
        ]);
    }
}
