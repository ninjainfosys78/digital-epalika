<?php

namespace App\Http\Controllers\Installer;

use App\Http\Controllers\Controller;
use App\Installer\PermissionsChecker;

class PermissionController extends Controller
{
    protected PermissionsChecker $permissions;

    public function __construct(PermissionsChecker $checker)
    {
        parent::__construct();
        $this->permissions = $checker;
    }

    public function permissions()
    {
        $permissions = $this->permissions->check(config('installer.permissions'));

        return view('installer.permissions', compact('permissions'));
    }
}
