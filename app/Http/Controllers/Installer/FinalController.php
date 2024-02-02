<?php

namespace App\Http\Controllers\Installer;

use App\Http\Controllers\Controller;
use App\Installer\EnvironmentManager;
use App\Installer\FinalInstallManager;
use App\Installer\InstalledFileManager;
use Illuminate\Support\Facades\Artisan;

class FinalController extends Controller
{
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();
        //TODO: This is the line that is causing the error Event not found
        //        event(new LaravelInstallerFinished);
        Artisan::call('optimize:clear');

        return view('installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}
