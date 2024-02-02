<?php

namespace Modules\BusinessRegistration\Observers;

use Illuminate\Support\Str;
use Modules\BusinessRegistration\Entities\BusinessRenew;

class BusinessRenewObserver
{
    public function creating(BusinessRenew $businessRenew): void
    {
        $reg_no = BusinessRenew::whereFiscalYearId(\officeSetting()->fiscal_year_id)
                ->max('reg_no') + 1;
        $businessRenew->reg_no = $reg_no;
        $businessRenew->registration_no = 'BRR-' . officeSetting()->fiscalYear->title . '-' . Str::padLeft($reg_no, 4, 0);
    }
}
