<?php

namespace Modules\Identity\Http\Livewire;

use Livewire\Component;
use Modules\Identity\Entities\SeniorCitizenDetail;

class SearchCitizenshipLivewire extends Component
{
    public $citizenship_no = null;

    protected $rules = [
        'citizenship_no' => ['required']
    ];

    public function searchCitizenshipNo()
    {
        $this->validate();

        if ($seniorCitizenDetail = SeniorCitizenDetail::where('citizenship_no', $this->citizenship_no)->first()) {
            return redirect(route('identity.admin.seniorCitizenDetail.show', $seniorCitizenDetail));
        } else {
            $this->dispatchBrowserEvent('toast_message', [
                'type' => 'error',
                'title' => 'नागरिकता नं. फेला परेन'
            ]);
            return redirect(route('identity.admin.seniorCitizenDetail.create', ['citizenship_no' => $this->citizenship_no]));
        }
    }

    public function render()
    {
        return view('identity::livewire.search-citizenship-livewire');
    }
}
