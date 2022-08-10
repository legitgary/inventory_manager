<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreItemRequest;
use App\Http\Requests\v1\UpdateItemRequest;
use App\Http\Requests\v1\IncreaseItemRequest;
use App\Http\Requests\v1\DecreaseItemRequest;
use App\Http\Resources\v1\ItemResource;
use App\Http\Resources\v1\ItemCollection;
use App\Models\Item;
use App\Filters\v1\ItemsFilter;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = new ItemsFilter();
        $filterItems = $filter->transform($request);
        
        $items = Item::where($filterItems);

        return new ItemCollection($items->paginate()->appends($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\v1\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        return new ItemResource(Item::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\v1\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->all());

        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json(['message' => 'Item has been deleted'], 200);
    }

    /**
     * Increase item stock.
     *
     * @param  \App\Http\Requests\v1\IncreaseItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function stockIncrease(IncreaseItemRequest $request, Item $item)
    {
        /* pass only the specific fields that this function may change */
        $item->update($request->only(['quantity']));

        return new ItemResource($item);
    }

    /**
     * Decrease item stock.
     *
     * @param  \App\Http\Requests\v1\DecreaseItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function stockDecrease(DecreaseItemRequest $request, Item $item)
    {
        /* pass only the specific fields that this function may change */
        $item->update($request->only(['quantity']));

        return new ItemResource($item);
    }
}
