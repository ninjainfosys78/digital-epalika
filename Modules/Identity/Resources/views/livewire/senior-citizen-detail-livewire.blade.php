<div xmlns="http://www.w3.org/1999/html">
    <style>
        legend {
            background-color: gray;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        fieldset {
            border-radius: 5px;
        }


    </style>
    <form wire:submit.prevent="saveForm">
        <div class="card mt-3">

            <fieldset class="mt-3">
                <legend>जेस्ठ नागरिक विवरण</legend>
                <div class="row">


                    <div class="col-md-6 mb-3">
                        <label for="form.photo" class="form-label">फोटो</label>
                        <input
                            name="form.photo"
                            accept="image/*"
                            class="form-control @error('form.photo') is-invalid @enderror"
                            type="file"
                            id="form.photo"
                            wire:model="form.photo"

                        />
                        {{-- <div wire:loading wire:target="form.photo">Uploading...</div>
                        @error('form.photo')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                        <button class="mt-1 btn btn-primary btn-sm" onclick="loadImage()" type="button">Camera</button>
                        <button class="mt-1 btn btn-info btn-sm" onclick="captureImage()" type="button">Capture Image</button>
                        <button  class="mt-1 btn btn-danger btn-sm" onclick="stopCamera()" type="button">Stop Camera</button>
                        <div class="d-flex justify-content-between">
                            <video id="video" width="200" height="200" autoplay></video>
                            <canvas id="canvas" width="200" height="200"></canvas>
                        </div> --}}

                    </div>
                    <div class="col-md-6">


                    </div>
                    {{-- <div class="col-md-6">
                        <div class="card">
                            @if ( !empty($form['right_finger']['image']))
                                <img src="{{ $form['right_finger']['image'] }}" id="finger-print-right" alt="Right"
                                     height="100" width="100" style="margin: 20px auto">
                            @endif
                            <div class="card-body text-center">
                                <div class="clearfix mb-3"><span class="badge rounded-pill bg-info">दाहिने</span>
                                </div>
                                <div class="text-center">
                                    <button onclick="return captureRight();" class="btn btn-primary">Capture</button>
                                </div>
                            </div>
                            @error('form.right_finger')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-6">
                        <div class="card">
                            @if ( !empty($form['left_finger']['image']))
                                <img src="{{ $form['left_finger']['image'] }}" id="finger-print-left" alt="Left"
                                     height="100" width="100" style="margin: 20px auto">
                            @endif
                            <div class="card-body text-center">
                                <div class="clearfix mb-3"><span class="badge rounded-pill bg-info">बायाँ</span>
                                </div>
                                <div class="text-center">
                                    <button onclick="return captureLeft();" class="btn btn-primary">Capture</button>
                                </div>
                            </div>
                            @error('form.left_finger')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div> --}}
                </div>
            </fieldset>
            <fieldset class="mt-3">
                <legend>बिस्तृत विवरण</legend>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="form.name" class="form-label">पुरा नाम <span class="text-danger">*</span></label>
                        <input
                            name="form.name"
                            class="form-control  @error('form.name') is-invalid @enderror"
                            type="text"
                            id="form.name"
                            placeholder="पुरा नाम"
                            wire:model="form.name"
                        />
                        @error('form.name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.name_en" class="form-label">पुरा नाम( English)<span
                                class="text-danger">*</span></label>
                        <input
                            name="form.name_en"
                            class="form-control  @error('form.name_en') is-invalid @enderror"
                            type="text"
                            id="form.name_en"
                            placeholder="पुरा नाम (English)"
                            wire:model="form.name_en"
                        />
                        @error('form.name_en')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dob_bs" class="form-label">जन्म मिति (वि.स.)<span
                                class="text-danger">*</span></label>
                        <input
                            name="form.dob_bs"
                            class="form-control  @error('form.dob_bs') is-invalid @enderror"
                            type="text"
                            placeholder="जन्म मिति (वि.स.)"
                            id="dob_bs"
                            wire:model="form.dob_bs"
                        />
                        @error('form.dob_bs')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                        @error('form.dob_ad')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.gender" class="form-label">लिङ्ग <span class="text-danger">*</span></label>
                        <select
                            class="form-select @error('form.gender') is-invalid @enderror"
                            wire:model="form.gender"
                            id="form.gender" >
                            <option value="">---लिङ्ग छान्नुहोस् ---</option>
                            @foreach(\App\Enums\Gender::cases() as $gender)
                                <option value="{{$gender->value}}">{{$gender->label()}}</option>
                            @endforeach
                        </select>
                        @error('form.gender')
                        <div class="invalid-feedback ">{{$message}} </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.citizenship_no" class="form-label">नागरिता न.<span class="text-danger">*</span></label>
                        <input
                            name="form.citizenship_no"
                            class="form-control  @error('form.citizenship_no') is-invalid @enderror"
                            type="text"
                            id="form.citizenship_no"
                            placeholder="नागरिता न."
                            wire:model="form.citizenship_no"
                        />
                        @error('form.citizenship_no')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="issue_date_bs" class="form-label">जारी मिति (वि.स.)<span
                                class="text-danger">*</span></label>
                        <input
                            name="form.issue_date_bs"
                            class="form-control  @error('form.issue_date_bs') is-invalid @enderror"
                            type="text"
                            id="issue_date_bs"
                            placeholder="जारी मिति (वि.स.)"
                            wire:model="form.issue_date_bs"
                        />
                        @error('form.issue_date_bs')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.spouse" class="form-label">पति/पत्नीको नाम<span
                                class="text-danger">*</span></label>
                        <input
                            name="form.spouse"
                            class="form-control  @error('form.spouse') is-invalid @enderror"
                            type="text"
                            id="form.spouse"
                            placeholder="पति/पत्नीको नाम"
                            wire:model="form.spouse"
                        />
                        @error('form.spouse')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.spouse_en" class="form-label">पति/पत्नीको नाम (English)<span
                                class="text-danger">*</span></label>
                        <input
                            name="form.spouse_en"
                            class="form-control  @error('form.spouse_en') is-invalid @enderror"
                            type="text"
                            id="form.spouse_en"
                            placeholder="पति/पत्नीको नाम (English)"
                            wire:model="form.spouse_en"
                        />
                        @error('form.spouse_en')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.blood_group" class="form-label">रक्त समूह <span class="text-danger">*</span></label>
                        <select
                            class="form-select @error('form.blood_group') is-invalid @enderror"
                            wire:model="form.blood_group"
                            id="form.blood_group" >
                            <option value="">---रक्त समूह छान्नुहोस् ---</option>
                            @foreach(\App\Enums\BloodGroupEnum::cases() as $bloodGroup)
                                <option value="{{$bloodGroup->value}}">{{$bloodGroup->label()}}</option>
                            @endforeach
                        </select>
                        @error('form.blood_group')
                        <div class="invalid-feedback ">{{$message}} </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.father_name" class="form-label">बुवाको नाम</label>
                        <input
                            name="form.father_name"
                            class="form-control  @error('form.father_name') is-invalid @enderror"
                            type="text"
                            id="form.father_name"
                            placeholder="बुवाको नाम"
                            wire:model="form.father_name"
                        />
                        @error('form.father_name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.father_name_en" class="form-label">बुवाको नाम ( English)</label>
                        <input
                            name="form.father_name_en"
                            class="form-control  @error('form.father_name_en') is-invalid @enderror"
                            type="text"
                            id="form.father_name_en"
                            placeholder="बुवाको नाम ( English)"
                            wire:model="form.father_name_en"
                        />
                        @error('form.father_name_en')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.mother_name" class="form-label">आमाको नाम</label>
                        <input
                            name="form.mother_name"
                            class="form-control  @error('form.mother_name') is-invalid @enderror"
                            type="text"
                            id="form.mother_name"
                            placeholder="आमाको नाम"
                            wire:model="form.mother_name"
                        />
                        @error('form.mother_name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.mother_name" class="form-label">आमाको नाम ( English )</label>
                        <input
                            name="form.mother_name_en"
                            class="form-control  @error('form.mother_name_en') is-invalid @enderror"
                            type="text"
                            id="form.mother_name_en"
                            placeholder="आमाको नाम ( English )"
                            wire:model="form.mother_name_en"
                        />
                        @error('form.mother_name_en')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

            </fieldset>
            <fieldset class="mt-3">
                <legend>ठेगाना</legend>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="form.province_id" class="form-label">प्रदेश </label>
                        <select
                            name="form.province_id"
                            wire:model="form.province_id"
                            class="form-select @error('form.province_id') is-invalid @enderror"
                            id="form.province_id" >
                            <option value="">प्रदेश छान्नुहोस्</option>
                            @foreach($provinces as $province)
                                <option value="{{$province->id}}">
                                    {{$province->province}}
                                </option>
                            @endforeach
                        </select>
                        @error('form.province_id')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="form.district_id" class="form-label">जिल्ला </label>
                        <select
                            name="form.district_id"
                            wire:model="form.district_id"
                            class="form-select @error('form.district_id') is-invalid @enderror"
                            id="form.district_id" >
                            <option value="">जिल्ला छान्नुहोस्</option>
                            @foreach($districts as $district)
                                <option value="{{$district->id}}">
                                    {{$district->district}}
                                </option>
                            @endforeach
                        </select>
                        @error('form.district_id')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="form.local_body_id" class="form-label">पालिका </label>
                        <select
                            name="form.local_body_id"
                            wire:model="form.local_body_id"
                            class="form-select @error('form.local_body_id') is-invalid @enderror"
                            id="form.local_body_id" >
                            <option value="">पालिका छान्नुहोस्</option>
                            @foreach($localBodies as $localBody)
                                <option value="{{$localBody->id}}">
                                    {{$localBody->local_body}}
                                </option>
                            @endforeach
                        </select>
                        @error('form.local_body_id')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="form.ward_no" class="form-label">वडा नं.</label>
                        <select
                            name="form.ward_no"
                            wire:model="form.ward_no"
                            class="form-select @error('form.ward_no') is-invalid @enderror"
                            id="form.ward_no" >
                            <option value="">वडा नं. छान्नुहोस्</option>
                            @for($i=1;$i<=$wards;$i++)
                                <option value="{{$i}}">
                                    {{$i}}
                                </option>
                            @endfor
                        </select>
                        @error('form.ward_no')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="form.tole" class="form-label">टोल </label>
                        <input
                            name="form.tole"
                            class="form-control  @error('form.tole') is-invalid @enderror"
                            type="text"
                            id="form.tole"
                            placeholder="टोल "
                            wire:model="form.tole"
                        />
                        @error('form.tole')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                </div>
            </fieldset>
            <fieldset class="mt-3">
                <legend>संरक्षक को विवरण</legend>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="form.patrons_name" class="form-label">संरक्षकको नाम <span
                                class="text-danger">*</span> </label>
                        <input
                            name="form.patrons_name"
                            class="form-control  @error('form.patrons_name') is-invalid @enderror"
                            type="text"
                            id="form.patrons_name"
                            placeholder="संरक्षकको नाम "
                            wire:model="form.patrons_name"
                        />
                        @error('form.patrons_name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.patrons_name_en" class="form-label">संरक्षकको नाम ( English ) <span
                                class="text-danger">*</span> </label>
                        <input
                            name="form.patrons_name_en"
                            class="form-control  @error('form.patrons_name_en') is-invalid @enderror"
                            type="text"
                            id="form.patrons_name_en"
                            placeholder="संरक्षकको नाम ( English )"
                            wire:model="form.patrons_name_en"
                        />
                        @error('form.patrons_name_en')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.patrons_phone" class="form-label">सम्पर्क न.  </label>
                        <input
                            name="form.patrons_phone"
                            class="form-control  @error('form.patrons_phone') is-invalid @enderror"
                            type="text"
                            id="form.patrons_phone"
                            placeholder="सम्पर्क न."
                            wire:model="form.patrons_phone"
                        />
                        @error('form.patrons_phone')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="patrons_relationship" class="form-label">नाता</label>
                        <select class="form-select @error('patrons_relationship') is-invalid @enderror"
                            name="patrons_relationship" id="patrons_relationship">
                            <option value="">---नाता छान्नुहोस् ---</option>
                            @foreach ($relations as $relation)
                                <option value="{{ $relation->id }}"
                                    {{ $relation->id == old('patrons_relationship') ? 'selected' : '' }}>
                                    {{ $relation->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('patrons_relationship')
                            <div class="invalid-feedback ">{{ $message }} </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.patrons_name_address" class="form-label">ठेगाना <span
                                class="text-danger">*</span> </label>
                        <input
                            name="form.patrons_name_address"
                            class="form-control  @error('form.patrons_name_address') is-invalid @enderror"
                            type="text"
                            id="form.patrons_name_address"
                            placeholder="ठेगाना"
                            wire:model="form.patrons_name_address"
                        />
                        @error('form.patrons_name_address')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                </div>
            </fieldset>
            <fieldset class="mt-3">
                <legend>कुनै प्रकारको रोग छ वा छैन ?</legend>
                <div class="row">
                    <div class="col-md-2 my-3 d-flex justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" value="1" type="radio" wire:model="form.is_disease"
                                   name="form.is_disease" id="is_disease1" >
                            <label class="form-check-label" for="is_disease1">
                                छ।
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="0" type="radio" wire:model="form.is_disease"
                                   name="form.is_disease" id="is_disease2" >
                            <label class="form-check-label" for="is_disease2">
                                छैन।
                            </label>
                        </div>
                    </div>
                    @if($form['is_disease']=='1')
                        <div class="col-md-12 mb-3">
                            <label for="form.disease_name" class="form-label">रोगको नाम</label>
                            <input
                                name="form.disease_name"
                                class="form-control  @error('form.disease_name') is-invalid @enderror"
                                type="text"
                                id="form.disease_name"
                                placeholder="रोगको नाम"
                                wire:model="form.disease_name"
                            />
                            @error('form.disease_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    @endif

                </div>
            </fieldset>
            <fieldset class="mt-3">
                <legend>हेरचाह केन्द्रमा बसेकोभए सो को विवरण</legend>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="form.description" class="form-label">हेरचाह केन्द्रको विवरण</label>
                        <textarea
                            name="form.description"
                            class="form-control  @error('form.description') is-invalid @enderror"
                            type="text"
                            id="form.description"
                            placeholder="हेरचाह केन्द्रको विवरण"
                            wire:model="form.description"></textarea>
                        @error('form.description')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="form.description_en" class="form-label">हेरचाह केन्द्रको विवरण ( English )</label>
                        <textarea
                            name="form.description_en"
                            class="form-control  @error('form.description_en') is-invalid @enderror"
                            type="text"
                            id="form.description_en"
                            placeholder="हेरचाह केन्द्रको विवरण ( English )"
                            wire:model="form.description_en"></textarea>
                        @error('form.description_en')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                </div>
            </fieldset>

            <fieldset class="mt-3">
                <legend>कुनै प्रकार को औषधि सेवन गरिएको छ वा छैन?</legend>
                <div class="row">
                    <div class="col-md-2 my-3 d-flex justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="form.is_medicine" value="1"
                                   wire:model="form.is_medicine" id="medicine1" >
                            <label class="form-check-label" for="medicine1">
                                छ।
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="form.is_medicine" value="0"
                                   wire:model="form.is_medicine" id="medicine2"
                            >
                            <label class="form-check-label" for="medicine2">
                                छैन।
                            </label>
                        </div>
                    </div>
                    @if($form['is_medicine']=='1')
                        <div class="col-md-12 mb-3">
                            <label for="form.medicine_name" class="form-label">औषधिको नाम </label>
                            <input
                                name="form.medicine_name"
                                class="form-control  @error('form.medicine_name') is-invalid @enderror"
                                type="text"
                                id="form.medicine_name"
                                placeholder="औषधिको नाम"
                                wire:model="form.medicine_name"
                            />
                            @error('form.medicine_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    @endif
                </div>
            </fieldset>
            <div class="row d-flex justify-content-end">
                <div class="col-md-4 mt-3">
                    <label for="form.employee_signature_id" class="form-label">हस्ताक्षर <span
                            class="text-danger">*</span></label>
                    <select
                        class="form-select @error('form.employee_signature_id') is-invalid @enderror"
                        wire:model="form.employee_signature_id"
                        id="form.employee_signature_id" >
                        <option value="">---हस्ताक्षर छान्नुहोस् ---</option>
                        @foreach($employeeSignatures as $employeeSignature)
                            <option value="{{$employeeSignature->id}}">{{$employeeSignature->name}}</option>
                        @endforeach
                    </select>
                    @error('form.employee_signature_id')
                    <div class="invalid-feedback ">{{$message}} </div>
                    @enderror
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary">
                    Save <i class="fa fa-check"></i>
                </button>
            </div>

        </div>
    </form>
</div>

    @once
        @push('scripts')
            <script src="{{ asset('assets/backend/js/plugins/datepicker.min.js') }}"></script>
        @endpush
    @endonce
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                $("#dob_bs").nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    onChange: function () {
                        let inputFieldDate = $("#dob_bs").val();
                        let parsedDate = NepaliFunctions.ParseDate(inputFieldDate);
                        let englishDate = NepaliFunctions.BS2AD(parsedDate.parsedDate)
                        let formattedDate = NepaliFunctions.ConvertDateFormat(englishDate, "YYYY-MM-DD")
                        Livewire.emit('dobChanged', inputFieldDate ,formattedDate);
                    }
                });
                $("#issue_date_bs").nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    onChange: function () {
                        let inputFieldDate = $("#issue_date_bs").val();
                        let parsedDate = NepaliFunctions.ParseDate(inputFieldDate);
                        Livewire.emit('issueDateChanged', inputFieldDate);
                    }
                });


                // let todayBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), "YYYY-MM-DD")
                // let todayAdDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentAdDate(), "YYYY-MM-DD")
                // Livewire.emit('fromDateChanged', todayBsDate, todayAdDate);
                // Livewire.emit('toDateChanged', todayBsDate, todayAdDate);
            });

            function captureImage() {
                // Get the video element that will display the webcam feed
                const video = document.getElementById('video');

// Get the canvas element that we will use to capture the image
                const canvas = document.getElementById('canvas');
                const context = canvas.getContext('2d');

// Prompt the user for permission to use their webcam
                navigator.mediaDevices.getUserMedia({video: true})
                    .then(function (stream) {
                        // Set the source of the video element to the webcam stream
                        video.srcObject = stream;

                        // Wait for the video to load
                        video.onloadedmetadata = function () {
                            // Draw the video frame to the canvas
                            context.drawImage(video, 0, 0, canvas.width, canvas.height);

                            // Get the file type (e.g., image/png)
                            const fileType = 'image/png';

// Convert the canvas image to a data URL
                            const file = canvas.toDataURL(fileType);


                            Livewire.emit('photoUpdated', file)
                        };
                    });
            }


            function loadImage() {
                // Get the video element that will display the webcam feed
                const video = document.getElementById('video');


// Prompt the user for permission to use their webcam
                navigator.mediaDevices.getUserMedia({video: true})
                    .then(function (stream) {
                        // Set the source of the video element to the webcam stream
                        video.srcObject = stream;

                        // Wait for the video to load
                        video.onloadedmetadata = function () {
                            // Draw the video frame to the canvas
                            context.drawImage(video, 0, 0, canvas.width, canvas.height);


                            // You can now use the image data URL to display the image on the page or save it to a file, etc.
                        };
                    });

            }

            function stopCamera() {
                const video = document.getElementById('video');

// Prompt the user for permission to use their webcam
                navigator.mediaDevices.getUserMedia({video: true})
                    .then(function (stream) {
                        // Set the source of the video element to the webcam stream
                        video.srcObject = stream;

                        // Wait for the video to load
                        video.onloadedmetadata = function () {
                            // Stop the webcam stream
                            stream.getVideoTracks()[0].stop();
                        };
                    });

            }

        </script>
        <script src="{{ asset('assets/backend/finger/js/jquery-1.11.2.min.js') }}" defer></script>
        <script src="{{ asset('assets/backend/finger/js/msf100.min.js') }}" defer></script>
        <script src="{{ asset('assets/backend/finger/js/msfDevice.js') }}" defer></script>
    @endpush




