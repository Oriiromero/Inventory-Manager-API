<?php

namespace App\Http\Controllers;

use App\Filters\PackageMovesFilter;
use App\Http\Resources\PackageMoveCollection;
use App\Models\PackageMove;
use App\Http\Requests\StorePackageMoveRequest;
use App\Http\Requests\UpdatePackageMoveRequest;
use Illuminate\Http\Request;

class PackageMoveController extends Controller
{
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

        if ($includePackage && $includeUser) {
            $packageMoves = $packageMoves->with('package', 'user');
        } elseif ($includePackage) {
            $packageMoves = $packageMoves->with('package');
        } elseif ($includeUser) {
            $packageMoves = $packageMoves->with('user');
        }

        return new PackageMoveCollection($packageMoves->paginate()->appends($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageMoveRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PackageMove $packageMove)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackageMove $packageMove)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageMoveRequest $request, PackageMove $packageMove)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageMove $packageMove)
    {
        //
    }
}
