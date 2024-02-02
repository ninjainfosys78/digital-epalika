@extends('frontend.layouts.master')
@section('content')
    <section class="inner-section">
        <div class="breadcrumb d-flex pt-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-item">
                            <a class="whitespace-nowrap text-primary-500" href="{{ url('e-map') }}">सेवाग्राही</a>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                                <path fill-rule="evenodd"
                                    d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                            <a class="ml-1 text-primary-500" href="">सेवाग्राहीको विवरण फारम</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row d-flex mt-5 ">
                <h4 class="fw-semibold text-left">सेवाग्राहीको विवरण फारम</h4>
                <div class="row justify-content-center">
                    <div class="p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card p-0">

                                    <div class="card-body px-2">
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                        <form action="{{ route('mobileUser.mobileUserDetail.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <fieldset>
                                                <legend>
                                                    <h4 class="text-info">व्यक्तिगत विवरण</h4>
                                                </legend>
                                                <div class="col-md-4 mb-2">
                                                    <input type="hidden" name="mobile_user_id"
                                                        value="{{ Auth::guard('mobile-user')->user()->id }}"
                                                        class="form-control @error('mobile_user_id') is-invalid @enderror"
                                                        id="mobile_user_id" />


                                                </div>
                                                <div class="row">


                                                    <div class="col-md-4 mb-2">
                                                        <label for="citizenship_no" class="form-label">नागरिकता नं.
                                                            *</label>
                                                        <input type="text" name="citizenship_no"
                                                            value="{{ old('citizenship_no') }}"
                                                            class="form-control @error('citizenship_no') is-invalid @enderror"
                                                            id="citizenship_no" placeholder="नागरिकता नं." required />
                                                        @error('citizenship_no')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <label for="nec_no" class="form-label">राष्ट्रिय परिचय पत्र नं.
                                                            *</label>
                                                        <input type="text" name="nec_no" value="{{ old('nec_no') }}"
                                                            class="form-control @error('nec_no') is-invalid @enderror"
                                                            id="nec_no" placeholder="राष्ट्रिय परिचय पत्र नं."
                                                            required />
                                                        @error('nec_no')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <label for="citizenship_issued_date" class="form-label"> जारि
                                                            मिति *</label>
                                                        <div class="input-group">
                                                            <input name="citizenship_issued_date"
                                                                class="form-control @error('citizenship_issued_date') is-invalid @enderror"
                                                                type="date" id="citizenship_issued_date"
                                                                placeholder="जारि मिति">
                                                            @error('citizenship_issued_date')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <label for="citizenship_issued_district" class="form-label">
                                                            जारी
                                                            जिल्ला *

                                                        <div class="input-group">
                                                            <select name="citizenship_issued_district"
                                                                class="form-select @error('citizenship_issued_district') is-invalid @enderror"
                                                                id="citizenship_issued_district">
                                                                <option>---जिल्ला छान्नुहोस् ----</option>
                                                                @foreach (get_districts() as $district)
                                                                    <option value="{{ $district->id }}">
                                                                        {{ $district->district }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('citizenship_issued_district')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <label for="citizenship_front" class="form-label">नागरिकताको फोटो (अगाडी) *</label>
                                                        <input type="file" name="citizenship_front" value="{{ old('citizenship_front') }}"
                                                            class="form-control @error('citizenship_front') is-invalid @enderror"
                                                            id="citizenship_front" required />
                                                        @error('citizenship_front')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <label for="citizenship_back" class="form-label">नागरिकताको फोटो (पछाडी)*</label>
                                                        <input type="file" name="citizenship_back" value="{{ old('citizenship_back') }}"
                                                            class="form-control @error('citizenship_back') is-invalid @enderror"
                                                            id="citizenship_back" required />
                                                        @error('citizenship_back')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="my-2">
                                                <legend>
                                                    <h4 class="text-info">स्थायी ठेगाना *</h4>
                                                </legend>
                                                <h6 class="py-2">नोट: कृपया क्रमशः प्रदेश, जिल्ला, गा.पा./न.पा., वार्ड
                                                    नं., गाउँ र टोल छनौट
                                                    गर्नुहोस् । </h6>
                                                @livewire('address', [
                                                    'province_id' => old('province_id'),
                                                    'district_id' => old('district_id'),
                                                    'local_body_id' => old('local_body_id'),
                                                    'ward_no' => old('ward_no'),
                                                ])
                                                <div class="col-md-6 mb-2">
                                                    <label for="tole" class="form-label">
                                                        टोल</label>
                                                    <input type="text" name="tole"
                                                        value="{{ old('tole') }}"
                                                        class="form-control @error('tole') is-invalid @enderror"
                                                        id="tole" placeholder="टोल" required />
                                                    @error('tole')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </fieldset>
                                            <fieldset class="my-2">
                                                <legend>
                                                    <h4 class="text-info">अस्थायी ठेगाना *</h4>
                                                </legend>
                                                <h6 class="py-2">नोट: कृपया क्रमशः प्रदेश, जिल्ला, गा.पा./न.पा., वार्ड
                                                    नं., गाउँ र टोल छनौट
                                                    गर्नुहोस् । </h6>
                                                @livewire('mobile-user-address', [
                                                    'temporary_province_id' => old('temporary_province_id'),
                                                    'temporary_district_id' => old('temporary_district_id'),
                                                    'temporary_local_body_id' => old('temporary_local_body_id'),
                                                    'temporary_ward' => old('temporary_ward'),
                                                ])
                                                <div class="col-md-6 mb-2">
                                                    <label for="temporary_tole" class="form-label">
                                                        टोल</label>
                                                    <input type="text" name="temporary_tole"
                                                        value="{{ old('temporary_tole') }}"
                                                        class="form-control @error('temporary_tole') is-invalid @enderror"
                                                        id="temporary_tole" placeholder="टोल" required />
                                                    @error('temporary_tole')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-primary mt-2">
                                                पेश गर्नुहोस्
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
