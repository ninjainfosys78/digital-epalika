<?php

namespace Modules\Grant\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Modules\Grant\Entities\Affiliation;
use Modules\Grant\Entities\Cooperative;
use Modules\Grant\Entities\CooperativeType;
use Modules\Grant\Transformers\CooperativeReportResource;

class CooperativeReportController extends Controller
{
    public function index()
    {
        $columnData = $this->getColumns();
        $cooperativeTypes = CooperativeType::all();
        $affiliations = Affiliation::all();
        return view('grant::admin.report.cooperative.index', compact('columnData', 'cooperativeTypes', 'affiliations'));
    }

    public function report(Request $request)
    {
        $request->validate([
            'columns' => ['nullable', 'array']
        ]);

        $cooperatives = Cooperative::with('cooperativeType', 'affiliation', 'province', 'localBody', 'district')->where(function ($q) use ($request) {
            $this->filterDataFromUser($q, $request);
        })->get();

        return response()->json([
            'data' => CooperativeReportResource::collection($cooperatives)
        ]);
    }

    private function getColumns(): Collection
    {
        $columnData = collect();

        (new Cooperative())
            ->ownAndRelatedModelsFillableColumns()
            ->filter(function ($column) {
                return array_keys($column, 'Cooperative');
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
        if (!empty($request->input('cooperative_type_id'))) {
            $q->whereIn('cooperative_type_id', $request->input('cooperative_type_id'));
        }
        if (!empty($request->input('affiliation_id'))) {
            $q->whereIn('affiliation_id', $request->input('affiliation_id'));
        }
    }
}
