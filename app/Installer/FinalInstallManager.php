<?php

namespace App\Installer;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\BufferedOutput;

class FinalInstallManager
{
    public function runFinal()
    {
        $outputLog = new BufferedOutput();

        $this->generateKey($outputLog);
        $this->publishVendorAssets($outputLog);
        Artisan::call('storage:link');

        return $outputLog->fetch();
    }

    private static function generateKey(BufferedOutput $outputLog)
    {
        try {
            if (config('installer.final.key')) {
                Artisan::call('key:generate', ['--force' => true], $outputLog);
            }
        } catch (Exception $e) {
            return static::response($e->getMessage(), $outputLog);
        }

        return $outputLog;
    }

    private static function publishVendorAssets(BufferedOutput $outputLog)
    {
        try {
            if (config('installer.final.publish')) {
                Artisan::call('vendor:publish', ['--all' => true], $outputLog);
            }
        } catch (Exception $e) {
            return static::response($e->getMessage(), $outputLog);
        }

        return $outputLog;
    }

    private static function response($message, BufferedOutput $outputLog)
    {
        return [
            'status' => 'error',
            'message' => $message,
            'dbOutputLog' => $outputLog->fetch(),
        ];
    }
}
