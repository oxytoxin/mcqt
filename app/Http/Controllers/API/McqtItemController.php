<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\McqtItemResource;
use App\Models\McqtItem;
use Illuminate\Http\Request;

class McqtItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return McqtItemResource::collection(McqtItem::paginate(50));
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
     * @param  \App\Models\McqtItem  $questionItem
     * @return \Illuminate\Http\Response
     */
    public function show(McqtItem $questionItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\McqtItem  $questionItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, McqtItem $questionItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\McqtItem  $questionItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(McqtItem $questionItem)
    {
        //
    }
}
