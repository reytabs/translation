<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Translation;
use App\Models\Locale;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use DB;
use App\Http\Requests\StoreTranslationRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
    public function store(Request $request)
    {
        $translation = DB::transaction(function () use ($request) {
            if ($locale = Locale::where('code', $request->input('locale_code'))->first())
                $request->merge(['locale_id' => $locale->id]);
            
            $tagIds = [];

            foreach ($request->input('tags') as $tag) {
                $tagModel = Tag::firstOrCreate(['name' => $tag]);
                $tagIds[] = $tagModel->id;
            }

            $translation = Translation::create($request->all());

            $translation->tags()->sync($tagIds);

            return $translation;
        });

        return response()->json(['success' => true, 'data' => $translation], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        $translation = Translation::find($id);
        $updateTranslation = $translation->update($request->only(['key', 'value']));
        return response()->json(['success' => true, 'data' => $translation], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);

        $query = Translation::query();

        if ($request->has('q')) {
            $query->search($request->input('q'));
        }

        if ($request->has('tag')) {
            $query->withTag($request->input('tag'));
        }

        if ($request->has('locale')) {
            $query->withLocale($request->input('locale'));
        }

        $translations = $query->with(['tags', 'locale'])->paginate($perPage);

        return response()->json(['success' => true, 'data' => $translations], 200);
    }

    public function export()
    {
        $translations = Translation::with('locale')->get();

        $exportData = [];

        foreach ($translations as $translation) {
            $localeCode = $translation->locale->code;
            if (!isset($exportData[$localeCode])) {
                $exportData[$localeCode] = [];
            }
            $exportData[$localeCode][$translation->key] = $translation->value;
        }

        // Define the file name
        $fileName = 'export.json';

        // Store the file temporarily (optional, you can also generate on the fly)
        Storage::disk('local')->put($fileName, json_encode($exportData));

        // Return the file as a download response
        return Storage::download($fileName);
    
    }
}
