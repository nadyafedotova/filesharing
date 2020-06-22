<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * @var FileService
     */
    protected $fileService;

    /**
     * Create a new controller instance
     *
     * @param FileService $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Display last 10 uploaded files
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->has("search")) {
            $searchFiles = File::where("original_name", "like", "%{$request->search}%")->take(10)->paginate(5);

            return view("files.search", ["files" => $searchFiles, "search" => $request->search]);
        }

        $lastFiles = File::orderBy("id", "desc")->take(100)->paginate(2);

        return view("files.index", ["files" => $lastFiles]);
    }

    /**
     * Upload a new file in storage.
     *
     * @param FileUploadRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FileUploadRequest $request)
    {
        $this->fileService->handleUploadedFile($request->file("file"));
        return response()->json(["success" => "success"]);
    }

    /**
     * Show individual file page
     *
     * @param $id File id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $file = File::where("id", $id)->firstOrFail();
        return view("files.show", ["file" => $file]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        File::find($id)->delete();
        return redirect('files')->with('success', 'File deleted!');
    }
}
