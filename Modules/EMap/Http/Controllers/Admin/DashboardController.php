<?php

namespace Modules\EMap\Http\Controllers\Admin;

use App\Enums\ChartOptionEnum;
use App\Http\Controllers\Controller;
use App\Models\Settings\FiscalYear;
use App\Traits\NepaliDateConverter;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\EMap\Entities\MapApply;
use Modules\EMap\Entities\Organization;
use Modules\EMap\Entities\StructureType;
use Modules\EMap\Enums\ApplicationFormTypeEnum;
use Modules\EMap\Enums\BuildingUsageEnum;
use Modules\EMap\Enums\CategorizationEnum;
use Modules\EMap\Enums\TypeOfConstructionWorkEnum;

class DashboardController extends Controller
{
    use NepaliDateConverter;

    public function index()
    {
        $this->checkAuthorization('eMapDashboard_access');

        $organization_count = Organization::count();
        $map_apply_count = MapApply::count();
        return view('emap::admin.dashboard', compact('organization_count', 'map_apply_count', ));
    }
    public function ajaxData()
    {
        return [
            'mapApply' => $this->getMapApplyAccordingToFiscalYear(),
            'buildingUsage' => $this->getMapApplyBuildingUsageAccordingToFiscalYear(),
            'buildingCategory' => $this->getMapApplyBuildingCategoryAccordingToFiscalYear(),
            'constructionType' => $this->getMapApplyConstructionTypeAccordingToFiscalYear(),
            'structureType' => $this->getMapApplyStructureTypeAccordingToFiscalYear(),
            'mapAccordingToMonth' => $this->mapAccordingToMonth(),
        ];
    }
    public function getMapApplyStructureTypeAccordingToFiscalYear()
    {
        $structureTypes = StructureType::withCount('mapApply')
            ->selectRaw('id,title')
            ->get()
            ->map(function ($structure) {
                return [
                    'name' => $structure->title,
                    'data' => (int) $structure->map_apply_count,
                    'color' => generateRandomRGBAColor()
                ];
            });

        $chartData = [
            'labels' => $structureTypes->pluck('name')->toArray(),
            'option' => ChartOptionEnum::PIE_CHART->option(),
            'dataSets' => [
                [
                    'label' => 'जम्मा',
                    'data' => $structureTypes->pluck('data')->toArray(),
                    'backgroundColor' => $structureTypes->pluck('color')?->toArray(),
                    'borderColor' => $structureTypes->pluck('color')?->toArray(),
                    'borderWidth' => 1,
                ],
            ],
        ];

        return $chartData;
    }

    public function getMapApplyConstructionTypeAccordingToFiscalYear()
    {

        $officeSetting = $this->getOfficeSetting();
        $mapApplies = $this->getMapApply($officeSetting->fiscal_year_id);
        $constructionTypes = $mapApplies->pluck('construction_type')->unique();

        foreach ($constructionTypes as $type) {
            $data[] = $mapApplies->where('construction_type', $type)->count();
        }

        $chartData = [
            'labels' =>  array_values($constructionTypes->map(function ($constructionType) {
                return TypeOfConstructionWorkEnum::tryFrom($constructionType)->label() ?? '';
            })->toArray()),
            'dataSets' => [
                [
                    'data' => $data,
                    'label' => 'जम्मा',
                    'backgroundColor' => $this->generateRandomRGBAColors(count($constructionTypes)),
                    'borderWidth' => 1,
                ],
            ],
        ];

        return $chartData;
    }


    public function getMapApplyAccordingToFiscalYear(): array
    {
        $fiscalYear = FiscalYear::withCount(['mapApplies',
            'mapApplies as mapRegistrationCount' => function ($query) {
                $query->where('application_type', ApplicationFormTypeEnum::MAP_REGISTRATION);
            }, 'mapApplies as mapVerificationCount' => function ($query) {
                $query->where('application_type', ApplicationFormTypeEnum::MAP_VERIFIED);
            },])
            ->selectRaw('id,title')
            ->get()
        ->map(function ($fiscalYear) {
            return [
                'title' => $fiscalYear->title,
                'map_applies_count' => (int)$fiscalYear->map_applies_count,
                'mapRegistrationCount' => (int)$fiscalYear->mapRegistrationCount,
                'mapVerificationCount' => (int)$fiscalYear->mapVerificationCount,
            ];
        });
        return [
            'labels' => $fiscalYear->pluck('title')->toArray(),
            'dataSets' => [
                [
                    'data' => $fiscalYear->pluck('map_applies_count')->toArray(),
                    'label' => 'जम्मा नक्सा',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
                [
                    'data' => $fiscalYear->pluck('mapRegistrationCount')->toArray(),
                    'label' => 'नक्सा दर्ता',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
                [
                    'data' => $fiscalYear->pluck('mapVerificationCount')->toArray(),
                    'label' => 'नक्सा प्रमाणित',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ]
            ],


        ];
    }

    public function getMapApply($hasCurrentFiscalYear = null): Collection
    {
        return DB::table('map_applies')
            ->select('registration_date', 'usage', 'building_category', 'application_type', 'construction_type', 'deleted_at')
            ->whereNull('deleted_at')
            ->where(function ($query) use ($hasCurrentFiscalYear) {
                if ($hasCurrentFiscalYear) {
                    $query->where('fiscal_year_id', $hasCurrentFiscalYear);
                }
            })
            ->get();
    }

    public function getMapApplyBuildingUsageAccordingToFiscalYear()
    {
        $officeSetting = $this->getOfficeSetting();
        $mapApplies = $this->getMapApply($officeSetting->fiscal_year_id);
        $buildingUsages = $mapApplies->pluck('usage')->unique();
        $chartData = [
            'labels' => $buildingUsages->map(function ($usage) {
                return BuildingUsageEnum::tryFrom($usage)?->label();
            })->toArray(),
            'option' => ChartOptionEnum::BAR_CHART->option(),
            'dataSets' => [
                [
                    'label' => [],
                    'data' => $mapApplies->groupBy('usage')->pluck('usage_count')->toArray(),
                    'backgroundColor' => $this->generateRandomRGBAColors(count($buildingUsages)),
                    'borderColor' => $this->generateRandomRGBAColors(count($buildingUsages)),
                    'borderWidth' => 1,
                ],
            ],
        ];
        return $chartData;
    }

    private function generateRandomRGBAColors($count)
    {
        $colors = [];

        for ($i = 0; $i < $count; $i++) {
            $colors[] = 'rgba(' . mt_rand(0, 255) . ', ' . mt_rand(0, 255) . ', ' . mt_rand(0, 255) . ', ' . (mt_rand(50, 100) / 100) . ')';
        }

        return $colors;
    }



    public function getMapApplyBuildingCategoryAccordingToFiscalYear()
    {
        $officeSetting = $this->getOfficeSetting();

        $map_applies = $this->getMapApply($officeSetting->fiscal_year_id)
            ->groupBy('building_category')
            ->map(function ($map_apply, $key) {
                return [
                    'building_category' => CategorizationEnum::tryFrom($key)?->label(),
                    'count' => count($map_apply),
                    'mapRegistrationCount' => count($map_apply->where('application_type', ApplicationFormTypeEnum::MAP_REGISTRATION->value)),
                    'mapVerificationCount' => count($map_apply->where('application_type', ApplicationFormTypeEnum::MAP_VERIFIED->value)),
                ];
            });

        return [
            'labels' => $map_applies->pluck('building_category')->toArray(),
            'option' => ChartOptionEnum::PIE_CHART->option(),
            'dataSets' => [
                [
                    'data' => $map_applies->pluck('count')->toArray(),
                    'label' => 'कुल नक्सा',
                    'fill' => 'false',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
                [
                    'data' => $map_applies->pluck('mapRegistrationCount')->toArray(),
                    'label' => 'नक्सा दर्ता',
                    'fill' => 'false',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
                [
                    'data' => $map_applies->pluck('mapVerificationCount')->toArray(),
                    'label' => 'नक्सा प्रमाणीकरण',
                    'fill' => 'false',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ],
            ],


        ];
    }

    public function getOfficeSetting()
    {
        return officeSetting();
    }

    public function mapAccordingToMonth()
    {
        $officeSetting = $this->getOfficeSetting();
        $mapApplies = $this->getMapApply($officeSetting->fiscal_year_id);
        $month = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0];

        foreach ($mapApplies as $mapApply) {
            if (!empty($mapApply->registration_date)) {
                $registration_date = Carbon::parse($mapApply->registration_date);
                $registrationDate = $this->get_nepali_date($registration_date->format('Y'), $registration_date->format('m'), $registration_date->format('d'));
                $month[$registrationDate['m'] - 1] += 1;
            }
        }

        return [
            'labels' => $this->month_name,

            'dataSets' => [
                [
                    'data' => $month,
                    'label' => 'जम्मा नक्सा दर्ता',
                    'backgroundColor' => generateRandomRGBAColor(),
                    'borderColor' => generateRandomRGBAColor(),
                    'borderWidth' => 1,
                ]
            ]
        ];
    }
}
