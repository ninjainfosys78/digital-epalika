<?php

namespace App\Http\Controllers\Installer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Installer\LicenseRequest;
use Illuminate\Support\Facades\Request;

class LicenseController extends Controller
{
    public function license()
    {
        return view('installer.license');
    }

    public function saveLicense(Request $request)
    {
        return redirect()->route('installer.requirements');
        $response = $this->checkLicense($request->input('key'), $request->getUri()) ?? [];

        // if (array_key_exists('is_active', $response)
        //     && $response['is_active']) {
        $data = [
            'created_date' => now()->toDateString(),
            'days' => $response['days'] ?? 0,
            'license_key' => $request->input('key')
        ];
        $content = "<?php\n\nreturn " . var_export($data, true) . ";\n";

        file_put_contents(config_path('license.php'), $content);
        return redirect()->route('installer.requirements');
        //     } else {
        //         return back()->withInput()->withErrors([
        //             'key' => $response['message'] ?? 'Invalid License Key',
        //         ]);
        //     }
    }

    public function checkLicense(string $licenseKey, string $domain)
    {
        $url = "https://digitalepalika.com/api/v1/license/check";
        $args = http_build_query(array(
            'key' => $licenseKey,
            'domain' => $domain
        ));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1); ///
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Response
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
