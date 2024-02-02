<?php

namespace Modules\DigitalBoard\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\DigitalBoard\Entities\Audio;
use Modules\DigitalBoard\Http\Requests\Audio\StoreAudioRequest;
use Modules\DigitalBoard\Http\Requests\Audio\UpdateAudioRequest;

class AudioController extends Controller
{
    public function index()
    {
        $audios = Audio::get();

        return view('digitalboard::admin.audio.index', compact('audios'));
    }

    public function create()
    {
        return view('digitalboard::admin.audio.create');
    }

    public function store(StoreAudioRequest $request)
    {
        Audio::create($request->validated());

        toast('अडियो सफलतापूर्वक थपियो', 'success');

        return back();


    }

    public function show($id)
    {
        // return view('digitalboard::show');
    }

    public function edit(Audio $audio)
    {
        return view('digitalboard::admin.audio.edit', compact('audio'));
    }

    public function update(UpdateAudioRequest $request, Audio $audio)
    {
        $audio->update($request->validated());

        toast('अडियो सफलतापूर्वक अपडेट गरियो', 'success');

        return redirect(route('admin.digitalBoard.audio.index'));
    }

    public function destroy(Audio $audio)
    {

        $audio->delete();

        toast('अडियो सफलतापूर्वक मेटियो', 'success');

        return back();
    }
}
