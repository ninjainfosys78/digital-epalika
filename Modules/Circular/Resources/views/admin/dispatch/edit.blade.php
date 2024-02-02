@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.circular.dispatch.index')}}">चलानी पत्र </a>
                        </li>
                        <li class="breadcrumb-item active">चलानी पत्र सम्पादन गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">चलानी पत्र</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">चलानी पत्र थप्नुहोस्</h4>
                        <a href="{{route('admin.circular.dispatch.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> चलानी पत्र सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.circular.dispatch.update',$dispatch)}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong> विवरण </strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="dispatch_no" class="form-label">चलानी न.*</label>
                                    <input
                                        type="text"
                                        name="dispatch_no"
                                        value="{{old('dispatch_no',$dispatch->dispatch_no)}}"
                                        class="form-control @error('dispatch_no') is-invalid @enderror"
                                        id="dispatch_no"
                                        placeholder="चलानी न."
                                        required
                                    />
                                    @error('dispatch_no')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <x-date-input-component
                                        nameNe="dispatch_date" labelNe="चलानी मिति *"
                                        nameEn="en_dispatch_date" labelEn="Dispatch Date"
                                        :getTodayDate="false"
                                        :editDateNe="$dispatch->dispatch_date"
                                        :editDateEn="$dispatch->en_dispatch_date"
                                    />
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="letter_number" class="form-label">पत्र संख्या *</label>
                                    <input
                                        type="text"
                                        name="letter_number"
                                        value="{{old('letter_number', $dispatch->letter_number)}}"
                                        class="form-control @error('letter_number') is-invalid @enderror"
                                        id="letter_number"
                                        placeholder="पत्र संख्या"
                                        required
                                    />
                                    @error('letter_number')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <x-date-input-component
                                        nameNe="letter_date" labelNe="पत्रको मिति *"
                                        nameEn="en_letter_date" labelEn="Letter Date"
                                        :get-today-date="false"
                                        :editDateNe="$dispatch->letter_date"
                                        :editDateEn="$dispatch->en_letter_date"
                                    />
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="receiver_name" class="form-label">पाउने कार्यालयको नाम </label>
                                    <input
                                        type="text"
                                        name="receiver_name"
                                        value="{{old('receiver_name', $dispatch->receiver_name)}}"
                                        class="form-control @error('receiver_name') is-invalid @enderror"
                                        id="receiver_name"
                                        placeholder="पाउने कार्यालयको नाम"
                                        required
                                    />
                                    @error('receiver_name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="receiver_address" class="form-label">पाउने कार्यालयको ठेगाना</label>
                                    <input
                                        type="text"
                                        name="receiver_address"
                                        value="{{old('receiver_address',$dispatch->receiver_address)}}"
                                        class="form-control @error('receiver_address') is-invalid @enderror"
                                        id="receiver_address"
                                        placeholder="पाउने कार्यालयको ठेगाना"
                                        required
                                    />
                                    @error('receiver_address')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="subject" class="form-label">बिषय </label>
                                    <input
                                        type="text"
                                        name="subject"
                                        value="{{old('subject',$dispatch->subject)}}"
                                        class="form-control @error('subject') is-invalid @enderror"
                                        id="subject"
                                        placeholder="बिषय"
                                        required
                                    />
                                    @error('subject')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="receiver_contact" class="form-label">हुलाक/ र.न./इमेल </label>
                                    <input
                                        type="email"
                                        name="receiver_contact"
                                        value="{{old('receiver_contact',$dispatch->receiver_contact)}}"
                                        class="form-control @error('receiver_contact') is-invalid @enderror"
                                        id="receiver_contact"
                                        placeholder="हुलाक/ र.न. "
                                        required
                                    />
                                    @error('receiver_contact')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>


                                <div class="col-md-12 mb-2">
                                    <label for="remarks" class="form-label">कैफ़ियत</label>
                                    <textarea name="remarks"
                                              id="remarks" cols="30" rows="5"
                                              class="form-control ckEditor @error('remarks') is-invalid @enderror"
                                              placeholder="कैफ़ियत">{{old('remarks',$dispatch->remarks??'[@letterHead]')}}</textarea>
                                    @error('remarks')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('assets/backend/ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('assets/backend/ckeditor/editor.js')}}"></script>
    @endpush
@endsection
