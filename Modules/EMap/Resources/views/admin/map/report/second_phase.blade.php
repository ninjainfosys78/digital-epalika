<h5 class="text-center mb-2"><b>कार्यालय प्रयोजनको लागि</b></h5>

{{--<div class="row">--}}
{{--    <div class="col-md-2">--}}
{{--            <input id="checkid"  type="checkbox" value="test" /> छ कि--}}
{{--    </div>--}}
{{--    <div class="col-md-2">--}}
{{--            <input id="checkid"  type="checkbox" value="test" /> testdata--}}
{{--    </div>--}}
{{--</div>--}}
<span class="mb-3">
    यस {{config('applicationDetail.office_type')}}को स्थान<span class="underline-dotted"></span>
    वडा नं.<span class="underline-dotted">{{$mapApply->landDetail->ward_no??''}}</span>मा अवस्थित साविक
    <span class="underline-dotted">{{$mapApply->landDetail->farmer_ward_no??''}}</span>
    कित्ता नं.<span class="underline-dotted">{{$mapApply->landDetail->plot_no??''}}</span>
    क्षेत्रफल<span class="underline-dotted">{{$mapApply->landDetail->unit_value??''}}  {{$mapApply->landDetail->unit->title??''}}</span>
    मा भवन निर्माण गर्ने घरधनी श्री<span class="underline-dotted">{{$mapApply->houseOwner->name??''}}</span>
    ले भवन निर्माण गर्ने क्रममा दोस्रो चरणको निर्माण कार्य सम्पन्न भएको हुँदा
    मिति<span class="underline-dotted custom-width"></span> मा स्थलगत निरीक्षण गरी देहाय
    बमोजिमको प्रतिवेदन पेश गरेको छु |
</span><br>
<span>१. सडक अधिकार क्षेत्र सम्बन्धि मापदण्ड पालना भएको
    <input class="form-check-input form-check-inline" type="checkbox" name="inlineRadioOptions" id="inlineRadio1" value="option1">
   छ कि&emsp;
    <input class="form-check-input form-check-inline" type="checkbox" name="inlineRadioOptions" id="inlineRadio2" value="option2">
    छैन&ensp;(छैन भने विवरण खुलाउने)<br>
    &emsp;<span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
</span><br>
<span class="mt-2">२. साइट प्लानमा देखाइए बमोजिम सेटब्याक पालना भएको
   <input class="form-check-input form-check-inline" type="checkbox" name="inlineRadioOptions" id="inlineRadio1" value="option1">
   छ कि&emsp;
    <input class="form-check-input form-check-inline" type="checkbox" name="inlineRadioOptions" id="inlineRadio2" value="option2">
    छैन&ensp;(छैन भने विवरण खुलाउने)<br>
    &emsp;<span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
</span><br>
<span class="mt-2">३. ग्राउण्ड कभरेजमा फरक परेको
   <input class="form-check-input form-check-inline" type="checkbox" name="inlineRadioOptions" id="inlineRadio1" value="option1">
   छ कि&emsp;
    <input class="form-check-input form-check-inline" type="checkbox" name="inlineRadioOptions" id="inlineRadio2" value="option2">
    छैन&ensp;(छैन भने विवरण खुलाउने)<br>
    &emsp;<span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
</span><br>
<span class="mt-2">४. छज्जा (क्यान्टीलिभर), बार्दली, बाहिरको सिँढी आदि निकालेको हकमा मापदण्डको पालना भएको
    <input class="form-check-input form-check-inline" type="checkbox" name="inlineRadioOptions" id="inlineRadio1" value="option1">
   छ कि&emsp;
    <input class="form-check-input form-check-inline" type="checkbox" name="inlineRadioOptions" id="inlineRadio2" value="option2">
    छैन&ensp;(छैन भने विवरण खुलाउने)<br>
    &emsp;<span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
</span><br>
<span class="mt-2">५. नेपाल राष्ट्रिय भवन निर्माण संहिता २०६० अनुसार निर्माण भएको
   <input class="form-check-input form-check-inline" type="checkbox" name="inlineRadioOptions" id="inlineRadio1" value="option1">
   छ कि&emsp;
    <input class="form-check-input form-check-inline" type="checkbox" name="inlineRadioOptions" id="inlineRadio2" value="option2">
    छैन&ensp;(छैन भने विवरण खुलाउने)<br>
    &emsp;<span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
</span><br>
<span class="mt-2">६. अन्य कुनै कुरा भएको खुलाउने :<br>
  &emsp;<span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
    <span class="underline-dotted"></span>
</span><br>
<span class="mt-3">माथि उल्लेखित भवन स्थलगत निरीक्षण गर्दा प्रचलित भवन मापदण्ड अनुसार ठिक छ |<br>
    फरक ठहरे कानुन बमोजिम सहुँला बुझउँला | <br></span>
