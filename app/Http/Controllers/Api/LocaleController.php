<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Locale;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreLocaleRequest;
use App\Http\Requests\UpdateLocaleRequest;

class LocaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // 
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
    public function store(StoreLocaleRequest $request)
    {
        $locale = Locale::create($request->validated());
        return response()->json(['success' => true, 'data' => $locale], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $locale = Locale::find($id);
        return response()->json(['success' => true, 'data' => $locale], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocaleRequest $request, string $id)
    {
        $locale = Locale::findOrFail($id);
        $locale->update($request->validated());
        return response()->json(['success' => true, 'data' => $locale], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
