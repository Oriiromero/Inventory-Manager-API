<?php

namespace App\Http\Controllers;

use App\Filters\PackagesFilter;
use Illuminate\Http\Request;
use App\Http\Resources\PackageResource;
use App\Models\Package;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Http\Resources\PackageCollection;

class PackageController extends Controller
{
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
        return new PackageResource(Package::create($request->all()));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        //
    }
}
