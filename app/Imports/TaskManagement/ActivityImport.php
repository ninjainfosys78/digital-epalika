<?php

namespace App\Imports\TaskManagement;

use App\Traits\NepaliDateConverter;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Modules\TaskManagement\Entities\Activity;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ActivityImport implements ToCollection, WithValidation, WithHeadingRow, SkipsEmptyRows, WithBatchInserts
{
    use Importable;
    use NepaliDateConverter;

    protected int|null $user_id;
    protected int|null $branch_id;

    public function __construct($request)
    {
        $this->user_id = $request->input('user_id');
        $this->branch_id = $request->input('branch_id');
    }

    public function sheets(): array
    {
        return [
            0 => $this, // Handle the first sheet in the current class
            1 => $this, // Handle the second sheet in the current class
        ];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Activity::create([
                'date' => $this->excelDateToDate($row['date']),
                'date_en' => $this->bsToAdDate($this->excelDateToDate($row['date'])),
                'remarks' => $row['remarks'],
                'user_id' => $user_id ?? auth()->id(),
                'branch_id' => $branch_id ?? auth()->user()->branch_id,
                'fiscal_year_id' => officeSetting()->fiscal_year_id
            ]);
        }
    }

    public function rules(): array
    {
        return [
            '*.date' => ['required'],
            '*.remarks' => ['nullable']
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }

    private function excelDateToDate($date): string
    {
        return Carbon::instance(Date::excelToDateTimeObject($date))->toDateString();
    }
}
