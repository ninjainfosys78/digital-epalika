@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.listRegistrations.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">मौजुदा सुची सम्पादन थप्नुहोस</li>
                    </ol>
                </div>
                <h4 class="page-title">मौजुदा सुची दर्ता</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">सुची दर्ता सम्पादन गर्नुहोस्</h4>
                        <a href="{{route('admin.listRegistrations.listRegistration.index')}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> मौजुदा सुची दर्ता बिवरण
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.listRegistrations.listRegistration.update',$listRegistration)}}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>
                                    १. मौजुदा सूचीको लागि दर्ता दिने व्यक्ति, संस्था, आपूर्तिकर्ता,निर्माण ब्यबसायी,
                                    परामर्शदाता वा सेवा प्रदायकको बिबरण
                                </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="registration_no" class="form-label">दर्ता नम्बर * </label>
                                    <input
                                        type="text"
                                        name="registration_no"
                                        value="{{old('registration_no',$listRegistration->registration_no)}}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="registration_no"
                                        placeholder="दर्ता नम्बर"
                                        required
                                    />
                                    @error('registration_no')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="applicant_type" class="form-label">प्रकार *</label>
                                    <select name="applicant_type"
                                            class="form-select @error('applicant_type') is-invalid @enderror"
                                            id="applicant_type" required>
                                        <option value="">छान्नुहोस्</option>
                                        @foreach(\Modules\ListRegistration\Enums\ApplicantCategoryEnum::cases() as $applicantType)
                                            <option
                                                value="{{$applicantType->value}}" {{$applicantType->value == old('applicant_type', $listRegistration->getRawOriginal('applicant_type')) ? 'selected' : ''}}>
                                                {{$applicantType->label()}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('applicant_type')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="name" class="form-label">नाम </label>
                                    <input
                                        type="text"
                                        name="name"
                                        value="{{old('name',$listRegistration->name)}}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        placeholder="नाम"
                                    />
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="address" class="form-label">ठेगाना *</label>
                                    <input
                                        type="text"
                                        name="address"
                                        value="{{old('address',$listRegistration->address)}}"
                                        class="form-control @error('address') is-invalid @enderror"
                                        id="address"
                                        placeholder="ठेगाना "
                                        required
                                    />
                                    @error('address')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="mailing_address" class="form-label">पत्राचार गर्ने ठेगाना *</label>
                                    <input
                                        type="text"
                                        name="mailing_address"
                                        value="{{old('mailing_address',$listRegistration->mailing_address)}}"
                                        class="form-control @error('mailing_address') is-invalid @enderror"
                                        id="mailing_address"
                                        placeholder="पत्राचार गर्ने ठेगाना "
                                        required
                                    />
                                    @error('mailing_address')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="main_person" class="form-label">मुख्य व्यक्तिको नाम *</label>
                                    <input
                                        type="text"
                                        name="main_person"
                                        value="{{old('main_person',$listRegistration->main_person)}}"
                                        class="form-control @error('main_person') is-invalid @enderror"
                                        id="main_person"
                                        placeholder="मुख्य व्यक्तिको  नाम"
                                        required
                                    />
                                    @error('main_person')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="telephone" class="form-label">टेलिफोन नम्बर</label>
                                    <input
                                        type="text"
                                        name="telephone"
                                        value="{{old('telephone',$listRegistration->telephone)}}"
                                        class="form-control @error('telephone') is-invalid @enderror"
                                        id="telephone"
                                        placeholder="टेलिफोन नम्बर"
                                    />
                                    @error('telephone')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="mobile_no" class="form-label">मोबाइल नम्बर *</label>
                                    <input
                                        type="text"
                                        name="mobile_no"
                                        value="{{old('mobile_no',$listRegistration->mobile_no)}}"
                                        class="form-control @error('mobile_no') is-invalid @enderror"
                                        id="mobile_no"
                                        placeholder="मोबाइल नम्बर"
                                        required
                                    />
                                    @error('mobile_no')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>
                                    २. तपशिल कागजात अपलोड गर्नुहोस
                                </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="application_photo" class="form-label">निबेदन/अनुसूची २ (क)</label>
                                    <input type="file"
                                           name="application_photo"
                                           class="form-control @error('application_photo') is-invalid @enderror"
                                           id="application_photo">
                                    @error('application_photo')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="registration_certificate" class="form-label">संस्था वा फार्म दर्ताको
                                        प्रमाण पत्र</label>
                                    <input type="file"
                                           name="registration_certificate"
                                           class="form-control @error('registration_certificate') is-invalid @enderror"
                                           id="registration_certificate">
                                    @error('registration_certificate')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="pan_photo" class="form-label">स्थायी लेखा नम्बर (PAN)</label>
                                    <input type="file"
                                           name="pan_photo"
                                           class="form-control @error('pan_photo') is-invalid @enderror"
                                           id="pan_photo">
                                    @error('pan_photo')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="tax_payment_certificate" class="form-label">कर चुक्ता प्रमाण
                                        पत्र</label>
                                    <input type="file"
                                           name="tax_payment_certificate"
                                           class="form-control @error('tax_payment_certificate') is-invalid @enderror"
                                           id="tax_payment_certificate">
                                    @error('tax_payment_certificate')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-2">
                                    <label for="license_photo" class="form-label">कुन खरिद को लागि सूची दर्ता हुन निबेदन
                                        दिने हो, सो को लागि इजाजत पत्र </label>
                                    <input type="file"
                                           name="license_photo"
                                           class="form-control @error('license_photo') is-invalid @enderror"
                                           id="tax_payment_certificate">
                                    @error('license_photo')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <label for="license_photo">अन्य फाइलहरु </label>
                                    @livewire('multiple-file')
                                </div>
                            </div> --}}
                            <div class="col-md-12 mb-2">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <label for="file" class="form-label fw-bold">अन्य फाइलहरु <span
                                            class="text-danger">*</span></label>
                                    <button
                                        type="button"
                                        class="btn btn-xs btn-outline-info"
                                        data-target-element="file"
                                        data-toggle="add-more">
                                        <i class="fas fa-plus-circle"></i> नयाँ थप्नुहोस्
                                    </button>
                                </div>
                                <fieldset class="bg-soft-secondary">
                                    <div id="file">
                                        <div class="main">
                                            <div class="text-end">
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                        data-toggle="remove-parent" data-parent=".main"
                                                        data-target-element="file">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                            <div class="row border-bottom mb-2">
                                                <div class="col-md-6 mb-2">
                                                    <label for="title" class="form-label">शिर्षक *</label>
                                                    <input
                                                        type="text"
                                                        name="files[][file_name]"
                                                        class="form-control"
                                                        id="title"
                                                        placeholder="शिर्षक"
                                                        required
                                                    />
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="documents" class="form-label">डकुमेन्ट </label>
                                                    <input
                                                        type="file"
                                                        name="files[][file]"
                                                        class="form-control"
                                                        id="documents"
                                                        multiple/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </fieldset>

                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>
                                    ३. सार्बजनिक निकायबाट हुने खरिदको लागि दर्ता हुन चाहने खरिदको प्रकृति बिबरण
                                </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="business_nature" class="form-label">खरिद प्रकृति *</label>
                                    <select
                                        name="business_nature"
                                        class="form-select @error('business_nature') is-invalid @enderror"
                                        id="business_nature" required>
                                        <option value="">छान्नुहोस्</option>
                                        @foreach(\Modules\ListRegistration\Enums\BusinessNatureEnum::cases() as $business_nature)
                                            <option
                                                value="{{$business_nature->value}}" {{$business_nature->value==old('business_nature',$listRegistration->getRawOriginal('business_nature')) ? 'selected' : ''}}>
                                                {{$business_nature->label()}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('business_nature')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="business_nature_description" class="form-label">बिबरण *</label>
                                    <textarea name="business_nature_description"
                                              id="business_nature_description"
                                              placeholder="बिबरण"
                                              required
                                              class="form-control summernote @error('business_nature_description') is-invalid @enderror"
                                              cols="30"
                                              rows="3">{{old('business_nature_description',$listRegistration->business_nature_description)}}</textarea>
                                    @error('business_nature_description')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong>
                                    ४. निबेदन मिति
                                </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <x-date-input-component
                                        nameNe="date" labelNe="मिति *"
                                        nameEn="en_date" labelEn="Date"
                                        :getTodayDate="false"
                                        :editDateNe="$listRegistration->date"
                                        :editDateEn="$listRegistration->en_date"
                                    />
                                </div>
                            </div>
                        </fieldset>

                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
