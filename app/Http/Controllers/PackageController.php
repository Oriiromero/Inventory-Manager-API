<?php

namespace App\Http\Controllers;

use App\Filters\PackagesFilter;
use App\Services\AuditLogService;
use Illuminate\Http\Request;
use App\Http\Resources\PackageResource;
use App\Models\Package;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Http\Resources\PackageCollection;
use Exception;

class PackageController extends Controller
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
        $filter = new PackagesFilter();
        $filterItems = $filter->transform($request);

        $includeSupermarkets = $request->query('includeSupermarkets');

        $packages = Package::where($filterItems);

        if($includeSupermarkets)
        {
            $packages = $packages->with('supermarket');
        }

        return new PackageCollection($packages->paginate()->appends($request->query()));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request)
    {
        $package = Package::create($request->all());

        $this->auditLogService->storeAction('store', 'packages', $package->id);

        return new PackageResource($package);
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        $includeSupermarkets = request()->query('includeSupermarkets');

        if($includeSupermarkets)
        {
            return new PackageResource($package->load('supermarket'));
        }

        return new PackageResource($package);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        $package->update($request->all());

        $this->auditLogService->storeAction('update', 'packages', $package->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        try 
        {
            $package->delete();

            $this->auditLogService->storeAction('delete', 'packages', $package->id);

            return response()->json(['message' => 'Package deleted successfully'], 200);
        }
        catch(Exception $e)
        {
            return response()->json(['message' => 'Failed to delete package.', 'details' => $e->getMessage()], 500);
        }
    }
}
