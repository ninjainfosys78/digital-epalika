<?php

namespace App\Http\Livewire;

use App\Models\OfficeHeader;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OfficeHeaderLivewire extends Component
{
    public $officeHeaders = [];

    public $title;
    public $title_en;

    public $font_color;
    public $card_font;

    public $font_size;

    public $position;

    public $font;

    public function mount()
    {
    }

    protected $rules = [

        'officeHeaders.*.title' => ['required', 'string', 'max:255'],
        'officeHeaders.*.title_en' => ['required', 'string', 'max:255'],
        'officeHeaders.*.font_color' => ['nullable'],
        'officeHeaders.*.card_font' => ['nullable'],
        'officeHeaders.*.font_size' => ['required', 'max:255'],
        'officeHeaders.*.position' => ['nullable', 'integer'],
        'officeHeaders.*.font' => ['required'],

    ];

    public function addOfficeHeader()
    {
        $this->officeHeaders[] = [];
    }

    public function removeOfficeHeader($index)
    {
        if (array_key_exists('id', $this->officeHeaders[$index])) {
            OfficeHeader::find($this->officeHeaders[$index]['id'])->delete();
        }
        unset($this->officeHeaders[$index]);
        $this->officeHeaders = array_values($this->officeHeaders);
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            foreach ($this->officeHeaders as $officeHeader) {
                OfficeHeader::create($officeHeader);
            }
        });

        Cache::forget('officeHeaders');
        return redirect(route('admin.global.systemSetting.officeSetting.index'));
    }

    public function render()
    {
        return view('livewire.office-header');
    }
}
