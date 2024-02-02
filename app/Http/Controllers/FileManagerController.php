<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    public function index()
    {
        $directories = Storage::disk('editor')->allDirectories();

        return view('admin.file-manager.index', compact('directories'));
    }

    public function createDirectory()
    {
    }
}
