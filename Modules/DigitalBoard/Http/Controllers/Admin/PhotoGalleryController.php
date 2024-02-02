<?php

namespace Modules\DigitalBoard\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\DigitalBoard\Entities\PhotoGallery;
use Modules\DigitalBoard\Http\Requests\PhotoGallery\StorePhotoGalleryRequest;
use Modules\DigitalBoard\Http\Requests\PhotoGallery\UpdatePhotoGalleryRequest;

class PhotoGalleryController extends Controller
{
    public function index()
    {
        $photoGalleries = PhotoGallery::get();

        return view('digitalboard::admin.photoGallery.index', compact('photoGalleries'));
    }

    public function create()
    {
        return view('digitalboard::admin.photoGallery.create');
    }

    public function store(StorePhotoGalleryRequest $request)
    {

        PhotoGallery::create($request->validated());
        toast('फोटो ग्यालरी सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show($id)
    {
        // return view('digitalboard::show');
    }

    public function edit(PhotoGallery $photoGallery)
    {
        return view('digitalboard::admin.photoGallery.edit', compact('photoGallery'));
    }

    public function update(UpdatePhotoGalleryRequest $request, PhotoGallery $photoGallery)
    {
        $photoGallery->update($request->validated());

        toast('फोटो ग्यालरी सफलतापूर्वक अपडेट गरियो', 'success');

        return redirect(route('admin.digitalBoard.photoGallery.index'));
    }

    public function destroy(PhotoGallery $photoGallery)
    {
        $photoGallery->delete();

        toast('फोटो ग्यालरी सफलतापूर्वक मेटियो', 'success');

        return back();
    }
}
