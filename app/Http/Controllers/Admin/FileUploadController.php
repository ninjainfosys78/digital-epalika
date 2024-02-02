<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class FileUploadController extends Controller
{
    /**
     * @throws UploadFailedException
     */
    public function chunkFileStore(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
            return response()->json(['message' => 'File not uploaded'], 500);
        }

        $fileReceived = $receiver->receive(); // receive file

        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $path = Storage::disk('public')->putFile('file/'.Str::slug($file->getClientOriginalExtension()), $file);
            // delete chunked file
            unlink($file->getPathname());

            return [
                'url' => Storage::disk('public')->url($path),
                'path' => $path,
                'filename' => $file->getClientOriginalName(),
            ];
        }

        // otherwise return percentage information
        $handler = $fileReceived->handler();

        return [
            'done' => $handler->getPercentageDone(),
            'status' => true,
        ];
    }
}
