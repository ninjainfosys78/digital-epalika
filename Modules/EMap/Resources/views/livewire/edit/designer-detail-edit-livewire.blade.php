<form wire:submit.prevent="saveFormData" class="mb-2">
    <fieldset>
        <legend>२. डिजाइनरको विवरण</legend>
        @foreach($designerDetails as $key=>$designerDetail)
            <div class="d-flex justify-content-between mt-2">
                <h5>
                    १.{{$loop->iteration}} {{\Modules\EMap\Enums\PostsEnum::tryFrom($designerDetail['post'])->label()}}</h5>
                <div class="d-flex justify-content-between gap-2">
                    @if($dataToEdit === null)
                        <button class="btn btn-xs btn-outline-primary waves-effect waves-light"
                                wire:click.prevent="setDataForEdit({{$key}})"><i class="fa fa-pen"></i>
                        </button>
                    @else
                        @if($dataToEdit===$key)
                            <button type="button" class="btn btn-xs btn-outline-success"
                                    wire:click.prevent="saveFormData"><i
                                    class="fa fa-save"></i></button>
                            <button type="button" class="btn btn-xs btn-outline-danger"
                                    wire:click.prevent="setDataForEdit()"><i
                                    class="fa fa-times"></i>
                            </button>
                        @endif
                    @endif
                </div>

            </div>
            <div class="row">
                <input type="hidden"
                       id="designerDetails.{{$key}}.post"
                       wire:model="designerDetails.{{$key}}.post"
                >
                @error("designerDetails.$key.post")
                <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label" for="designerDetails.{{$key}}.name">नाम *</label>
                        <input type="text" class="form-control form-control-sm"
                               id="designerDetails.{{$key}}.name"
                               {{$dataToEdit !== $key ?'disabled':''}}
                               wire:model="designerDetails.{{$key}}.name">
                        @error("designerDetails.$key.name")
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="designerDetails.{{$key}}.father_name"> बुवाको नाम</label>
                        <input type="text"
                               class="form-control form-control-sm"
                               id="designerDetails.{{$key}}.father_name"
                               {{$dataToEdit !== $key ?'disabled':''}}
                               wire:model="designerDetails.{{$key}}.father_name">
                        @error("designerDetails.$key.father_name")
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label" for="designerDetails.{{$key}}.grandfather_name">
                            हजुरबुबाको नाम
                        </label>
                        <input type="text"
                               class="form-control form-control-sm"
                               id="designerDetails.{{$key}}.grandfather_name"
                               {{$dataToEdit !== $key ?'disabled':''}}
                               wire:model="designerDetails.{{$key}}.grandfather_name"
                        >
                        @error("designerDetails.$key.grandfather_name")
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label" for="designerDetails.{{$key}}.phone">
                            फोन
                        </label>
                        <input type="text"
                               class="form-control form-control-sm"
                               id="designerDetails.{{$key}}.phone"
                               {{$dataToEdit !== $key ?'disabled':''}}
                               wire:model="designerDetails.{{$key}}.phone"
                        >
                        @error("designerDetails.$key.phone")
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label" for="designerDetails.{{$key}}.address">
                            ठेगाना
                        </label>
                        <input type="text"
                               class="form-control form-control-sm"
                               id="designerDetails.{{$key}}.address"
                               {{$dataToEdit !== $key ?'disabled':''}}
                               wire:model="designerDetails.{{$key}}.address"
                        >
                        @error("designerDetails.$key.address")
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label" for="designerDetails.{{$key}}.local_body">
                            पालिका
                        </label>
                        <input type="text"
                               class="form-control form-control-sm"
                               id="designerDetails.{{$key}}.local_body"
                               {{$dataToEdit !== $key ?'disabled':''}}
                               wire:model="designerDetails.{{$key}}.local_body"
                        >
                        @error("designerDetails.$key.local_body")
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label" for="designerDetails.{{$key}}.ward_no">
                            वडा नं.
                        </label>
                        <input type="text"
                               class="form-control form-control-sm"
                               id="designerDetails.{{$key}}.ward_no"
                               {{$dataToEdit !== $key ?'disabled':''}}
                               wire:model="designerDetails.{{$key}}.ward_no"
                        >
                        @error("designerDetails.$key.ward_no")
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label" for="designerDetails.{{$key}}.nec_council_no">
                            NEC Council No.
                        </label>
                        <input type="text"
                               class="form-control form-control-sm"
                               id="designerDetails.{{$key}}.nec_council_no"
                               {{$dataToEdit !== $key ?'disabled':''}}
                               wire:model="designerDetails.{{$key}}.nec_council_no"
                        >
                        @error("designerDetails.$key.nec_council_no")
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="form-label" for="designerDetails.{{$key}}.local_body_registration_no">
                            पालिकाको दर्ता नं
                        </label>
                        <input type="text"
                               class="form-control form-control-sm"
                               id="designerDetails.{{$key}}.local_body_registration_no"
                               {{$dataToEdit !== $key ?'disabled':''}}
                               wire:model="designerDetails.{{$key}}.local_body_registration_no"
                        >
                        @error("designerDetails.$key.local_body_registration_no")
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
        @endforeach
    </fieldset>
</form>
