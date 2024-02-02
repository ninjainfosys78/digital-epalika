<?php

namespace App\Http\Livewire;

use  Modules\Recommendation\Entities\SipharisCategory;
use  Modules\Recommendation\Entities\SipharisSubCategory;

use Livewire\Component;

class Sipharis extends Component
{
    public $sipharis_category_id = null;

    public $sipharis_sub_category_id = '';

    public $sipharishCategories = [];
    public $sipharishSubCategories = [];
    public $siharisFormFields = [];
    public $sipharisFormTypes = [];

    public $selectedCategory = null;

    public function mount($categorySubCategory = null)
    {

        if (!empty($categorySubCategory)) {
            $this->sipharis_category_id = $categorySubCategory['sipharis_category_id'] ?? '';
            $this->sipharis_sub_category_id = $categorySubCategory['sipharis_sub_category_id'] ?? '';

        }
    }

    public function render()
    {
        // if (!empty($this->sipharis_category_id)) {
        //   $this->sipharishSubCategories = SipharisSubCategory::getSipharisSubCategoryByCategoryId($this->sipharis_category_id);
        // }


        $this->sipharishCategories = SipharisCategory::getActiveSipharis();
        $this->sipharishSubCategories = SipharisSubCategory::getActiveSubCategory();


        return view('livewire.sipharis');
    }

    public function upSelectedCategory($id)
    {
        //dd($id);
        $this->sipharishSubCategories = SipharisSubCategory::getSipharisSubCategoryByCategoryId($id);

    }
}
