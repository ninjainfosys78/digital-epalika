<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DateLivewire extends Component
{
    public $name_ne = 'date_ne';

    public $name_en = 'date';

    public $label_ne = 'मिति';

    public $label_en = 'date';

    public $nepali_date = '';

    public $english_date = '';

    public function mount()
    {
    }

    protected function getListeners()
    {
        return ['postAdded' => 'incrementPostCount'];
    }

    public function incrementPostCount($nepaliDate, $englishDate)
    {
        $this->nepali_date = $nepaliDate;
        $this->english_date = $englishDate;
    }

    public function render()
    {
        return view('livewire.date-livewire');
    }
}
