<?php

namespace Modules\Recommendation\Http\Controllers\Admin\Api\v1;

use App\Http\Controllers\Controller;
use Modules\Recommendation\Http\Requests\SipharishCreated\StoreSipharisCreatedRequest;
use Illuminate\Support\Facades\DB;
use Modules\Recommendation\Entities\SipharishCreate;
use Modules\Recommendation\Transformers\SifarishFormResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SifarishApiController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $sifaris = SipharishCreate::with('personalDetail', 'SipharishFormType')->get();
        return SifarishFormResource::collection($sifaris);

    }



    public function store(StoreSipharisCreatedRequest $request)
    {
        $sipharis = DB::transaction(function () use ($request) {
            $sipharis = SipharishCreate::create($request->validated() + [
                'created_by' => auth()->id()
            ]);

            if (
                array_key_exists('fields', $request->validated())
                && !empty($request->validated()['fields'])
            ) {

                foreach ($request->validated()['fields'] as $field) {
                    $sipharis->SipharishCreatedValues()->create($field);
                }
            }

            if (
                array_key_exists('files', $request->validated())
                && !empty($request->validated()['files'])
            ) {

                foreach ($request->validated()['files'] as $file) {
                    $sipharis->SipharisCreatedDocuments()->create($file + [
                        'extension' => $file['filename']->getClientOriginalExtension()
                    ]);
                }
            }


            return $sipharis;
        });

        return response()->json(['data' => new SifarishFormResource($sipharis)], 200);

    }


}
