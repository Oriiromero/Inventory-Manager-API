<?php

namespace App\Http\Controllers;

use App\Filters\SupermarketsFilter;
use App\Http\Resources\SupermarketCollection;
use App\Models\Supermarket;
use App\Http\Requests\StoreSupermarketRequest;
use App\Http\Requests\UpdateSupermarketRequest;
use App\Http\Resources\SupermarketResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SupermarketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new SupermarketsFilter();
        $queryItems = $filter->transform($request);

        if(count($queryItems) == 0)
        {
            return new SupermarketCollection(Supermarket::paginate());
        }
        else
        {
            $supermarkets = Supermarket::where($queryItems)->paginate();

            return new SupermarketCollection($supermarkets->appends($request->query()));
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupermarketRequest $request)
    {
        return new SupermarketResource(Supermarket::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Supermarket $supermarket)
    {
        return new SupermarketResource($supermarket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupermarketRequest $request, Supermarket $supermarket)
    {
        $supermarket->update($request->all());

        response()->json(['message' => 'Supermarket updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supermarket $supermarket)
    {
        try 
        {
            $supermarket->delete();

            return response()->json(['message' => 'Supermarket deleted successfully'], 200);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => 'Failed to delete supermarket.', 'details' => $e->getMessage()], 500);
        }
    }
}
