<?php

namespace App\Http\Controllers;

use App\Http\Resources\PackageResource;
use App\Models\Package;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::with('supermarket')->get();
        return $packages;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request)
    {
        //
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

        // $package->load('supermarket');

        // return $package;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        //
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
