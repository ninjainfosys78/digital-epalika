<?php

namespace Modules\DigitalBoard\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\DigitalBoard\Entities\Video;
use Modules\DigitalBoard\Http\Requests\Video\StoreVideoRequest;
use Modules\DigitalBoard\Http\Requests\Video\UpdateVideoRequest;
use Illuminate\Database\Eloquent\Builder;

class VideoController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('digitalBoardVideo_access');

        $videos = Video::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['title'], request('search'));
            }
        })
        ->latest()->paginate(10);


        return view('digitalboard::admin.video.index', compact('videos'));
    }

    public function create()
    {
        $this->checkAuthorization('digitalBoardVideo_create');

        return view('digitalboard::admin.video.create');
    }

    public function store(StoreVideoRequest $request)
    {
        $this->checkAuthorization('digitalBoardVideo_create');

        Video::create($request->validated());

        toast('भिडियो सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function show(Video $video)
    {
        $this->checkAuthorization('digitalBoardVideo_access');
    }

    public function edit(Video $video)
    {
        $this->checkAuthorization('digitalBoardVideo_edit');

        return view('digitalboard::admin.video.edit', compact('video'));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        $this->checkAuthorization('digitalBoardVideo_edit');
        if ($video->video !== $request->input('video')) {
            $this->deleteFile($video->video);
        }

        $video->update($request->validated());

        toast('भिडियो सफलतापूर्वक अपडेट गरियो', 'success');

        return redirect(route('admin.digitalBoard.video.index'));
    }

    public function destroy(Video $video)
    {
        $this->checkAuthorization('digitalBoardVideo_delete');

        if ($video->video) {
            $this->deleteFile($video->video);
        }
        $video->delete();

        toast('भिडियो सफलतापूर्वक मेटियो', 'success');

        return back();
    }
}
