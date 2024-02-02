<?php

namespace Modules\Grant\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Modules\Grant\Entities\Enterprise;
use Modules\Grant\Entities\EnterpriseType;
use Modules\Grant\Transformers\EnterpriseReportResource;

class EnterpriseReportController extends Controller
{
    public function index()
    {
        $enterpriseTypes = EnterpriseType::all();
        $columnData = $this->getColumns();

        return view('grant::admin.report.enterprise.index', compact('columnData', 'enterpriseTypes'));
    }

    public function report(Request $request)
    {
        $request->validate([
            'columns' => ['nullable', 'array']
        ]);

        $enterprises = Enterprise::with('enterpriseType', 'localBody', 'province', 'district')->where(function ($q) use ($request) {
            $this->filterDataFromUser($q, $request);
        })->get();

        return response()->json([
            'data' => EnterpriseReportResource::collection($enterprises)
        ]);
    }

    private function getColumns(): Collection
    {
        $columnData = collect();

        (new Enterprise())
            ->ownAndRelatedModelsFillableColumns()
            ->filter(function ($column) {
                return array_keys($column, 'Enterprise');
            })
            ->each(function ($column) use ($columnData) {
                $columnData->push(collect($column)->put('columns', $column['columns']));
            });
        return $columnData;
    }

    public function filterDataFromUser($q, Request $request): void
    {
        if (!empty($request->input('ward_no'))) {
            $q->whereIn('ward_no', $request->input('ward_no'));
        }
        if (!empty($request->input('enterprise_type_id'))) {
            $q->whereIn('enterprise_type_id', $request->input('enterprise_type_id'));
        }
    }
}
