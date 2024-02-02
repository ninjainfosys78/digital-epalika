@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('identity.admin.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">अपाङ्गता परिचय पत्र</li>
                        <li class="breadcrumb-item active">पूर्ण विवरण</li>
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
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">अपाङ्गता परिचय पत्रहरु</h4>

                    </div>
                </div>
                <div class="card-body">
                    <form method="POST"
                          action="{{ route('identity.admin.disabilityFullDetail.update', $disabilityIdentityCard) }}"
                          enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card mt-3">
                            <fieldset class="mt-3">
                                <legend>अपाङ्गताको कारण</legend>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="disability_reason_id" class="form-label">अपाङ्गताको
                                            कारण</label>
                                        <select class="form-select @error('disability_reason_id') is-invalid @enderror"
                                                name="disability_reason_id" id="disability_reason_id">
                                            <option value="">---अपाङ्गताको कारण छान्नुहोस् ---</option>
                                            @foreach ($disabilityReasons as $disabilityReason)
                                                <option value="{{ $disabilityReason->id }}"
                                                    {{ old('disability_reason_id', $disabilityIdentityCard->disability_reason_id) == $disabilityReason->id ? 'selected' : '' }}>
                                                    {{ $disabilityReason->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('disability_reason_id')
                                        <div class="invalid-feedback ">{{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mt-3">
                                <legend>परिचय खुलाउने विवरण</legend>
                                <div class="row">
                                    @if (!is_null($disabilityIdentityCard->birth_registration_no))
                                        <div class="col-md-4 mb-3">
                                            <label for="birth_registration_no" class="form-label"> जन्म दर्ता
                                                नं. </label>
                                            <input name="birth_registration_no"
                                                   class="form-control  @error('birth_registration_no') is-invalid @enderror"
                                                   type="text"
                                                   value="{{ old('birth_registration_no', $disabilityIdentityCard->birth_registration_no) }}"
                                                   id="birth_registration_no" placeholder=" जन्म दर्ता नं. "/>
                                            @error('birth_registration_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif
                                    @if (!is_null($disabilityIdentityCard->citizenship_no))
                                        <div class="col-md-4 mb-3">
                                            <label for="citizenship_no" class="form-label"> नागरिकता नं. </label>
                                            <input name="citizenship_no"
                                                   class="form-control  @error('citizenship_no') is-invalid @enderror"
                                                   type="text" id="citizenship_no" placeholder="नागरिकता नं."
                                                   value="{{ old('citizenship_no', $disabilityIdentityCard->citizenship_no) }}"
                                                {{ is_null(old('citizenship_no', $disabilityIdentityCard->citizenship_no)) ?: 'readonly' }} />
                                            @error('citizenship_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="citizenship_no_place" class="form-label"> नागरिकता जारि भएको
                                                जिल्ला </label>
                                            <select name="citizenship_no_place" id="citizenship_no_place"
                                                    class="form-select  @error('citizenship_no_place') is-invalid @enderror">
                                                <option value="">--जारि जिल्ला छान्नुहोस्--</option>
                                                @foreach (get_districts() as $district)
                                                    <option value="{{ $district->district }}"
                                                        {{ old('district', $disabilityIdentityCard->district) == $district->district ? 'selected' : '' }}>
                                                        {{ $district->district }}</option>
                                                @endforeach
                                            </select>

                                            @error('citizenship_no_place')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <x-date-input-component
                                                nameNe="citizenship_date"
                                                labelNe="नागरिकता जारि भएको मिति (बि.स.) *"
                                                nameEn="citizenship_date_ad"
                                                labelEn="नागरिकता जारि भएको मिति (ई.स.)"
                                                disable-after="{{ $todayDateInBS }}"
                                                disable-after-Ad="{{ today()->toDateString() }}"
                                                :editDateEn="$disabilityIdentityCard->citizenship_date_ad ?? ''"
                                                :editDateNe="$disabilityIdentityCard->citizenship_date ?? ''"/>
                                        </div>
                                    @endif
                                    <div class="col-md-4 mb-3">
                                        <label for="document_photo" class="form-label">
                                            {{ !is_null($disabilityIdentityCard->citizenship_no) ? 'नागरिकता (अगाडी)' : 'जन्मदर्ता' }}</label>
                                        <input name="document_photo"
                                               class="form-control  @error('document_photo') is-invalid @enderror"
                                               type="file" id="document_photo"/>
                                        @error('document_photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if (!is_null($disabilityIdentityCard->citizenship_no))
                                        <div class="col-md-4 mb-3">
                                            <label for="document_photo_back" class="form-label">
                                                नागरिकता (पछाडी) </label>
                                            <input name="document_photo_back"
                                                   class="form-control  @error('document_photo_back') is-invalid @enderror"
                                                   type="file" id="document_photo_back"/>
                                            @error('document_photo_back')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif
                                    <div class="col-md-4 mb-3">
                                        <label for="blood_group" class="form-label"> रक्त समुह </label>
                                        <select name="blood_group" id="blood_group"
                                                class="form-select  @error('blood_group') is-invalid @enderror">
                                            <option value="">--रक्त समुह छान्नुहोस्--</option>
                                            @foreach (\App\Enums\BloodGroupEnum::cases() as $case)
                                                <option value="{{ $case->value }}"
                                                    {{ old('blood_group', $disabilityIdentityCard->blood_group->value ??'') == $case->value ? 'selected' : '' }}>
                                                    {{ $case->label() }}</option>
                                            @endforeach
                                        </select>

                                        @error('blood_group')
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
                                        <input name="material_description"
                                               class="form-control  @error('material_description') is-invalid @enderror"
                                               type="text" id="material_description"
                                               value="{{ old('material_description', $disabilityIdentityCard->material_description) }}"
                                               placeholder=" सामाग्री विवरण "/>
                                        @error('material_description')
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
                                        <select class="form-select @error('qualification') is-invalid @enderror"
                                                name="qualification" id="qualification">
                                            <option value="">---छान्नुहोस् ---</option>
                                            @foreach (\Modules\BusinessRegistration\Enums\Qualification::cases() as $qualification)
                                                <option value="{{ $qualification->value }}"
                                                    {{ old('qualification', $disabilityIdentityCard->qualification?->value) == $qualification->value ? 'selected' : '' }}>
                                                    {{ $qualification->label() }}</option>
                                            @endforeach
                                        </select>
                                        @error('qualification')
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
                                        <select class="form-select @error('daily_activity') is-invalid @enderror"
                                                name="daily_activity" id="daily_activity">
                                            <option value="">---छान्नुहोस् ---</option>

                                            <option value="1"
                                                {{ old('daily_activity', $disabilityIdentityCard->daily_activity) == 1 ? 'selected' : '' }}>
                                                सक्ने
                                            </option>
                                            <option value="0"
                                                {{ old('daily_activity', $disabilityIdentityCard->daily_activity) == 0 ? 'selected' : '' }}>
                                                नसक्ने
                                            </option>
                                        </select>
                                        @error('daily_activity')
                                        <div class="invalid-feedback ">{{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="supporting_material" class="form-label"> साहायक सामाग्री
                                            प्रयोग
                                            गर्ने </label>
                                        <select class="form-select @error('supporting_material') is-invalid @enderror"
                                                name="supporting_material" id="supporting_material">
                                            <option value="">---छान्नुहोस् ---</option>

                                            <option value="1"
                                                {{ old('supporting_material', $disabilityIdentityCard->supporting_material) == 1 ? 'selected' : '' }}>
                                                गरेको
                                            </option>
                                            <option value="0"
                                                {{ old('supporting_material', $disabilityIdentityCard->supporting_material) == 0 ? 'selected' : '' }}>
                                                नगरेको
                                            </option>
                                        </select>
                                        @error('supporting_material')
                                        <div class="invalid-feedback ">{{ $message }} </div>
                                        @enderror
                                    </div>

                                </div>
                            </fieldset>

                            <fieldset class="mt-3">
                                <legend>अन्य व्यक्तिको सहयोग लिनु पर्ने भए त्यस्तो सहयोग लिनु पर्ने काम</legend>
                                @livewire('identity::task-livewire', [
                                    'tasks' => old('helping_task', $disabilityIdentityCard->helping_task) ?? [],
                                ])
                            </fieldset>
                            <fieldset class="mt-3">
                                <legend>अन्य व्यक्तिको सहयोग बिना गर्न सक्ने दैनिक कार्य</legend>
                                @livewire('identity::without-helping-task-livewire', [
                                    'tasks' => old('without_helping_task', $disabilityIdentityCard->without_helping_task) ?? [],
                                ])
                            </fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset class="mt-3">
                                        <legend>कुनै तालिम प्राप्त गरेको भए मुख्य तालिमको</legend>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="main_training_name" class="form-label"> नाम</label>
                                                <input name="main_training_name"
                                                       class="form-control  @error('main_training_name') is-invalid @enderror"
                                                       type="text" id="main_training_name" placeholder="नाम"
                                                       value="{{ old('main_training_name', $disabilityIdentityCard->main_training_name) }}"/>
                                                @error('main_training_name')
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
                                                <select class="form-select @error('occupation_id') is-invalid @enderror"
                                                        name="occupation_id" id="occupation_id">
                                                    <option value="">---छान्नुहोस् ---</option>
                                                    @foreach ($occupations as $occupation)
                                                        <option value="{{ $occupation->id }}"
                                                            {{ old('occupation_id', $disabilityIdentityCard->occupation_id) == $occupation->id ? 'selected' : '' }}>
                                                            {{ $occupation->title }}</option>
                                                    @endforeach

                                                </select>
                                                @error('occupation_id')
                                                <div class="invalid-feedback ">{{ $message }} </div>
                                                @enderror
                                            </div>

                                        </div>
                                    </fieldset>
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
    @push('style')
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
    @endpush
@endsection
