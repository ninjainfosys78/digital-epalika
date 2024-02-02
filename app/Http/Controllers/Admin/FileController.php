<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $all_uploads = File::where(function ($query) {
            if (auth()->user()->role->type !== 'Super') {
                $query->where('user_id', auth()->id())
                    ->orWhere('branch_id', auth()->user()->branch_id);
            }
        });

        $search = null;
        $sort_by = null;

        if ($request->input('search') != null) {
            $search = $request->input('search');
            $all_uploads->where('file_original_name', 'like', '%' . $search . '%');
        }

        $sort_by = $request->input('sort');
        switch ($sort_by) {
            case 'oldest':
                $all_uploads->orderBy('created_at');
                break;
            case 'smallest':
                $all_uploads->orderBy('file_size');
                break;
            case 'largest':
                $all_uploads->orderBy('file_size', 'desc');
                break;
            case 'newest':
            default:
                $all_uploads->orderBy('created_at', 'desc');
                break;
        }

        $all_uploads = $all_uploads->paginate(60)
            ->appends(request()->query());


        return view('admin.file-manager.file', compact('all_uploads', 'search', 'sort_by'));
    }

    public function show(File $file): JsonResponse
    {
        return response()->json([
            'fileName' => $file->file_name,
            'uploaded' => true,
            'url' => $file->file_url,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        if ($request->hasFile('upload')) {
            $file = File::create([
                'file_name' => pathinfo($request->file('upload')?->getClientOriginalName(), PATHINFO_FILENAME),
                'extension' => $request->file('upload')?->getClientOriginalExtension(),
                'file' => $request->file('upload')?->store('editor/file', 'public'),
            ]);

            return response()->json([
                'fileName' => $file->file_name,
                'uploaded' => true,
                'url' => $file->file_url,
            ]);
        }

        return response()->json([
            'uploaded' => false,
        ]);
    }

    public function storeInStorage(Request $request): JsonResponse
    {
        $request->validate([
            'upload' => ['required']
        ]);
        if ($request->hasFile('upload')) {
            $file_name = pathinfo($request->file('upload')?->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->file('upload')?->getClientOriginalExtension();
            $file = $request->file('upload')?->store('recommendation/', 'public');

            return response()->json([
                'fileName' => $file_name,
                'uploaded' => true,
                'url' => $file,
                'extension' => $extension,
            ]);
        }

        return response()->json([
            'uploaded' => false,
        ]);
    }

    public function destroy(File $file)
    {
        if ($file->file) {
            $this->deleteFile($file->file);
        }

        $file->delete();
        toast('फाइल सफलतापूर्वक मेटियो', 'success');

        return back();
    }

    public function download(File $file)
    {
        return Storage::disk('public')->download($file->file, $file->file_name . $file->extension);
    }

    public function downloadFile()
    {
        //        dd($_GET['file_url']);
        if (!empty($_GET['file_url']) && Storage::disk('public')->exists($_GET['file_url'])) {
            return Storage::disk('public')->download($_GET['file_url']);
        } else {
            toast('माफ गर्नुहोस् फाइल फेला परेन', 'error');
            return back();
        }
    }

    public function getFileManager()
    {
        $folder = request()->folder;
        if (!empty($folder)) {
            return getAllFilesAndFolder($folder);
        } else {
            return [
                'directories' => [],
                'files' => [],
            ];
        }
    }

    public function fileUpload(Request $request)
    {
        $file = $request->file('upload');
        $path = 'ckEditor/' . date("Y-m-d");
        $filename = $file->getClientOriginalName();
        $counter = 1;
        while (Storage::disk('public')->exists($path . $filename)) {
            $filename = $counter . '_' . $file->getClientOriginalName();
            $counter++;
        }

        $path = $file->storePubliclyAs($path, $filename, 'public');

        return response()->json([
            'url' => Storage::disk('public')->url($path)
        ]);
    }
}
