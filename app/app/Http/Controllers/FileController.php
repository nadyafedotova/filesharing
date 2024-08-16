<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class FileController extends Controller
{

    public function __construct(
        protected FileService $fileService,
    )
    {
    }

    final public function index(Request $request): View|Factory|Application
    {
        if ($request->has("search")) {
            $searchFiles = File::where("original_name", "like", "%{$request->search}%")->take(10)->paginate(5);

            return view("files.search", ["files" => $searchFiles, "search" => $request->search]);
        }

        $lastFiles = File::orderBy("id", "desc")->take(100)->paginate(2);

        return view("files.index", ["files" => $lastFiles]);
    }

    final public function store(FileUploadRequest $request): JsonResponse
    {
        $this->fileService->handleUploadedFile($request->file("file"));

        return response()->json(["success" => "success"]);
    }

    final public function show(File $id): Factory|View
    {
        $file = File::where("id", $id)->firstOrFail();

        return view("files.show", [
            "file" => $file
        ]);
    }

    final public function destroy(int $id): Application|RedirectResponse|Redirector
    {
        File::find($id)->delete();

        return redirect('files')->with('success', 'File deleted!');
    }
}
