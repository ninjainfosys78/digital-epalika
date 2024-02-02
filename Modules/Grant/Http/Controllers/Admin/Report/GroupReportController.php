<?php

namespace Modules\Grant\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Modules\Grant\Entities\Group;
use Modules\Grant\Transformers\GroupReportResource;

class GroupReportController extends Controller
{
    public function index()
    {
        $columnData = $this->getColumns();
        return view('grant::admin.report.group.index', compact('columnData'));
    }

    public function report(Request $request)
    {
        $request->validate([
            'columns' => ['nullable', 'array']
        ]);

        $groups = Group::with('district', 'province', 'localBody')->where(function ($q) use ($request) {
            $this->filterDataFromUser($q, $request);
        })->get();

        return response()->json([
            'data' => GroupReportResource::collection($groups)
        ]);
    }

    private function getColumns(): Collection
    {
        $columnData = collect();

        (new Group())
            ->ownAndRelatedModelsFillableColumns()
            ->filter(function ($column) {
                return array_keys($column, 'Group');
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
    }
}
