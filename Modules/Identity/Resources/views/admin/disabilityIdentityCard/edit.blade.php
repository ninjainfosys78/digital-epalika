@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('identity.admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">अपाङ्गता परिचय पत्र</li>
                    </ol>
                </div>
                <h4 class="page-title"> अपाङ्गता परिचय पत्र</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ अपाङ्गता परिचय पत्र थप्नुहोस्</h4>
                        <div>
                            <a href="{{route('identity.admin.disabilityIdentityCard.index')}}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-list"></i> अपाङ्गता परिचय पत्र सुची
                            </a>
                        </div>


                    </div>
                </div>
                <div class="card-body">
                    <form method="POST"
                          action="{{route('identity.admin.disabilityIdentityCard.update', $disabilityIdentityCard)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card mt-3">
                            <fieldset>
                                <legend>अपाङ्गता भएको व्यक्तिको विवरण</legend>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span style="border: 1px solid black; display: inline-block; padding: 5px;">
                                            <img src="{{$disabilityIdentityCard->photo_url}}"
                                                 alt="{{$disabilityIdentityCard->name}}" height="100" width="100">
                                        </span>

                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="photo" class="form-label">फोटो</label>
                                        <input
                                            name="photo"
                                            accept="image/*"
                                            class="form-control @error('photo') is-invalid @enderror"
                                            type="file"
                                            id="photo"
                                        />
                                        @error('photo')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="name" class="form-label">पुरा नाम नेपालीमा</label>
                                        <input
                                            name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            type="text"
                                            id="name"
                                            placeholder="पुरा नाम नेपालीमा"
                                            value="{{old('name',$disabilityIdentityCard->name)}}"
                                            required
                                        />
                                        @error('name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="name_en" class="form-label">पुरा नाम (English)</label>
                                        <input
                                            name="name_en"
                                            class="form-control @error('name_en') is-invalid @enderror"
                                            type="text"
                                            id="name_en"
                                            value="{{old('name_en',$disabilityIdentityCard->name_en)}}"
                                            placeholder="पुरा नाम (English)"
                                            required
                                        />
                                        @error('name_en')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="gender" class="form-label">लिङ्ग</label>
                                        <select
                                            class="form-select @error('gender') is-invalid @enderror"
                                            name="gender" id="gender" required>
                                            <option value="">---लिङ्ग छान्नुहोस् ---</option>
                                            @foreach(\App\Enums\Gender::cases() as $gender)
                                                <option
                                                    value="{{$gender->value}}"
                                                    {{old('gender', $disabilityIdentityCard->gender?->value) == $gender->value ? "selected" : ""}}>{{$gender->label()}}</option>
                                            @endforeach
                                        </select>
                                        @error('gender')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <x-date-input-component
                                            nameNe="dob" labelNe="जन्म मिति (बि.स.) *"
                                            nameEn="dob_ad" labelEn="जन्म मिति (ई.स.)"
                                            :showEnglishDate="true"
                                            disable-after="{{$todayDateInBS}}"
                                            disable-after-Ad="{{today()->toDateString()}}"
                                            :editDateEn="$disabilityIdentityCard->dob_ad"
                                            :editDateNe="$disabilityIdentityCard->dob"
                                            :getTodayDate="false"
                                        />
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="disability_type_id" class="form-label">अपांगता</label>
                                        <select
                                            class="form-select @error('disability_type_id') is-invalid @enderror"
                                            name="disability_type_id"
                                            id="disability_type_id" required>
                                            <option value="">---अपांगता छान्नुहोस् ---</option>
                                            @foreach($disabilityTypes as $disabilityType)
                                                <option
                                                    value="{{$disabilityType->id}}"
                                                    {{old('disability_type_id',$disabilityIdentityCard->disability_type_id) == $disabilityType->id ? "selected": ""}}>{{$disabilityType->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('disability_type_id')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="father_name" class="form-label">बाबुको नाम</label>
                                        <input
                                            name="father_name"
                                            class="form-control @error('father_name') is-invalid @enderror"
                                            type="text"
                                            id="father_name"
                                            placeholder="बाबुको नाम"
                                            value="{{old('father_name',$disabilityIdentityCard->father_name)}}" required
                                        />
                                        @error('father_name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="father_name_en" class="form-label">बाबुको नाम (English)</label>
                                        <input
                                            name="father_name_en"
                                            class="form-control @error('father_name_en') is-invalid @enderror"
                                            type="text"
                                            id="father_name_en"
                                            placeholder="बाबुको नाम (English)"
                                            value="{{old('father_name_en',$disabilityIdentityCard->father_name_en)}}"
                                            required
                                        />
                                        @error('father_name_en')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="mother_name" class="form-label">आमाको नाम</label>
                                        <input
                                            name="mother_name"
                                            class="form-control @error('mother_name') is-invalid @enderror"
                                            type="text"
                                            id="mother_name"
                                            placeholder="आमाको नाम"
                                            value="{{old('mother_name',$disabilityIdentityCard->mother_name)}}" required
                                        />
                                        @error('mother_name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="mother_name_en" class="form-label">आमाको नाम (English)</label>
                                        <input
                                            name="mother_name_en"
                                            class="form-control @error('mother_name_en') is-invalid @enderror"
                                            type="text"
                                            id="mother_name_en"
                                            placeholder="आमाको नाम (English)"
                                            value="{{old('mother_name_en',$disabilityIdentityCard->mother_name_en)}}"
                                            required
                                        />
                                        @error('mother_name_en')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>

                                </div>
                            </fieldset>
                            <fieldset class="mt-3">
                                <legend> ठेगाना</legend>
                                @livewire('address',['address' =>
                                [
                                    'province_id' => old('province_id', $disabilityIdentityCard->province_id ?? $officeSetting->province_id),
                                    'district_id' => old('district_id', $disabilityIdentityCard->district_id ?? $officeSetting->district_id),
                                    'local_body_id' => old('local_body_id', $disabilityIdentityCard->local_body_id ?? $officeSetting->local_body_id),
                                    'ward_no' => old('ward_no', $disabilityIdentityCard->ward_no ?? $officeSetting->ward_no),
                                ]])
                                <div class="col-md-12 mb-3">
                                    <label for="tole" class="form-label">टोल</label>
                                    <input
                                        name="tole"
                                        class="form-control  @error('tole') is-invalid @enderror"
                                        type="text"
                                        id="tole"
                                        placeholder="टोल"
                                        value="{{old('tole', $disabilityIdentityCard->tole)}}" required
                                    />
                                    @error('tole')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </fieldset>
                            <fieldset class="mt-3">
                                <legend>कागजात विवरण</legend>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="citizenship_no" class="form-label">नागरिकता नं.</label>
                                        <input
                                            class="form-control   @error('citizenship_no') is-invalid @enderror"
                                            type="text"
                                            id="citizenship_no"
                                            name="citizenship_no"
                                            value="{{old('citizenship_no', $disabilityIdentityCard->citizenship_no)}}"
                                            placeholder="नागरिकता नं."
                                            required
                                            {{ old('birth_registration_no', $disabilityIdentityCard->birth_registration_no) ? "readonly" : ""}}
                                        />
                                        @error('citizenship_no')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="birth_registration_no" class="form-label">जन्म दर्ता
                                            नं.</label>
                                        <input
                                            class="form-control @error('birth_registration_no') is-invalid @enderror"
                                            type="text"
                                            id="birth_registration_no"
                                            name="birth_registration_no"
                                            value="{{old('birth_registration_no', $disabilityIdentityCard->birth_registration_no)}}"
                                            placeholder="जन्म दर्ता नं."
                                            required
                                            {{ old('citizenship_no', $disabilityIdentityCard->citizenship_no)  ? "readonly" : ""}}
                                        />
                                        @error('birth_registration_no')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mt-3">
                                <legend>परिवारको सदस्य वा संरक्षकको</legend>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="guardian_name" class="form-label">संरक्षकको नाम</label>
                                        <input
                                            name="guardian_name"
                                            class="form-control  @error('guardian_name') is-invalid @enderror"
                                            type="text"
                                            id="guardian_name"
                                            placeholder="संरक्षकको नाम"
                                            value="{{old('guardian_name', $disabilityIdentityCard->guardian_name)}}"
                                            required
                                        />
                                        @error('guardian_name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="guardian_name_en" class="form-label">संरक्षकको नाम
                                            (English)</label>
                                        <input
                                            name="guardian_name_en"
                                            class="form-control  @error('guardian_name_en') is-invalid @enderror"
                                            type="text"
                                            id="guardian_name_en"
                                            placeholder="संरक्षकको नाम (English)"
                                            value="{{old('guardian_name_en', $disabilityIdentityCard->guardian_name_en)}}"
                                            required
                                        />
                                        @error('guardian_name_en')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="relationship_id" class="form-label">नाता</label>
                                        <select
                                            class="form-select @error('relationship_id') is-invalid @enderror"
                                            name="relationship_id" id="relationship_id" required>
                                            <option value="">---नाता छान्नुहोस् ---</option>
                                            @foreach($relations as $relation)
                                                <option
                                                    value="{{$relation->id}}"
                                                    {{old("relationship_id", $disabilityIdentityCard->relationship_id)==$relation->id ? "selected": ""}}>{{$relation->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('relationship_id')
                                        <div class="invalid-feedback ">{{$message}} </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">टेलिफोन वा मोबाईल नं.</label>
                                        <input
                                            name="phone"
                                            class="form-control  @error('phone') is-invalid @enderror"
                                            type="text"
                                            id="phone"
                                            placeholder="टेलिफोन वा मोबाईल नं."
                                            value="{{old('phone', $disabilityIdentityCard->phone)}}"
                                            required
                                        />
                                        @error('phone')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="mt-3">
                                <legend>पूर्ण विवरण</legend>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="is_full_detail_required" class="form-label">
                                            पूर्ण विवरण आवश्यक छ ?
                                        </label>
                                        <select name="is_full_detail_required" id="is_full_detail_required"
                                                class="form-select">
                                            <option value="0"
                                                {{ old('is_full_detail_required', $disabilityIdentityCard->is_full_detail_required) == '0' ? 'selected' : '' }}>
                                                छैन
                                            </option>
                                            <option value="1"
                                                {{ old('is_full_detail_required', $disabilityIdentityCard->is_full_detail_required) == '1' ? 'selected' : '' }}>
                                                छ
                                            </option>
                                        </select>
                                        @error('is_full_detail_required')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>
                            <div id="full-detail-fields">
                                <fieldset class="mt-3">
                                    <legend>अपाङ्गताको कारण</legend>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="disability_reason_id" class="form-label">अपाङ्गताको
                                                कारण</label>
                                            <select
                                                class="form-select @error('fullDetail.disability_reason_id') is-invalid @enderror"
                                                name="fullDetail[disability_reason_id]" id="disability_reason_id">
                                                <option value="">---अपाङ्गताको कारण छान्नुहोस् ---</option>
                                                @foreach ($disabilityReasons as $disabilityReason)
                                                    <option value="{{ $disabilityReason->id }}"
                                                        {{ old('fullDetail.disability_reason_id', $disabilityIdentityCard->disability_reason_id) == $disabilityReason->id ? 'selected' : '' }}>
                                                        {{ $disabilityReason->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('fullDetail.disability_reason_id')
                                            <div class="invalid-feedback ">{{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-3">
                                    <legend>परिचय खुलाउने विवरण</legend>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="blood_group" class="form-label"> रक्त समुह </label>
                                            <select name="fullDetail[blood_group]" id="blood_group"
                                                    class="form-select  @error('fullDetail.blood_group') is-invalid @enderror">
                                                <option value="">--रक्त समुह छान्नुहोस्--</option>
                                                @foreach (\App\Enums\BloodGroupEnum::cases() as $case)
                                                    <option value="{{ $case->value }}"
                                                        {{ old('fullDetail.blood_group', $disabilityIdentityCard->blood_group?->value) == $case->value ? 'selected' : '' }}>
                                                        {{ $case->label() }}</option>
                                                @endforeach
                                            </select>

                                            @error('fullDetail.blood_group')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-3">
                                    <legend>सहयोग सामाग्री प्रयोग गर्नुपर्ने आबश्यकता</legend>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="material_description" class="form-label"> सामाग्री
                                                विवरण </label>
                                            <input name="fullDetail[material_description]"
                                                   class="form-control  @error('fullDetail.material_description') is-invalid @enderror"
                                                   type="text" id="material_description"
                                                   value="{{ old('fullDetail.material_description', $disabilityIdentityCard->material_description) }}"
                                                   placeholder=" सामाग्री विवरण " />
                                            @error('fullDetail.material_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </fieldset>
                                <fieldset class="mt-3">
                                    <legend>पछिल्लो सैक्षिक योग्यता</legend>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="qualification" class="form-label"> पछिल्लो सैक्षिक
                                                योग्यता </label>
                                            <select
                                                class="form-select @error('fullDetail.qualification') is-invalid @enderror"
                                                name="fullDetail[qualification]" id="qualification">
                                                <option value="">---छान्नुहोस् ---</option>
                                                @foreach (\Modules\BusinessRegistration\Enums\Qualification::cases() as $qualification)
                                                    <option value="{{ $qualification->value }}"
                                                        {{ old('fullDetail.qualification', $disabilityIdentityCard->qualification?->value) == $qualification->value ? 'selected' : '' }}>
                                                        {{ $qualification->label() }}</option>
                                                @endforeach
                                            </select>
                                            @error('fullDetail.qualification')
                                            <div class="invalid-feedback ">{{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-3">
                                    <legend>दैनिक क्रियाकलाप गर्न</legend>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="daily_activity" class="form-label"> दैनिक क्रियाकलाप
                                                गर्न </label>
                                            <select
                                                class="form-select @error('fullDetail.daily_activity') is-invalid @enderror"
                                                name="fullDetail[daily_activity]" id="daily_activity">
                                                <option value="">---छान्नुहोस् ---</option>

                                                <option value="1"
                                                    {{ old('fullDetail.daily_activity', $disabilityIdentityCard->daily_activity) == 1 ? 'selected' : '' }}>
                                                    सक्ने
                                                </option>
                                                <option value="0"
                                                    {{ old('fullDetail.daily_activity', $disabilityIdentityCard->daily_activity) == 0 ? 'selected' : '' }}>
                                                    नसक्ने
                                                </option>
                                            </select>
                                            @error('fullDetail.daily_activity')
                                            <div class="invalid-feedback ">{{ $message }} </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="supporting_material" class="form-label"> साहायक सामाग्री
                                                प्रयोग
                                                गर्ने </label>
                                            <select
                                                class="form-select @error('fullDetail.supporting_material') is-invalid @enderror"
                                                name="fullDetail[supporting_material]" id="supporting_material">
                                                <option value="">---छान्नुहोस् ---</option>

                                                <option value="1"
                                                    {{ old('fullDetail.supporting_material', $disabilityIdentityCard->supporting_material) == 1 ? 'selected' : '' }}>
                                                    गरेको
                                                </option>
                                                <option value="0"
                                                    {{ old('fullDetail.supporting_material', $disabilityIdentityCard->supporting_material) == 0 ? 'selected' : '' }}>
                                                    नगरेको
                                                </option>
                                            </select>
                                            @error('fullDetail.supporting_material')
                                            <div class="invalid-feedback ">{{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset class="mt-3">
                                    <legend>अन्य व्यक्तिको सहयोग लिनु पर्ने भए त्यस्तो सहयोग लिनु पर्ने काम</legend>
                                    @livewire('identity::task-livewire', [
                                        'tasks' => old('fullDetail.helping_task', $disabilityIdentityCard->helping_task) ?? [],
                                        'hasNameGroup' => true,
                                    ])
                                </fieldset>
                                <fieldset class="mt-3">
                                    <legend>अन्य व्यक्तिको सहयोग बिना गर्न सक्ने दैनिक कार्य</legend>
                                    @livewire('identity::without-helping-task-livewire', [
                                        'tasks' => old('fullDetail.without_helping_task', $disabilityIdentityCard->without_helping_task) ?? [],
                                        'hasNameGroup' => true,
                                    ])
                                </fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset class="mt-3">
                                            <legend>कुनै तालिम प्राप्त गरेको भए मुख्य तालिमको</legend>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="main_training_name" class="form-label"> नाम</label>
                                                    <input name="fullDetail[main_training_name]"
                                                           class="form-control  @error('fullDetail.main_training_name') is-invalid @enderror"
                                                           type="text" id="fullDetail.main_training_name"
                                                           placeholder="नाम"
                                                           value="{{ old('fullDetail.main_training_name') }}" />
                                                    @error('fullDetail.main_training_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="mt-3">
                                            <legend> हालको पेसा</legend>
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="occupation_id" class="form-label"> हालको पेसा </label>
                                                    <select
                                                        class="form-select @error('fullDetail.occupation_id') is-invalid @enderror"
                                                        name="fullDetail[occupation_id]" id="occupation_id">
                                                        <option value="">---छान्नुहोस् ---</option>
                                                        @foreach ($occupations as $occupation)
                                                            <option value="{{ $occupation->id }}"
                                                                {{ old('fullDetail.occupation_id', $disabilityIdentityCard->occupation_id) == $occupation->id ? 'selected' : '' }}>
                                                                {{ $occupation->title }}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('fullDetail.occupation_id')
                                                    <div class="invalid-feedback ">{{ $message }} </div>
                                                    @enderror
                                                </div>

                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-2">

                                <button type="submit" class="btn btn-primary">
                                    पेश गर्नुहोस
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {

                const is_full_detail_required = $('#is_full_detail_required').val();

                toggleFullDetailFields(is_full_detail_required)

                $('#is_full_detail_required').on('change', function() {
                    toggleFullDetailFields($(this).val())
                })

                function toggleFullDetailFields(required) {
                    if (required == "1") {
                        $('#full-detail-fields').removeClass('d-none')
                    } else {
                        $('#full-detail-fields').addClass('d-none')
                    }
                }
            })
        </script>
    @endpush
@endsection


