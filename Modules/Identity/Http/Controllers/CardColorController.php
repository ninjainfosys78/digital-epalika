<?php

namespace Modules\Identity\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Modules\Identity\Entities\CardColor;
use Modules\Identity\Http\Requests\CardColor\StoreCardColorRequest;
use Modules\Identity\Http\Requests\CardColor\UpdateCardColorRequest;

class CardColorController extends Controller
{
    public function index()
    {
        $this->checkAuthorization('cardColor_access');

        $cardColors = CardColor::where(function (Builder $q) {
            if (!is_null(request('search'))) {
                $q->whereLike(['title'], request('search'));
            }
        })
            ->latest()->paginate(10);
        ;

        return view('identity::admin.setting.cardColor.index', compact('cardColors'));
    }

    public function create()
    {
        $this->checkAuthorization('cardColor_create');
        return view('identity::admin.setting.cardColor.create');
    }

    public function store(StoreCardColorRequest $request)
    {
        $this->checkAuthorization('cardColor_create');

        CardColor::create($request->validated());
        toast('रंग  सफलतापूर्वक थपियो', 'success');
        return back();
    }

    public function show(CardColor $cardColor)
    {
        $this->checkAuthorization('cardColor_access');
        return view('identity::show');
    }

    public function edit(CardColor $cardColor)
    {
        $this->checkAuthorization('cardColor_edit');
        return view('identity::admin.setting.cardColor.edit', compact('cardColor'));
    }

    public function update(UpdateCardColorRequest $request, CardColor $cardColor)
    {
        $this->checkAuthorization('cardColor_edit');
        $cardColor->update($request->validated());
        toast('रंग सफलतापूर्वक अद्यावधिक गरियो', 'success');
        return redirect(route('identity.admin.setting.cardColor.index'));
    }

    public function destroy(CardColor $cardColor)
    {
        $this->checkAuthorization('cardColor_delete');
        $cardColor->delete();
        toast('रंग सफलतापूर्वक मेटियो', 'success');
        return back();
    }
}
