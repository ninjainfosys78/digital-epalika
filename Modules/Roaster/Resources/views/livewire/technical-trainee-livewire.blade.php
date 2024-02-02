<div class=" p-2 mt-3">
    <form wire:submit.prevent="save">
        <fieldset class="border p-2">
            <legend class="float-none w-auto">१. व्यक्तिगत विवरण</legend>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="employee_name" class="form-label">पुरा नाम *</label>
                    <input type="text" wire:model="form.employee_name"
                           class="form-control @error('form.employee_name') is-invalid @enderror" id="employee_name"
                           placeholder="पुरा नाम" required>
                    @error('form.employee_name')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="formFile" class="form-label">फोटो *</label>
                    <input wire:model="form.photo" class="form-control @error('form.photo') is-invalid @enderror"
                           type="file" id="formFile" required>
                    @error('form.photo')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="designation_id">पद *</label>
                    <select wire:model="form.designation_id"
                            class="form-select @error('form.designation_id') is-invalid @enderror" id="designation_id" required>
                        <option value="">-- पद छान्नुहोस् --</option>
                        @foreach($designations as $designation)
                            <option value="{{$designation->id}}">{{$designation->title}}</option>
                        @endforeach
                    </select>
                    @error('form.designation_id')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="department_id">सेवा समुह *</label>
                    <select wire:model="form.department_id"
                            class="form-select @error('form.department_id') is-invalid @enderror" id="department_id" required>
                        <option value="">-- सेवा समुह छान्नुहोस् --</option>
                        @foreach($departments as $department)
                            <option value="{{$department->id}}">{{$department->title}}</option>
                        @endforeach
                    </select>
                    @error('form.department_id')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="service_time" class="form-label">सेवा अवधि *</label>
                    <input type="text" wire:model="form.service_time"
                           class="form-control @error('form.service_time') is-invalid @enderror" id="service_time"
                           placeholder="सेवा अवधि">
                    @error('form.service_time')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="contact_no" class="form-label">सम्पर्क न. * </label>
                    <input type="text" wire:model="form.contact_no"
                           class="form-control @error('form.contact_no') is-invalid @enderror" id="contact_no"
                           placeholder="सम्पर्क न." required>
                    @error('form.contact_no')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="email" class="form-label">इमेल </label>
                    <input type="email" wire:model="form.email"
                           class="form-control @error('form.email') is-invalid @enderror" id="email"
                           placeholder="इमेल">
                    @error('form.email')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="education_qualification" class="form-label">शैक्षिक योग्यता * </label>
                    <input type="text" wire:model="form.education_qualification" class="form-control"
                           id="education_qualification"
                           placeholder="शैक्षिक योग्यता"
                           required>
                    @error('form.education_qualification')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
        <fieldset class="border p-2 mt-2">
            <legend class="float-none w-auto">२. ठेगाना</legend>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="province_id" class="form-label">प्रदेश *</label>
                    <select wire:model="form.province_id"
                            class="form-select @error('form.province_id') is-invalid @enderror" id="province_id" required>
                        <option value="">-- प्रदेश छान्नुहोस्--</option>
                        @foreach($provinces as $province)
                            <option value="{{$province->id}}">{{$province->province}}</option>
                        @endforeach
                    </select>
                    @error('form.province_id')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="district_id" class="form-label">जिल्ला *</label>
                    <select wire:model="form.district_id"
                            class="form-select @error('form.district_id') is-invalid @enderror" id="district_id" required>
                        <option value="">-- जिल्ला छान्नुहोस्--</option>
                        @foreach($districts as $district)
                            <option value="{{$district->id}}">{{$district->district}}</option>
                        @endforeach
                    </select>
                    @error('form.district_id')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="local_body_id" class="form-label">पालिका *</label>
                    <select wire:model="form.local_body_id"
                            class="form-select @error('form.local_body_id') is-invalid @enderror"
                            id="local_body_id" required>
                        <option value="">-- पालिका छान्नुहोस्--</option>
                        @foreach($localBodies as $localBody)
                            <option value="{{$localBody->id}}">{{$localBody->local_body}}</option>
                        @endforeach
                    </select>
                    @error('form.local_body_id')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="ward_no" class="form-label">वडा नं. *</label>
                    <select wire:model="form.ward_no"
                            class="form-select @error('form.ward_no') is-invalid @enderror" id="ward_no" required>
                        <option value="">-- वडा छान्नुहोस्--</option>
                        @foreach($wards as $ward)
                            <option value="{{$ward}}">{{$ward}}</option>
                        @endforeach
                    </select>
                    @error('form.ward_no')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="tole" class="form-label @error('form.tole') is-invalid @enderror">टोल</label>
                    <input type="text" wire:model="form.tole" class="form-control" id="tole" placeholder="टोल">
                    @error('form.tole')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
        <fieldset class="border p-2 mt-2">
            <legend class="float-none w-auto">३. कार्यालयको विवरण</legend>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="office_name" class="form-label @error('form.office_name') is-invalid @enderror">कार्यालयको
                        नाम *</label>
                    <input type="text" wire:model="form.office_name" class="form-control" id="office_name"
                           placeholder="कार्यालयको नाम" required>
                    @error('form.office_name')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="office_address" class="form-label @error('form.office_address') is-invalid @enderror">कार्यालयको
                        ठेगाना *</label>
                    <input type="text" wire:model="form.office_address" class="form-control" id="office_address"
                           placeholder="कार्यालयको ठेगाना" required>
                    @error('form.office_address')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="office_phone" class="form-label @error('form.office_phone') is-invalid @enderror">कार्यालयको
                        फोन नम्बर *</label>
                    <input type="text" wire:model="form.office_phone" class="form-control" id="office_phone"
                           placeholder="कार्यालयको फोन नम्बर" required>
                    @error('form.office_phone')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="office_email" class="form-label @error('form.office_email') is-invalid @enderror">
                        कार्यालयको इमेल
                    </label>
                    <input type="text" wire:model="form.office_email" class="form-control" id="office_email"
                           placeholder="कार्यालयको इमेल">
                    @error('form.office_email')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" id="nomination_letter">मनोनयन पत्र * <a
                            href="{{asset('assets/front-end/files/application_form.pdf')}}"><small class="text-sm">(मनोनयन
                                पत्रको डाउनलोड गर्न click गर्नुहोस)</small></a></label>
                    <input wire:model="form.nomination_letter"
                           class="form-control @error('form.nomination_letter') is-invalid @enderror" type="file"
                           id="nomination_letter" required>
                    @error('form.nomination_letter')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="recommendation_letter">सिफारिस *</label>
                    <input wire:model="form.recommendation_letter"
                           class="form-control @error('form.recommendation_letter') is-invalid @enderror" type="file"
                           id="recommendation_letter" required>
                    @error('form.recommendation_letter')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
        <fieldset class="border p-2 mt-2">
            <legend class="float-none w-auto">४. अन्य कागजातहरु</legend>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>क्र.सं.</th>
                        <th>कागजातको नाम</th>
                        <th>फाइल</th>
                        <th>  <button class="btn btn-primary btn-sm" wire:click.prevent="documentsArrayIncrement">
                                <i class="fa fa-plus-square"></i>
                            </button></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($form['documents'] as $index=>$document)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <input type="text"
                                       wire:model="form.documents.{{$index}}.title"
                                       class="form-control @error('form.documents.'.$index.'.title') is-invalid @enderror"
                                       placeholder="कागजातको नाम" required>
                                @error('form.documents.'.$index.'.title')
                                <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                @enderror
                            </td>
                            <td>
                                <input type="file"
                                       class="form-control @error('form.documents.'.$index.'.document') is-invalid @enderror"
                                       wire:model="form.documents.{{$index}}.document" required>
                                @error('form.documents.'.$index.'.document')
                                <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                @enderror
                            </td>
                            <td>

                                <button class="btn btn-danger btn-sm" wire:click.prevent="documentsArrayDecrement({{$index}})">
                                    <i class="fa fa-minus-square"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="8">
                                रो थप्नको लागि

                                <button class="btn btn-primary btn-sm" wire:click.prevent="documentsArrayIncrement">
                                    <i class="fa fa-plus-square"></i>
                                </button>
                                थिच्नुहोस
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                @error('form.documents')
                <span class="text-danger">
                {{$message}}
            </span>
                @enderror
            </div>
        </fieldset>
        <div class="col-12 d-flex pb-2 justify-content-around">
            <button type="submit" class="btn btn-primary">पेश गर्नुहोस्</button>
        </div>
    </form>
</div>


