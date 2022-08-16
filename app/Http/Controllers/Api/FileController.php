<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadRequest;
use App\Http\Resources\FileCollection;
use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return FileCollection
     */
    public function index()
    {
        return new FileCollection(File::select(['path','type'])->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UploadRequest $request
     * @return JsonResponse
     */
    public function store(UploadRequest $request)
    {
        $data = $request->validated();

        $file = File::create([
            'type' => $type = $data['type'],
            'path' => Storage::disk('public')->putFile("files/$type", $data['file'])
        ]);

        return new JsonResponse(['message' => __("message.created", ["attribute" => __("file")]), 'url' => $file->path], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        $file = File::firstWhere('path', $request->path);
        if (!$file){
            return new JsonResponse(['message' => __("message.not_found", ["attribute" => __("file")])], Response::HTTP_NOT_FOUND);
        }
        Storage::disk('public')->delete($file->path);
        $file->delete();

        return new JsonResponse(['message' => __("message.deleted", ["attribute" => __("file")])], Response::HTTP_OK);
    }
}
