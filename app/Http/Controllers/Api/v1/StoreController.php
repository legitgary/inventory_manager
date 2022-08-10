<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreStoreRequest;
use App\Http\Requests\v1\UpdateStoreRequest;
use App\Http\Resources\v1\StoreResource;
use App\Http\Resources\v1\StoreCollection;
use App\Models\Store;
use App\Filters\v1\StoresFilter;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = new StoresFilter();
        $filterItems = $filter->transform($request);

        $stores = Store::where($filterItems);

        $includeItems = $request->has('includeItems');

        if ($includeItems) {
            $stores->with('items');
        }

        return new StoreCollection($stores->paginate()->appends($request->query()));
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
     * @param  \App\Http\Requests\StoreStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreRequest $request)
    {
        return new StoreResource(Store::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        $includeItems = request()->has('includeItems');

        if ($includeItems) {
            return new StoreResource($store->loadMissing('items'));
        }

        return new StoreResource($store);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreRequest  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        $store->update($request->all());
        
        return new StoreResource($store);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->delete();

        return response()->json(['message' => 'Store has been deleted'], 200);
    }
}
