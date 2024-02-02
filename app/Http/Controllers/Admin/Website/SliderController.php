<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Slider\StoreSliderRequest;
use App\Http\Requests\Website\Slider\UpdateSliderRequest;
use App\Models\Website\Slider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class SliderController extends Controller
{
    public function index(): Factory|View|Application
    {
        $this->checkAuthorization('slider_access');

        $sliders = Slider::all();
        return view('admin.website.slider.index', compact('sliders'));
    }

    public function create(): Factory|View|Application
    {
        $this->checkAuthorization('slider_create');
        return view('admin.website.slider.create');
    }

    public function store(StoreSliderRequest $request): RedirectResponse
    {
        $this->checkAuthorization('slider_create');
        Slider::create($request->validated());

        toast('स्लाइडर सफलतापूर्वक थपियो', 'success');

        return back();
    }

    public function edit(Slider $slider): Factory|View|Application
    {
        $this->checkAuthorization('slider_edit');
        return view('admin.website.slider.edit', compact('slider'));
    }

    public function update(UpdateSliderRequest $request, Slider $slider): Redirector|Application|RedirectResponse
    {
        $this->checkAuthorization('slider_edit');

        if ($request->hasFile('image') && $slider->image) {
            $this->deleteFile($slider->image);
        }

        $slider->update($request->validated());

        toast('स्लाइडर सफलतापूर्वक अद्यावधिक गरियो', 'success');

        return redirect(route('admin.global.website.slider.index'));
    }

    public function destroy(Slider $slider): RedirectResponse
    {
        $this->checkAuthorization('slider_delete');
        if ($slider->image) {
            $this->deleteFile($slider->image);
        }
        $slider->delete();
        toast('स्लाइडर सफलतापूर्वक मेटाइयो', 'success');

        return back();
    }
}
