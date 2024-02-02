<div>
    <form wire:submit.prevent="storeData">

        <fieldset class="border p-2">
            <legend class="float-none w-auto fs-5 text-info">व्यक्तिगत विवरण</legend>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="name" class="form-label">पुरा नाम *</label>
                    <input type="text" class="form-control @error('form.name') is-invalid @enderror" id="name"
                           name="name" placeholder="पुरा नाम" wire:model="form.name">
                    @error('form.name')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="photo" class="form-label">फोटो *</label>
                    <input class="form-control @error('form.photo') is-invalid @enderror" type="file" id="photo"
                           name="photo" wire:model="form.photo">
                    <div wire:loading wire:target="form.photo">Uploading...</div>
                    @error('form.photo')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="designation_id">पद *</label>
                    <select class="form-select @error('form.designation_id') is-invalid @enderror" id="designation_id"
                            name="designation_id" wire:model="form.designation_id">
                        <option value="">पद छान्नुहोस्</option>
                        @foreach($designations as $designation)
                            <option value="{{$designation->id}}">{{$designation->title}}</option>
                        @endforeach
                    </select>
                    @error('form.designation_id')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="department_id">सेवा समुह *</label>
                    <select class="form-select  @error('form.department_id') is-invalid @enderror" id="department_id"
                            name="department_id" wire:model="form.department_id">
                        <option value="">सेवा समुह छान्नुहोस्</option>
                        @foreach($departments as $department)
                            <option value="{{$department->id}}">{{$department->title}}</option>
                        @endforeach
                    </select>
                    @error('form.department_id')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="level" class="form-label">तह </label>
                    <input type="text" class="form-control @error('form.level') is-invalid @enderror" id="level"
                           placeholder="तह" name="level" wire:model="form.level">
                    @error('form.level')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="phone" class="form-label">फोन * </label>
                    <input type="text" class="form-control @error('form.phone') is-invalid @enderror" id="phone"
                           placeholder="98XXXX,98XXXX" name="phone" wire:model="form.phone">
                    @error('form.phone')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="email" class="form-label">इमेल * </label>
                    <input type="email" class="form-control  @error('form.email') is-invalid @enderror" id="email"
                           placeholder="इमेल" name="email" wire:model="form.email">
                    @error('form.email')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="pan_no" class="form-label">स्थायी लेखा नम्बर (PAN No) * </label>
                    <input type="number" class="form-control @error('form.pan') is-invalid @enderror" id="pan_no"
                           placeholder="स्थायी लेखा नम्बर (PAN No)" name="pan" wire:model="form.pan">
                    @error('form.pan')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
            </div>
        </fieldset>

        <fieldset class="border p-2 mt-2">
            <legend class="float-none w-auto fs-5 text-info">ठेगाना</legend>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="province_id">प्रदेश *</label>
                    <select class="form-select @error('form.province_id') is-invalid @enderror" name="province_id"
                            id="province_id" wire:model="form.province_id">
                        <option value="">प्रदेश छान्नुहोस्</option>
                        @foreach($provinces as $province)
                            <option value="{{$province->id}}">{{$province->province}}</option>
                        @endforeach
                    </select>
                    @error('form.province_id')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="district_id">जिल्ला *</label>
                    <select class="form-select @error('form.district_id') is-invalid @enderror" name="district_id"
                            id="district_id" wire:model="form.district_id">
                        <option selected>जिल्ला छान्नुहोस्</option>
                        @foreach($districts as $district)
                            <option value="{{$district->id}}">{{$district->district}}</option>
                        @endforeach
                    </select>
                    @error('form.district_id')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="local_body_id">पालिका *</label>
                    <select class="form-select  @error('form.local_body_id') is-invalid @enderror" name="local_body_id"
                            id="local_body_id" wire:model="form.local_body_id">
                        <option selected>पालिका छान्नुहोस्</option>
                        @foreach($localBodies as $localBody)
                            <option value="{{$localBody->id}}">{{$localBody->local_body}}</option>
                        @endforeach
                    </select>
                    @error('form.local_body_id')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="ward">वडा नं. *</label>
                    <select class="form-select @error('form.ward') is-invalid @enderror" name="ward" id="ward"
                            wire:model="form.ward">
                        <option selected>वडा नं. छान्नुहोस्</option>
                        @foreach($wards as $ward)
                            <option value="{{$ward}}">{{$ward}}</option>
                        @endforeach
                    </select>
                    @error('form.ward')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="tole" class="form-label">टोल</label>
                    <input type="text" class="form-control @error('form.tole') is-invalid @enderror" name="tole"
                           id="tole"
                           placeholder="टोल" wire:model="form.tole">
                    @error('form.tole')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="office" class="form-label">हाल कार्यरत कार्यालयको नाम र ठेगाना</label>
                    <input type="text" class="form-control @error('form.office') is-invalid @enderror" id="office"
                           name="office"
                           placeholder="हाल कार्यरत कार्यालयको नाम र ठेगाना" wire:model="form.office">
                    @error('form.office')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="appointment_date" class="form-label">नियुक्ति लिएको मिति (Y-m-d)</label>
                    <input type="text" class="form-control @error('form.appointment_date') is-invalid @enderror"
                           id="appointment_date" name="appointment_date"
                           placeholder="नियुक्ति लिएको मिति (Y-m-d)" wire:model="form.appointment_date">
                    @error('form.appointment_date')
                    <span class="text-danger">
                             {{$message}}
                         </span>
                    @enderror
                </div>
            </div>

        </fieldset>

        @if(config('trainer.status.bankDetailForm') && config('trainer.type.bankDetailForm') === 'extended')
            <fieldset class="border p-2 mt-2">
                <legend class="float-none w-auto fs-5 text-info">बैंक खाता विवरण</legend>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <tr>
                            <th>क्र.सं.</th>
                            <th>बैंकको नाम</th>
                            <th>शाखा</th>
                            <th>खाता नं.</th>
                            <th>खाता वालाको नाम</th>
                            <th>
                                <button class="btn btn-primary btn-sm" wire:click.prevent="addColumnToBankDetailArray">
                                    <i class="fa fa-plus-square"
                                       ></i>
                                </button>
                               </th>
                        </tr>
                        @forelse($form['bankDetails'] as $index=>$bankDetail)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <input type="text"
                                           class="form-control  @error('form.bankDetails.'.$index.'.bank_name') is-invalid @enderror"
                                           wire:model="form.bankDetails.{{$index}}.bank_name" id=""
                                           placeholder="बैंकको नाम">
                                    @error('form.bankDetails.'.$index.'.bank_name')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control  @error('form.bankDetails.'.$index.'.bank_branch') is-invalid @enderror"
                                           wire:model="form.bankDetails.{{$index}}.bank_branch" id=""
                                           placeholder="शाखा">
                                    @error('form.bankDetails.'.$index.'.bank_branch')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.bankDetails.'.$index.'.account_number') is-invalid @enderror"
                                           wire:model="form.bankDetails.{{$index}}.account_number"
                                           placeholder="खाता नं.">
                                    @error('form.bankDetails.'.$index.'.account_number')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.bankDetails.'.$index.'.account_holder') is-invalid @enderror"
                                           wire:model="form.bankDetails.{{$index}}.account_holder" id=""
                                           placeholder="खाता वालाको नाम">
                                    @error('form.bankDetails.'.$index.'.account_holder')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>

                                    <button class="btn btn-danger btn-sm" wire:click.prevent="removeColumnFromBankDetailArray({{$index}})">
                                        <i class="fa fa-minus-square"
                                        ></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="8">
                                    रो थप्नको लागि

                                    <button class="btn btn-primary btn-sm" wire:click.prevent="addColumnToBankDetailArray">
                                        <i class="fa fa-plus-square"
                                        ></i>
                                    </button>
                                    थिच्नुहोस
                                </td>
                            </tr>
                        @endforelse
                    </table>
                    @error('form.bankDetails')
                    <span class="text-danger">
                {{$message}}
            </span>
                    @enderror
                </div>
            </fieldset>
        @endif

        @if(config('trainer.status.compactForm'))
            <fieldset class="border p-2 mt-2">
                <legend class="float-none w-auto fs-5 text-info">अन्य विवरण</legend>
                <div class="row">
                    @if(config('trainer.type.bankDetailForm') == 'compact')
                        <div class="col-md-3 mb-3">
                            <label for="bank_detail" class="form-label">बैंक खाता</label>
                            <input type="text" class="form-control @error('form.bank_detail') is-invalid @enderror"
                                   id="bank_detail"
                                   placeholder="बैंक खाता" name="bank_detail" wire:model="form.bank_detail">
                            @error('form.bank_detail')
                            <span class="text-danger">
                            {{$message}}
                        </span>
                            @enderror
                        </div>
                    @endif

                    @if(config('trainer.type.experienceForm') == 'compact')
                        <div class="col-md-3 mb-3">
                            <label for="experience" class="form-label">कार्य अनुभव (बर्ष) *</label>
                            <input type="text" class="form-control @error('form.experience') is-invalid @enderror"
                                   id="experience"
                                   placeholder="कार्य अनुभव (बर्ष)" name="experience" wire:model="form.experience">
                            @error('form.experience')
                            <span class="text-danger">
                            {{$message}}
                        </span>
                            @enderror
                        </div>
                    @endif

                    @if(config('trainer.type.qualificationForm') == 'compact')
                        <div class="col-md-3 mb-3">
                            <label for="qualification" class="form-label">शैक्षिक योग्यता *</label>
                            <input type="text" class="form-control @error('form.qualification') is-invalid @enderror"
                                   id="qualification"
                                   placeholder="शैक्षिक योग्यता" name="qualification" wire:model="form.qualification">
                            @error('form.qualification')
                            <span class="text-danger">
                            {{$message}}
                        </span>
                            @enderror
                        </div>
                    @endif

                    @if(config('trainer.type.experienceAsTraineeForm') == 'compact')
                        <div class="col-md-3 mb-3">
                            <label for="experience_as_trainee" class="form-label">संलग्न तालिमको विवरण </label>
                            <input type="text"
                                   class="form-control @error('form.experience_as_trainee') is-invalid @enderror"
                                   id="experience_as_trainee"
                                   placeholder="संलग्न तालिमको विवरण " name="experience_as_trainee"
                                   wire:model="form.experience_as_trainee">
                            @error('form.experience_as_trainee')
                            <span class="text-danger">
                            {{$message}}
                        </span>
                            @enderror
                        </div>
                    @endif

                    @if(config('trainer.type.experienceAsTrainerForm') == 'compact')
                        <div class="col-md-3 mb-3">
                            <label for="experience_as_trainer" class="form-label">तालिममा प्रशिक्षक भएको अनुभव</label>
                            <input type="text"
                                   class="form-control @error('form.experience_as_trainer') is-invalid @enderror"
                                   id="experience_as_trainer"
                                   placeholder="तालिममा प्रशिक्षक भएको अनुभव" name="experience_as_trainer"
                                   wire:model="form.experience_as_trainer">
                            @error('form.experience_as_trainer')
                            <span class="text-danger">
                            {{$message}}
                        </span>
                            @enderror
                        </div>
                    @endif
                </div>
            </fieldset>
        @endif

        @if(config('trainer.status.experienceForm') && config('trainer.type.experienceForm') == 'extended')
            <fieldset class="border p-2 mt-2">
                <legend class="float-none w-auto fs-5 text-info">कार्य अनुभव</legend>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <tr>
                            <th>क्र.सं.</th>
                            <th>कार्यालय/संस्था</th>
                            <th>पद</th>
                            <th>मिति देखि (YYYY-MM-DD)</th>
                            <th>मिति सम्म (YYYY-MM-DD)</th>
                            <th>मुख्य जिम्मेवारी</th>
                            <th>कैफियत</th>
                            <th>
                                <button class="btn btn-primary btn-sm" wire:click.prevent="addColumnToWorkExperienceArray">
                                    <i class="fa fa-plus-square"
                                    ></i>
                                </button>

                            </th>
                        </tr>
                        @forelse($form['workExperiences'] as $index=>$workExperience)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.workExperiences.'.$index.'.office') is-invalid @enderror"
                                           wire:model="form.workExperiences.{{$index}}.office"
                                           placeholder="कार्यालय/संस्था">
                                    @error('form.workExperiences.'.$index.'.office')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <select
                                        class="form-control @error('form.workExperiences.'.$index.'.designation_id') is-invalid @enderror"
                                        wire:model="form.workExperiences.{{$index}}.designation_id">
                                        <option value="">--पद छान्नुहोस्-</option>
                                        @foreach($designations as $designation)
                                            <option value="{{$designation->id}}">{{$designation->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('form.workExperiences.'.$index.'.designation_id')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.workExperiences.'.$index.'.from') is-invalid @enderror"
                                           wire:model="form.workExperiences.{{$index}}.from"
                                           placeholder="YYYY-MM-DD">
                                    @error('form.workExperiences.'.$index.'.from')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.workExperiences.'.$index.'.to') is-invalid @enderror"
                                           wire:model="form.workExperiences.{{$index}}.to"
                                           placeholder="YYYY-MM-DD">
                                    @error('form.workExperiences.'.$index.'.to')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.workExperiences.'.$index.'.responsibility') is-invalid @enderror"
                                           wire:model="form.workExperiences.{{$index}}.responsibility"
                                           placeholder="मुख्य जिम्मेवारी">
                                    @error('form.workExperiences.'.$index.'.responsibility')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input
                                        class="form-control @error('form.workExperiences.'.$index.'.remarks') is-invalid @enderror"
                                        wire:model="form.workExperiences.{{$index}}.remarks"
                                        placeholder="कैफियत">
                                    @error('form.workExperiences.'.$index.'.remarks')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>


                                    <button class="btn btn-danger btn-sm" wire:click.prevent="removeColumnFromWorkExperienceArray({{$index}})">
                                        <i class="fa fa-minus-square"
                                        ></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="8">
                                    रो थप्नको लागि
                                    <button class="btn btn-primary btn-sm" wire:click.prevent="addColumnToWorkExperienceArray">
                                        <i class="fa fa-plus-square"
                                        ></i>

                                    </button>

                                    थिच्नुहोस
                                </td>
                            </tr>
                        @endforelse
                    </table>

                    @error('form.workExperiences')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
            </fieldset>
        @endif

        @if(config('trainer.status.qualificationForm') && config('trainer.type.qualificationForm') == 'extended')
            <fieldset class="border p-2 mt-2">
                <legend class="float-none w-auto fs-5 text-info">शैक्षिक योग्यता</legend>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <tr>
                            <th>क्र.सं.</th>
                            <th>शैक्षिक तह</th>
                            <th>मुख्य विषय</th>
                            <th>विश्वविद्यालय/शैक्षिक संस्था</th>
                            <th>सम्पन्न वर्ष</th>
                            <th>कैफियत</th>
                            <th>

                                <button class="btn btn-primary btn-sm" wire:click.prevent="addColumnToQualificationArray">
                                    <i class="fa fa-plus-square"
                                    ></i>

                                </button>

                            </th>
                        </tr>
                        @forelse($form['qualifications'] as $index=>$qualification)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.qualifications.'.$index.'.achievement') is-invalid @enderror"
                                           wire:model="form.qualifications.{{$index}}.achievement"
                                           placeholder="शैक्षिक तह">
                                    @error('form.qualifications.'.$index.'.achievement')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.qualifications.'.$index.'.major_subjects') is-invalid @enderror"
                                           wire:model="form.qualifications.{{$index}}.major_subjects"
                                           placeholder="मुख्य विषय">
                                    @error('form.qualifications.'.$index.'.major_subjects')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.qualifications.'.$index.'.institute') is-invalid @enderror"
                                           wire:model="form.qualifications.{{$index}}.institute"
                                           placeholder="विश्वविद्यालय/शैक्षिक संस्था">
                                    @error('form.qualifications.'.$index.'.institute')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.qualifications.'.$index.'.passed_year') is-invalid @enderror"
                                           wire:model="form.qualifications.{{$index}}.passed_year"
                                           placeholder="सम्पन्न वर्ष">
                                    @error('form.qualifications.'.$index.'.passed_year')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.qualifications.'.$index.'.remarks') is-invalid @enderror"
                                           wire:model="form.qualifications.{{$index}}.remarks" placeholder="कैफियत">
                                    @error('form.qualifications.'.$index.'.remarks')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm" wire:click.prevent="removeColumnFromQualificationArray({{$index}})">
                                        <i class="fa fa-minus-square"
                                        ></i>

                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="8">
                                    रो थप्नको लागि
                                    <button class="btn btn-primary btn-sm" wire:click.prevent="addColumnToQualificationArray">
                                        <i class="fa fa-plus-square"
                                        ></i>

                                    </button>
                                    थिच्नुहोस


                                </td>


                            </tr>
                        @endforelse
                    </table>
                    @error('form.qualifications')
                    <span class="text-danger">
                {{$message}}
            </span>
                    @enderror
                </div>
            </fieldset>
        @endif

        @if(config('trainer.status.experienceAsTraineeForm') && config('trainer.type.experienceAsTraineeForm') == 'extended')
            <fieldset class="border p-2 mt-2">
                <legend class="float-none w-auto fs-5 text-info">संलग्न तालिमको विवरण</legend>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <tr>
                            <th>क्र.सं.</th>
                            <th>तालिमको विषय</th>
                            <th>तालिम दिने निकाय</th>
                            <th>तालिमको अवधि</th>
                            <th>स्थान</th>
                            <th>
                                <button class="btn btn-primary btn-sm" wire:click.prevent="addColumnToExperienceAsTraineeArray">
                                    <i class="fa fa-plus-square"
                                    ></i>

                                </button>
                            </th>
                        </tr>
                        @forelse($form['experienceAsTrainees'] as $index=>$experienceAsTrainee)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.experienceAsTrainees.'.$index.'.subject') is-invalid @enderror"
                                           wire:model="form.experienceAsTrainees.{{$index}}.subject"
                                           placeholder="तालिमको विषय">
                                    @error('form.experienceAsTrainees.'.$index.'.subject')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.experienceAsTrainees.'.$index.'.provider') is-invalid @enderror"
                                           wire:model="form.experienceAsTrainees.{{$index}}.provider"
                                           placeholder="तालिम दिने निकाय">
                                    @error('form.experienceAsTrainees.'.$index.'.provider')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.experienceAsTrainees.'.$index.'.duration') is-invalid @enderror"
                                           wire:model="form.experienceAsTrainees.{{$index}}.duration"
                                           placeholder="तालिमको अवधि">
                                    @error('form.experienceAsTrainees.'.$index.'.duration')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.experienceAsTrainees.'.$index.'.venue') is-invalid @enderror"
                                           wire:model="form.experienceAsTrainees.{{$index}}.venue" placeholder="स्थान">
                                    @error('form.experienceAsTrainees.'.$index.'.venue')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>

                                    <button class="btn btn-danger btn-sm" wire:click.prevent="removeColumnFromExperienceAsTraineeArray({{$index}})">
                                        <i class="fa fa-minus-square"
                                        ></i>

                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="8">
                                    रो थप्नको लागि

                                    <button class="btn btn-primary btn-sm" wire:click.prevent="addColumnToExperienceAsTraineeArray">
                                        <i class="fa fa-plus-square"
                                        ></i>

                                    </button>
                                    थिच्नुहोस
                                </td>
                            </tr>
                        @endforelse
                    </table>
                    @error('form.experienceAsTrainees')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
            </fieldset>
        @endif

        @if(config('trainer.status.experienceAsTrainerForm') && config('trainer.type.experienceAsTrainerForm') == 'extended')
            <fieldset class="border p-2 mt-2">
                <legend class="float-none w-auto fs-5 text-info">तालिममा प्रशिक्षक भएको अनुभव</legend>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <tr>
                            <th>क्र.सं.</th>
                            <th>तालिमको क्षेत्र</th>
                            <th>प्रशिक्षणको विषय</th>
                            <th>तालिम दिने निकाय</th>
                            <th>तालिमको अवधि</th>
                            <th>सहभागीको स्तर</th>
                            <th>कैफियत</th>
                            <th>


                                    <button class="btn btn-primary btn-sm" wire:click.prevent="addColumnToExperienceAsTrainerArray">
                                        <i class="fa fa-plus-square"
                                        ></i>

                                    </button>
                            </th>
                        </tr>
                        @forelse($form['experienceAsTrainers'] as $index=>$experienceAsTrainer)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.experienceAsTrainers.'.$index.'.sector') is-invalid @enderror"
                                           wire:model="form.experienceAsTrainers.{{$index}}.sector"
                                           placeholder="तालिमको क्षेत्र">
                                    @error('form.experienceAsTrainers.'.$index.'.sector')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.experienceAsTrainers.'.$index.'.subject') is-invalid @enderror"
                                           wire:model="form.experienceAsTrainers.{{$index}}.subject"
                                           placeholder="प्रशिक्षणको विषय">
                                    @error('form.experienceAsTrainers.'.$index.'.subject')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.experienceAsTrainers.'.$index.'.organization') is-invalid @enderror"
                                           wire:model="form.experienceAsTrainers.{{$index}}.organization"
                                           placeholder="तालिम दिने निकाय">
                                    @error('form.experienceAsTrainers.'.$index.'.organization')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.experienceAsTrainers.'.$index.'.training_time') is-invalid @enderror"
                                           wire:model="form.experienceAsTrainers.{{$index}}.training_time"
                                           placeholder="तालिमको अवधि">
                                    @error('form.experienceAsTrainers.'.$index.'.training_time')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.experienceAsTrainers.'.$index.'.training_level') is-invalid @enderror"
                                           wire:model="form.experienceAsTrainers.{{$index}}.training_level"
                                           placeholder="सहभागीको स्तर">
                                    @error('form.experienceAsTrainers.'.$index.'.training_level')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.experienceAsTrainers.'.$index.'.remarks') is-invalid @enderror"
                                           wire:model="form.experienceAsTrainers.{{$index}}.remarks"
                                           placeholder="कैफियत">
                                    @error('form.experienceAsTrainers.'.$index.'.remarks')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>

                                    <button class="btn btn-danger btn-sm" wire:click.prevent="removeColumnFromExperienceAsTrainerArray({{$index}})">
                                        <i class="fa fa-minus-square"
                                        ></i>

                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="8">

                                    रो थप्नको लागि
                                    <button class="btn btn-primary btn-sm" wire:click.prevent="addColumnToExperienceAsTrainerArray">
                                        <i class="fa fa-plus-square"
                                        ></i>

                                    </button>
                                    थिच्नुहोस
                                </td>
                            </tr>
                        @endforelse
                    </table>
                    @error('form.experienceAsTrainers')
                    <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>
            </fieldset>
        @endif

        @if(config('trainer.status.otherDocumentForm'))
            <fieldset class="border p-2 mt-2">
                <legend class="float-none w-auto fs-5 text-info">अन्य कागजातहरु</legend>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <tr>
                            <th>क्र.सं.</th>
                            <th>कागजातको नाम</th>
                            <th>फाइल</th>
                            <th>


                                <button class="btn btn-primary btn-sm" wire:click.prevent="addColumnToDocumentArray">
                                    <i class="fa fa-plus-square"
                                    ></i>

                                </button>
                            </th>
                        </tr>
                        @forelse($form['documents'] as $index=>$document)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <input type="text"
                                           class="form-control @error('form.documents.'.$index.'.title') is-invalid @enderror"
                                           wire:model="form.documents.{{$index}}.title" placeholder="कागजातको नाम">
                                    @error('form.documents.'.$index.'.title')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="file"
                                           class="form-control @error('form.documents.'.$index.'.document') is-invalid @enderror"
                                           wire:model="form.documents.{{$index}}.document">
                                    <div wire:loading wire:target="form.documents.{{$index}}.document">Uploading...
                                    </div>
                                    @error('form.documents.'.$index.'.document')
                                    <span class=" text-danger">
                                    {{ $message}}
                                </span>
                                    @enderror
                                </td>
                                <td>

                                    <button class="btn btn-danger btn-sm" wire:click.prevent="removeColumnFromDocumentArray({{$index}})">
                                        <i class="fa fa-minus-square"
                                        ></i>

                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="8">
                                    रो थप्नको लागि
                                    <button class="btn btn-primary btn-sm" wire:click.prevent="addColumnToDocumentArray">
                                        <i class="fa fa-plus-square"
                                        ></i>

                                    </button>

                                    थिच्नुहोस
                                </td>
                            </tr>
                        @endforelse
                    </table>
                    @error('form.documents')
                    <span class="text-danger">
                {{$message}}
            </span>
                    @enderror
                </div>
            </fieldset>
        @endif


        <fieldset class="border p-2 mt-2 mb-2">
            <legend class="float-none w-auto fs-5 text-info">बिषय विज्ञता</legend>
            <div class="row mt-2">
                @foreach($subjects as $index=>$subject)
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" wire:model="form.subject_ids"
                                   type="checkbox" value="{{$subject->id}}"
                                   id="subject{{$loop->iteration}}">
                            <label class="form-check-label" for="subject{{$loop->iteration}}">
                                {{$subject->title}}
                            </label>
                            @error('form.subject_ids.'.$index)
                            <span class=" text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </div>
            @error('form.subject_ids')
            <span class=" text-danger">
                    {{$message}}
                </span>
            @enderror
        </fieldset>

        <div class="col-12 d-flex pb-2 justify-content-around">
            <button type="submit" class="btn btn-primary  ">पेश गर्नुहोस्</button>
        </div>
    </form>
</div>

