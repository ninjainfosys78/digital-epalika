@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.circular.dashboard')}}">
                            <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}"
                                alt="document-icon">
                            गृहपृष्ठ
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.circular.registration.index')}}">दर्ता पत्र सूची</a>
                    </li>
                    <li class="breadcrumb-item active">नयाँ दर्ता पत्र थप्नुहोस्</li>
                </ol>
            </div>
            <h4 class="page-title">दर्ता पत्र</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card p-0">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="header-title">नयाँ दर्ता पत्र थप्नुहोस्</h4>
                    <a href="{{route('admin.circular.registration.index')}}" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-list"></i> दर्ता पत्र सूची
                    </a>
                </div>
            </div>
            <div class="card-body px-0">
                <form action="{{route('admin.circular.registration.store')}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <fieldset class="border p-2 mb-2">
                        <legend class="font-16 text-primary">
                            <strong> विवरण </strong>
                        </legend>
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label for="registration_no" class="form-label">दर्ता न. *</label>
                                <input type="text" name="registration_no"
                                    value="{{old('registration_no',$registration_no)}}"
                                    class="form-control @error('registration_no') is-invalid @enderror"
                                    id="registration_no" placeholder="दर्ता न." required />
                                @error('registration_no')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <x-date-input-component nameNe="registration_date" labelNe="दर्ता मिति *"
                                    nameEn="en_registration_date" labelEn="Registration Date" />
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="letter_number" class="form-label">पत्र संख्या</label>
                                <input type="string" name="letter_number" value="{{old('letter_number')}}"
                                    class="form-control @error('letter_number') is-invalid @enderror" id="letter_number"
                                    placeholder="पत्र संख्या" />
                                @error('letter_number')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <x-date-input-component nameNe="letter_date" labelNe="पत्रको मिति *"
                                    nameEn="en_letter_date" labelEn="Letter Date" :getTodayDate="false" />
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="sender_name" class="form-label">पठाउने कार्यालयको नाम *</label>
                                <input type="text" name="sender_name" value="{{old('sender_name')}}"
                                    class="form-control @error('sender_name') is-invalid @enderror" id="sender_name"
                                    placeholder="पठाउने कार्यालयको नाम" required />
                                @error('sender_name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="email" class="form-label">ईमेल </label>
                                <input type="email" name="email" value="{{old('email')}}"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="ईमेल" />
                                @error('email')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="subject" class="form-label">बिषय *</label>
                                <input type="text" name="subject" value="{{old('subject')}}"
                                    class="form-control @error('subject') is-invalid @enderror" id="subject"
                                    placeholder="बिषय" required />
                                @error('subject')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="remarks" class="form-label">कैफ़ियत </label>
                                <textarea name="remarks" id="remarks" cols="30" rows="5"
                                    class="form-control summernote @error('remarks') is-invalid @enderror"
                                    placeholder="कैफ़ियत">{{old('remarks')}}</textarea>
                                @error('remarks')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="border p-2 mb-2">
                        <legend class="font-16 text-primary">
                            <strong> बुझिलिनेको बिवरण</strong>
                        </legend>
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label for="receiver_name" class="form-label">नाम * </label>
                                <input type="text" name="receiver_name" value="{{old('receiver_name')}}"
                                    class="form-control @error('receiver_name') is-invalid @enderror" id="receiver_name"
                                    placeholder="नाम" required />
                                @error('receiver_name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="phone" class="form-label">सम्पर्क नम्बर </label>
                                <input type="text" name="phone" value="{{old('phone')}}"
                                    class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    placeholder="सम्पर्क नम्बर" />
                                @error('phone')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-2">
                                <label for="signature_image" class="form-label">सहि </label>
                                <input type="file" name="signature_image"
                                    class="form-control @error('signature_image') is-invalid @enderror"
                                    id="signature_image" />
                                @error('signature_image')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <x-date-input-component nameNe="date" labelNe="मिति" nameEn="en_date" labelEn=" Date"
                                    :get-today-date="false" />
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="border p-2 mb-2">
                        <legend class="font-16 text-primary">
                            <strong>डकुमेन्ट राख्नुहोस्</strong>
                        </legend>
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label for="documents" class="form-label">डकुमेन्ट * </label>
                                <input type="file" name="documents[]"
                                    class="form-control @error('documents') is-invalid @enderror" id="documents"
                                    required multiple />
                                @error('documents')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                                @error('documents.*')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="branch_id" class="form-label"> Forward To </label>
                                <select class="form-control" name="branch_id">
                                    <option>--Select--</option>
                                    @foreach($branches as $branch)
                                    <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                                @error('documents')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
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
