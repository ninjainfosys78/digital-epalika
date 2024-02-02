<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TraineeExport implements FromView
{
    public function __construct(public $trainees, public $training)
    {
    }

    public function view(): View
    {
        return view('roaster::admin.training.export_trainee', [
            'trainees' => $this->trainees,
            'training' => $this->training,
        ]);
    }
}
