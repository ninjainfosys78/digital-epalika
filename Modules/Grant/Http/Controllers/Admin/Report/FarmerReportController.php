<?php

namespace Modules\Grant\Http\Controllers\Admin\Report;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\FiscalYear;
use Illuminate\Support\Collection;
use Modules\Grant\Entities\Cooperative;
use Modules\Grant\Entities\Enterprise;
use Modules\Grant\Entities\Farmer;
use Modules\Grant\Entities\Group;
use Modules\Grant\Transformers\FarmerReportResource;

class FarmerReportController extends Controller
{
    public function index(): Factory|\Illuminate\Contracts\View\View|Application
    {
        $fiscalYears = FiscalYear::get();
        $columnData = $this->getColumns();
        $cooperatives = Cooperative::latest()->get();
        $groups = Group::latest()->get();
        $enterprises = Enterprise::latest()->get();

        return view('grant::admin.report.farmer.index', compact(
            'fiscalYears',
            'columnData',
            'cooperatives',
            'groups',
            'enterprises'
        ));
    }

    public function report(Request $request)
    {
        $request->validate([
            'columns' => ['nullable', 'array']
        ]);

        if (empty($request->input('columns'))) {
            $request->request->add(
                ['columns' =>
                    [
                        'farmers' => ['first_name', 'last_name', 'gender', 'phone_no']
                    ]
                ]
            );
        }

        $farmers = Farmer::with('province', 'localBody', 'district')->where(function ($q) use ($request) {
            $this->filterDataFromUser($q, $request);
        })->get();

        return response()->json([
            'data' => FarmerReportResource::collection($farmers)
        ]);
    }

    private function getColumns(): Collection
    {
        $columnData = collect();

        (new Farmer())
            ->ownAndRelatedModelsFillableColumns()
            ->filter(function ($column) {
                return array_keys($column, 'Farmer');
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

        if (!empty($request->input('gender'))) {
            $q->where('gender', $request->input('gender'));
        }

        if (!empty($request->input('marital_status'))) {
            $q->where('marital_status', $request->input('marital_status'));
        }

        if (!empty($request->input('cooperatives'))) {
            $q->whereHas('cooperatives', function ($sub_q) use ($request) {
                $sub_q->whereIn('cooperative_id', $request->input('cooperatives'));
            });
        }
        if (!empty($request->input('groups'))) {
            $q->whereHas('groups', function ($sub_q) use ($request) {
                $sub_q->whereIn('group_id', $request->input('groups'));
            });
        }
        if (!empty($request->input('enterprises'))) {
            $q->whereHas('enterprises', function ($sub_q) use ($request) {
                $sub_q->whereIn('enterprise_id', $request->input('enterprises'));
            });
        }
    }
}
