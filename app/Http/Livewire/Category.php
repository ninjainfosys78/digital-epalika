<?php

namespace App\Http\Livewire;

use  Modules\Recommendation\Entities\SipharisCategory;
use  Modules\Recommendation\Entities\SipharisSubCategory;

use Livewire\Component;

class Category extends Component
{
    public $sipharis_category_id = null;

    public $sipharis_sub_category_id = null;

    public $sipharishCategories = [];
    public $sipharishSubCategories = [];


    public function mount($categorySubCategory = null): void
    {

        if (!empty($categorySubCategory)) {
            $this->sipharis_category_id = $categorySubCategory['sipharis_category_id'] ?? '';
            $this->sipharis_sub_category_id = $categorySubCategory['sipharis_sub_category_id'] ?? '';
        }
        $this->sipharishCategories = SipharisCategory::status()->get();
    }

    public function render()
    {
        if (!empty($this->sipharis_category_id)) {
            $this->sipharishSubCategories = SipharisSubCategory::whereSipharisCategoryId($this->sipharis_category_id)
                ->active()
                ->get();
        }

        return view('livewire.category');
    }
}
