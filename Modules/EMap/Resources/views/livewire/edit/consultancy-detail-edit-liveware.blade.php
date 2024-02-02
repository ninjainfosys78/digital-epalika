<form wire:submit.prevent="saveFormData">
    <button class="btn btn-xs float-end btn-outline-primary" wire:click.prevent="setEditForm"><i class="fa fa-pen"></i>
    </button>
    <div class="d-flex flex-column align-items-end">
        <div class="col-4">
            <div class="mb-1">
            @if($signatureUrl || $applyMap['consultant_signature'])
{{--                <img src="{{ $applyMap['consultant_signature']?->temporaryUrl() ??$signatureUrl ?? ''}}" alt=""--}}
{{--                     width="60">--}}
            @endif
            </div>
            <div class="mb-1">
                <label class="form-label" for="applyMap.consultant_signature">(कन्सल्टेन्ट इंन्जिनियरको सहि)</label>
                <input type="file" wire:model="applyMap.consultant_signature" id="applyMap.consultant_signature"
                       {{$editForm ? '' : 'disabled'}} class="form-control form-control-sm">
                @error('applyMap.consultant_signature')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-1">
                <label class="form-label" for="applyMap.consultant_name">नाम</label>
                <input type="text"
                       wire:model="applyMap.consultant_name"
                       {{$editForm ? '' : 'disabled'}}
                       id="applyMap.consultant_name" class="form-control form-control-sm"
                       placeholder="नाम">
                @error('applyMap.consultant_name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-1">
                <label class="form-label" for="applyMap.consultant_mobile_no">मोबाइल नं.</label>
                <input type="text"
                       wire:model="applyMap.consultant_mobile_no"
                       id="applyMap.consultant_mobile_no" {{$editForm ? '' : 'disabled'}}
                       class="form-control form-control-sm" placeholder="मोबाइल नं.">
                @error('applyMap.consultant_mobile_no')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-1">
                <label
                    for="applyMap.consultant_nec_no"><b>एन. ई. सी. नं: </b></label>
                <input type="text"
                       wire:model="applyMap.consultant_nec_no"
                       id="applyMap.consultant_nec_no" {{$editForm ? '' : 'disabled'}}
                       class="form-control form-control-sm">
                @error('applyMap.consultant_nec_no')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div>
            </div>
        </div>
    </div>
    @if($editForm)
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-sm btn-primary"><i
                    class="fa fa-save px-1"></i>पेश गर्नुहोस्
            </button>
        </div>
    @endif
</form>
