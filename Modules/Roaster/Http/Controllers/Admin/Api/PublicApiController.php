<?php

namespace Modules\Roaster\Http\Controllers\Admin\Api;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\DigitalBoard\Transformers\TrainingResource;
use Modules\Roaster\Entities\Training;
use Modules\Roaster\Enums\TrainingTypeEnum;

class PublicApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function training()
    {
        $training = TrainingTypeEnum::cases();

        return response()->json($training);
    }
    public function allTraining(): AnonymousResourceCollection
    {
        $allTrainings = Training::get();
        return TrainingResource::collection($allTrainings);

    }
    // public function technical_trainee(): AnonymousResourceCollection
    // {
    //     $technical_trainees = Training::orderBy('date')->active()->showForMobileAppRequest()->get();

    //     return TrainingResource::collection($technical_trainees);
    // }



}
