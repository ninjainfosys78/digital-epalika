<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PrintController extends Controller
{
    public function applicationPrint(Request $request)
    {
        $request->validate([
            'data' => 'required',
        ]);
        $data = $request->input('data');

        return View::make('print.application_print', compact('data'));
    }

    public function officeLetterPrint(Request $request)
    {
        $request->validate([
            'data' => 'required',
        ]);

        $data = $request->input('data');

        return View::make('print.office_letter_print', compact('data'));
    }

    public function businessRegistrationPrint(Request $request)
    {
        $request->validate([
            'data' => 'required',
        ]);

        $data = $request->input('data');

        return View::make('print.business_registration_print', compact('data'));
    }
}
