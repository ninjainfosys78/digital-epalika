<div>
    <form wire:submit.prevent="saveForm">
        <div class="card mt-3">
            <fieldset>
                <legend>अपाङ्गता भएको व्यक्तिको विवरण</legend>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="form.photo" class="form-label">फोटो</label>
                        <input
                            name="form.photo"
                            accept="image/*"
                            class="form-control @error('form.photo') is-invalid @enderror"
                            type="file"
                            id="form.photo"
                            wire:model="form.photo" required
                        />
                        <div wire:loading wire:target="form.photo">Uploading...</div>
                        @error('form.photo')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="form.name" class="form-label">पुरा नाम नेपालीमा</label>
                        <input
                            name="form.name"
                            class="form-control @error('form.name') is-invalid @enderror"
                            type="text"
                            id="form.name"
                            placeholder="पुरा नाम नेपालीमा"
                            wire:model="form.name" required
                        />
                        @error('form.name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.name_en" class="form-label">पुरा नाम (English)</label>
                        <input
                            name="form.name_en"
                            class="form-control @error('form.name_en') is-invalid @enderror"
                            type="text"
                            id="form.name_en"
                            placeholder="पुरा नाम (English)"
                            wire:model="form.name_en" required
                        />
                        @error('form.name_en')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="form.gender" class="form-label">लिङ्ग</label>
                        <select
                            class="form-select @error('form.gender') is-invalid @enderror"
                            wire:model="form.gender"
                            id="form.gender" required>
                            <option value="">---लिङ्ग छान्नुहोस् ---</option>
                            @foreach(\App\Enums\Gender::cases() as $gender)
                                <option
                                    value="{{$gender->value}}">{{$gender->label()}}</option>
                            @endforeach
                        </select>
                        @error('form.gender')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dob" class="form-label">जन्म मिति (बि.स.)</label>
                        <input
                            class="form-control  @error('form.dob') is-invalid @enderror"
                            type="text"
                            id="dob"
                            placeholder="जन्म मिति (बि.स.)"
                            wire:model="form.dob" required
                        />
                        @error('form.dob')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dob_ad" class="form-label">जन्म मिति (ई.स.)</label>
                        <input readonly
                               class="form-control   @error('form.dob_ad') is-invalid @enderror"
                               type="text"
                               id="dob_ad"
                               placeholder="जन्म मिति (ई.स.)"
                               wire:model="form.dob_ad" required
                        />
                        @error('form.dob_ad')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="citizenship_no" class="form-label">नागरिकता नं.</label>
                        <input readonly
                               class="form-control   @error('form.citizenship_no') is-invalid @enderror"
                               type="text"
                               id="citizenship_no"
                               placeholder="नागरिकता नं."
                               wire:model="form.citizenship_no" required
                        />
                        @error('form.citizenship_no')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.disability_type_id" class="form-label">अपांगता</label>
                        <select
                            class="form-select @error('form.disability_type_id') is-invalid @enderror"
                            wire:model="form.disability_type_id"
                            id="form.disability_type_id" required>
                            <option value="">---अपांगता छान्नुहोस् ---</option>
                            @foreach($disabilityTypes as $disabilityType)
                                <option
                                    value="{{$disabilityType->id}}">{{$disabilityType->title}}</option>
                            @endforeach
                        </select>
                        @error('form.disability_type_id')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.mother_name" class="form-label">आमाको नाम</label>
                        <input
                            name="form.name"
                            class="form-control @error('form.mother_name') is-invalid @enderror"
                            type="text"
                            id="form.mother_name"
                            placeholder="आमाको नाम"
                            wire:model="form.mother_name" required
                        />
                        @error('form.mother_name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.mother_name_en" class="form-label">आमाको नाम (English)</label>
                        <input
                            name="form.mother_name_en"
                            class="form-control @error('form.mother_name_en') is-invalid @enderror"
                            type="text"
                            id="form.mother_name_en"
                            placeholder="आमाको नाम (English)"
                            wire:model="form.mother_name_en" required
                        />
                        @error('form.mother_name_en')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.father_name" class="form-label">बाबुको नाम</label>
                        <input
                            name="form.father_name"
                            class="form-control @error('form.father_name') is-invalid @enderror"
                            type="text"
                            id="form.father_name"
                            placeholder="बाबुको नाम"
                            wire:model="form.father_name" required
                        />
                        @error('form.father_name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.father_name_en" class="form-label">बाबुको नाम (English)</label>
                        <input
                            name="form.father_name_en"
                            class="form-control @error('form.father_name_en') is-invalid @enderror"
                            type="text"
                            id="form.father_name_en"
                            placeholder="बाबुको नाम (English)"
                            wire:model="form.father_name_en" required
                        />
                        @error('form.father_name_en')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </fieldset>
            <fieldset class="mt-3">
                <legend> ठेगाना</legend>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="form.province_id" class="form-label">प्रदेश</label>
                        <select
                            class="form-select @error('form.province_id') is-invalid @enderror"
                            wire:model="form.province_id"
                            id="form.province_id" required>
                            <option value="">---प्रदेश छान्नुहोस् ---</option>
                            @foreach($provinces as $province)
                                <option
                                    value="{{$province->id}}">{{$province->province}}</option>
                            @endforeach
                        </select>
                        @error('form.province_id')
                        <div class="invalid-feedback ">{{$message}} </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.district_id" class="form-label">जिल्ला</label>
                        <select
                            class="form-select @error('form.district_id') is-invalid @enderror"
                            wire:model="form.district_id"
                            id="form.district_id" required>
                            <option value="">---जिल्ला छान्नुहोस् ---</option>
                            @foreach($districts as $permanent_district)
                                <option
                                    value="{{$permanent_district->id}}">{{$permanent_district->district}}</option>
                            @endforeach
                        </select>
                        @error('form.district_id')
                        <div class="invalid-feedback ">{{$message}} </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.local_body_id" class="form-label">पालिका</label>
                        <select
                            class="form-select @error('form.local_body_id') is-invalid @enderror"
                            wire:model="form.local_body_id"
                            id="form.local_body_id" required>
                            <option value="">---पालिका छान्नुहोस् ---</option>
                            @foreach($localBodies as $permanent_localBody)
                                <option
                                    value="{{$permanent_localBody->id}}">{{$permanent_localBody->local_body}}</option>
                            @endforeach
                        </select>
                        @error('form.local_body_id')
                        <div class="invalid-feedback ">{{$message}} </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.ward_no" class="form-label">वार्ड</label>
                        <select
                            class="form-select @error('form.ward_no') is-invalid @enderror"
                            wire:model="form.ward_no"
                            id="form.ward_no" required>
                            <option value="">---वार्ड छान्नुहोस् ---</option>
                            @foreach($wards as $permanent_ward)
                                <option
                                    value="{{$permanent_ward}}">{{$permanent_ward}}</option>
                            @endforeach
                        </select>
                        @error('form.ward_no')
                        <div class="invalid-feedback ">{{$message}} </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="form.tole" class="form-label">टोल</label>
                        <input
                            name="form.tole"
                            class="form-control  @error('form.tole') is-invalid @enderror"
                            type="text"
                            id="form.tole"
                            placeholder="टोल"
                            wire:model="form.tole" required
                        />
                        @error('form.tole')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                </div>
            </fieldset>
            <fieldset class="mt-3">
                <legend>परिवारको सदस्य वा संरक्षकको</legend>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="form.guardian_name" class="form-label">संरक्षकको नाम</label>
                        <input
                            name="form.guardian_name"
                            class="form-control  @error('form.guardian_name') is-invalid @enderror"
                            type="text"
                            id="form.guardian_name"
                            placeholder="संरक्षकको नाम"
                            wire:model="form.guardian_name"
                            required
                        />
                        @error('form.guardian_name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="form.guardian_name_en" class="form-label">संरक्षकको नाम (English)</label>
                        <input
                            name="form.guardian_name_en"
                            class="form-control  @error('form.guardian_name_en') is-invalid @enderror"
                            type="text"
                            id="form.guardian_name_en"
                            placeholder="संरक्षकको नाम (English)"
                            wire:model="form.guardian_name_en"
                            required
                        />
                        @error('form.guardian_name_en')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="form.relationship_id" class="form-label">नाता</label>
                        <select
                            class="form-select @error('form.relationship_id') is-invalid @enderror"
                            wire:model="form.relationship_id"
                            id="form.relationship_id" required>
                            <option value="">---नाता छान्नुहोस् ---</option>
                            @foreach($relations as $relation)
                                <option
                                    value="{{$relation->id}}">{{$relation->title}}</option>
                            @endforeach
                        </select>
                        @error('form.relationship_id')
                        <div class="invalid-feedback ">{{$message}} </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="form.phone" class="form-label">टेलिफोन वा मोबाईल नं.</label>
                        <input
                            name="form.phone"
                            class="form-control  @error('form.phone') is-invalid @enderror"
                            type="text"
                            id="form.phone"
                            placeholder="टेलिफोन वा मोबाईल नं."
                            wire:model="form.phone"
                            required
                        />
                        @error('form.phone')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                </div>
            </fieldset>
            <div class="d-flex justify-content-end mt-2">

                <button type="submit" class="btn btn-primary">
                    पेश गर्नुहोस
                </button>
            </div>
        </div>
    </form>
</div>

@once
    @push('scripts')
        <script src="{{asset('assets/backend/js/plugins/datepicker.min.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#dob").nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    onChange: function () {
                        let inputFieldDate = $("#dob").val();
                        let parsedDate = NepaliFunctions.ParseDate(inputFieldDate);
                        let englishDate = NepaliFunctions.BS2AD(parsedDate.parsedDate)
                        let formattedDate = NepaliFunctions.ConvertDateFormat(englishDate, "YYYY-MM-DD")
                        $("#dob_ad").val(formattedDate);

                        Livewire.emit('dobChanged', inputFieldDate, formattedDate);
                    }
                });
            });
        </script>
        <script src="{{ asset('assets/backend/finger/js/jquery-1.11.2.min.js') }}" defer></script>
    @endpush
@endonce



