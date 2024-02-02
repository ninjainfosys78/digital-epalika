<?php

namespace App\Http\Controllers\Installer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ModuleController extends Controller
{
    public function modules()
    {
        $modules = $this->getModules();

        return view('installer.module', compact('modules'));
    }

    public function saveModules(Request $request)
    {
        $request->validate([
            'modules' => ['required', 'array'],
            'modules.*' => ['string']
        ]);

        $modules = $this->getModules();

        foreach ($modules as $module => $value) {
            Artisan::call('module:disable ' . $module);
        }
        foreach ($request->input('modules') as $activeModule) {
            Artisan::call('module:enable ' . $activeModule);
        }

        return redirect()->route('installer.environment-wizard');
    }

    /**
     * @return mixed
     */
    public function getModules(): mixed
    {
        $moduleFile = base_path('modules_statuses.json');

        if (!file_exists($moduleFile)) {
            $sourcePath = base_path('modules_statuses.json.example');


            copy($sourcePath, $moduleFile);
        }

        $getModuleFileData = file_get_contents($moduleFile);

        return json_decode($getModuleFileData, true);
    }
}
