<?php

namespace App\Http\Controllers;

use App\Filters\SupermarketsFilter;
use App\Http\Resources\SupermarketCollection;
use App\Models\Supermarket;
use App\Http\Requests\StoreSupermarketRequest;
use App\Http\Requests\UpdateSupermarketRequest;
use App\Http\Resources\SupermarketResource;
use App\Services\AuditLogService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SupermarketController extends Controller
{
    public $auditLogService;

    public function __construct(AuditLogService $auditLogService)
    {
        $this->auditLogService = $auditLogService;
    }
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

            Log::info($supermarkets);

            return new SupermarketCollection($supermarkets->appends($request->query()));
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupermarketRequest $request)
    {

        $user = Auth::user();

        $supermarket = Supermarket::create($request->all());

        $this->auditLogService->storeAction('store', 'supermarkets', $supermarket->id, $user->id);

        return new SupermarketResource($supermarket);
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

        $user = Auth::user();

        $supermarket->update($request->all());

        $this->auditLogService->storeAction('update', 'supermarkets', $supermarket->id, $user->id);

        response()->json(['message' => 'Supermarket updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supermarket $supermarket)
    {
        try 
        {

            $user = Auth::user();

            $supermarket->delete();

            $this->auditLogService->storeAction('delete', 'supermarkets', $supermarket->id, $user->id);

            return response()->json(['message' => 'Supermarket deleted successfully'], 200);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => 'Failed to delete supermarket.', 'details' => $e->getMessage()], 500);
        }
    }
}
