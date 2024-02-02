<?php

namespace App\Http\Controllers\Installer;

use App\Http\Controllers\Controller;
use App\Installer\RequirementsChecker;

class RequirementController extends Controller
{
    protected RequirementsChecker $requirements;

    public function __construct(RequirementsChecker $checker)
    {
        $this->requirements = $checker;
    }

    public function requirements()
    {
        $phpSupportInfo = $this->requirements->checkPHPversion(config('installer.core.minPhpVersion'));
        $requirements = $this->requirements->check(config('installer.requirements'));

        return view('installer.requirements', compact('requirements', 'phpSupportInfo'));
    }
}
