<?php

namespace Modules\DigitalBoard\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckNoticeType implements Rule
{
    private $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function passes($attribute, $value)
    {
    }

    public function message()
    {
        return 'document is required.';
    }
}
