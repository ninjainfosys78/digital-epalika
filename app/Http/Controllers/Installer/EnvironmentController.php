<?php

namespace App\Http\Controllers\Installer;

use App\Events\EnvironmentSaved;
use App\Http\Controllers\Controller;
use App\Installer\EnvironmentManager;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EnvironmentController extends Controller
{
    protected EnvironmentManager $EnvironmentManager;
    public function __construct(EnvironmentManager $environmentManager)
    {
        $this->EnvironmentManager = $environmentManager;
    }

    public function environmentWizard()
    {
        return view('installer.environment_wizard');
    }

    public function saveWizard(Request $request)
    {
        $rules = config('installer.environment.form.rules');
        $messages = [
            'environment_custom.required_if' => trans('installer_messages.environment.wizard.form.name_required'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }

        if (!$this->checkDatabaseConnection($request)) {
            return back()->withInput()->withErrors([
                'database_connection' => trans('installer_messages.environment.wizard.form.db_connection_failed'),
            ]);
        }

        $results = $this->EnvironmentManager->saveFileWizard($request);

        //TODO: This is the line that is causing the error Event not found

        //        event(new EnvironmentSaved($request));

        return redirect(route('installer.database'))
            ->with(['results' => $results]);
    }

    private function checkDatabaseConnection(Request $request)
    {
        $connection = $request->input('database_connection');

        $settings = config("database.connections.$connection");

        config([
            'database' => [
                'default' => $connection,
                'connections' => [
                    $connection => array_merge($settings, [
                        'driver' => $connection,
                        'host' => $request->input('database_hostname'),
                        'port' => $request->input('database_port'),
                        'database' => $request->input('database_name'),
                        'username' => $request->input('database_username'),
                        'password' => !empty($request->input('database_password')) ? $request->input('database_password') : '',
                    ]),
                ],
            ],
        ]);
        //dd(config('database'));
        DB::purge();
        //dd(DB::connection()->getPdo());
        try {
            DB::connection()->getPdo();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
