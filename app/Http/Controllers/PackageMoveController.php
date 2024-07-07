<?php

namespace App\Http\Controllers;

use App\Filters\PackageMovesFilter;
use App\Http\Resources\PackageMoveCollection;
use App\Http\Resources\PackageMoveResource;
use App\Models\PackageMove;
use App\Http\Requests\StorePackageMoveRequest;
use App\Http\Requests\UpdatePackageMoveRequest;
use App\Services\AuditLogService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PackageMoveController extends Controller
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
        $filter = new PackageMovesFilter();
        $filterItems = $filter->transform($request);

        $includePackage = $request->query('includePackage');
        $includeUser = $request->query('includeUser');

        $packageMoves = PackageMove::where($filterItems);

        if ($includePackage && $includeUser) 
        {
            $packageMoves = $packageMoves->with('package', 'user');

        } elseif ($includePackage) 
        {
            $packageMoves = $packageMoves->with('package');

        } elseif ($includeUser) 
        {
            $packageMoves = $packageMoves->with('user');

        }

        return new PackageMoveCollection($packageMoves->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageMoveRequest $request)
    {

        $user = Auth::user();

        $packageMove = PackageMove::create($request->all());

        $this->auditLogService->storeAction('store', 'packageMoves', $packageMove->id, $user->id); 

        return new PackageMoveResource($packageMove);

    }

    /**
     * Display the specified resource.
     */
    public function show(PackageMove $packageMove)
    {
        $includePackage = request()->query('includePackage');
        $includeUser= request()->query('includeUser');

        if ($includePackage && $includeUser) 
        {
           return new PackageMoveResource($packageMove->load('package', 'user'));

        } elseif ($includePackage) 
        {
            return new PackageMoveResource($packageMove->load('package'));

        } elseif ($includeUser) 
        {
            return new PackageMoveResource($packageMove->load('user'));

        }

        return new PackageMoveResource($packageMove);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageMoveRequest $request, PackageMove $packageMove)
    {

        $user = Auth::user();

        $packageMove->update($request->all());

        $this->auditLogService->storeAction('update', 'packageMoves', $packageMove->id, $user->id);

        return response()->json(['message' => 'Package move updated correctly.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageMove $packageMove)
    {
        try 
        {

            $user = Auth::user();

            $packageMove->delete();

            $this->auditLogService->storeAction('delete', 'packageMove', $packageMove->id, $user->id);

            return response()->json(['message' => 'Package deleted successfully'], 200);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => 'Failed to delete package.', 'details' => $e->getMessage()], 500);
        }
    }
}
