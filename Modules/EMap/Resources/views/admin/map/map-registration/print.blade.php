@if(!empty($mapApply->mapRegistration))
    <div class="lh-lg">
        <div class="d-flex justify-content-between">
            <p><strong>रसिद नं:</strong> {{$mapApply->mapRegistration->receipt_no ?? ''}}</p>
            <h3 class="text-center fw-bold font-18">दस्तुर तथा दर्ता सम्बन्धि</h3>
            <p><strong>मिति: </strong> {{$mapApply->mapRegistration->nepali_date ?? ''}}</p>
        </div>
        <p><strong>घरधनीको नाम, थर:</strong><span class="dashed-bottom mx-1">{{$mapApply->houseOwner->name ?? ''}}</span></p>
        <p><strong>भू-उपयोग क्षेत्र : </strong><span class="dashed-bottom mx-1">{{$mapApply->landDetail?->landUseArea?->title??''}} {{$mapApply->landDetail->unit->title??''}}</span></p>
        <p><strong>निर्माणको विवरण :</strong><span class="dashed-bottom mx-1">{{$mapApply->usage->label()??''}}</span></p>
        <p><strong>निर्माणको प्रयोजन :</strong><span class="dashed-bottom mx-1">{{$mapApply->construction_type->label() ??''}}</span></p>
        <p><strong>भवनको वर्गीकरण :</strong>
                    @foreach(\Modules\EMap\Enums\CategorizationEnum::cases() as $categorization)
                    <input type="checkbox" class="d-inline mx-2"
                           {{$categorization->value===$mapApply->building_category->value ? 'checked' : ''}} disabled>
                    {{$categorization->label()}}
                @endforeach</p>
        <p><strong>निर्माणको स्ट्रक्चरल सिस्टम :</strong> <span class="dashed-bottom mx-1"> {{$mapApply->structureType->title??''}}</span></p>
        <table class="table table-bordered table-sm table-striped mt-2">
            <thead>
            <tr class="text-center">
                <th rowspan="2">तल्लाको विवरण</th>
                <th>प्रस्तावित निर्माणको क्षेत्रफल</th>
                <th colspan="2">नक्सा दस्तुर</th>
                <th rowspan="2">कैफियत</th>
            </tr>
            <tr class="text-center">
                <th>(वर्ग फिट/मिटर)</th>
                <th>दर</th>
                <th>रकम</th>
            </tr>
            </thead>
            <tbody>
            @foreach($mapApply->mapRegistration->mapRegistrationParticulars as $particular)
                <tr>
                    <td>{{$particular->storey ?? ''}}</td>
                    <td>{{$particular->area ?? 0}}</td>
                    <td>रु. {{$particular->rate ?? 0}}</td>
                    <td>रु. {{$particular->amount ?? ''}}</td>
                    <td>{{$particular->remarks ?? ''}}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="2">जम्मा</th>
                <td>रु. {{$mapApply->mapRegistration->particular_total_rate}}</td>
                <td>रु. {{$mapApply->mapRegistration->particular_total_amount}}</td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">फारम दस्तुर</th>
                <td colspan="3">रु. {{$mapApply->mapRegistration->form_receipt}}</td>
                <td rowspan="4">राजस्व उपशाखामा बुझाउने</td>
            </tr>
            <tr>
                <th scope="row">निवेदक दर्ता दस्तुर</th>
                <td colspan="3">रु. {{$mapApply->mapRegistration->application_registration_fee}}</td>
            </tr>
            <tr>
                <th scope="row">अन्य</th>
                <td colspan="3">रु. {{$mapApply->mapRegistration->other}}</td>
            </tr>
            <tr>
                <th scope="row">कुल जम्मा</th>
                <td colspan="3">रु. {{$mapApply->mapRegistration->total_amount}}
                    <p class="dashed-bottom d-inline">अक्षरेपी
                    <x-number-into-unicode :is_currency="true" :number="$mapApply->mapRegistration->total_amount ?? ''"
                                           id="in_amount"/> मात्र</p>
                </td>
            </tr>
            </tbody>
        </table>
        <span>फाटवालाको सही: <span class="underline-dotted custom-width"></span></span>
        <br>
        <br>
        <strong>राजस्व शाखाको प्रयोजनको लागि</strong>
        <br>
        <span>निवेदकको नक्सा पास दस्तुर वापत रु: <span
                class="underline-dotted">{{$mapApply->mapRegistration->total_amount ?? ''}}</span> बाट प्राप्त
                    भयो |</span>
        <br>
        <span>मिति: <span class="underline-dotted">{{$mapApply->mapRegistration->nepali_date ?? ''}}</span>
                    रसिद नं:<span class="underline-dotted">{{$mapApply->mapRegistration->receipt_no ?? ''}}</span>
                    रकम बुझने: <span
                class="underline-dotted">{{$mapApply->mapRegistration->recipient ?? ''}}</span></span>
    </div>
@endif



