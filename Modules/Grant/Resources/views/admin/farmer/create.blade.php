@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.grant.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">कृषक/व्यक्ति थप</li>
                    </ol>
                </div>
                <h4 class="page-title"> कृषक/व्यक्तिहरु</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ कृषक/व्यक्ति थप्नुहोस्</h4>
                        <a href="{{ route('admin.grant.farmer.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> कृषक/व्यक्ति सुची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">

                    <form action="{{ route('admin.grant.farmer.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <fieldset>
                            <legend>
                                <h4 class="text-info">कृषक/व्यक्ति विवरण</h4>
                            </legend>
                            <h6 class="py-2">नोट: कृपया कृषक/व्यक्तिको विवरण भर्दा ध्यान दिएर भर्नु होला । </h6>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="first_name" class="form-label">पहिलो नाम *</label>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}"
                                        class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                                        placeholder="पहिलो नाम " required />
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="middle_name" class="form-label">बीचको नाम</label>
                                    <input type="text" name="middle_name" value="{{ old('middle_name') }}"
                                        class="form-control @error('middle_name') is-invalid @enderror" id="middle_name"
                                        placeholder="बीचको नाम" />
                                    @error('middle_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="last_name" class="form-label">थर *</label>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}"
                                        class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                        placeholder="थर" required />
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="photo" class="form-label">फोटो</label>
                                    <input type="file" name="photo" value="{{ old('photo') }}"
                                        class="form-control @error('photo') is-invalid @enderror" id="photo" />
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="phone_no" class="form-label">सम्पर्क नं. *</label>
                                    <input type="text" name="phone_no" value="{{ old('phone_no') }}"
                                        class="form-control @error('phone_no') is-invalid @enderror" id="phone_no"
                                        placeholder="सम्पर्क नं." required />
                                    @error('phone_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="gender" class="form-label">लिंग *</label>
                                    <select id="gender" name="gender" class="form-select" required>
                                        <option value="">-- छान्नुहोस् --</option>
                                        @foreach (\App\Enums\Gender::cases() as $gender)
                                            <option {{ $gender->value == old('gender') ? 'selected' : '' }}
                                                value="{{ $gender->value }}">{{ $gender->label() }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2" id="marital-status-div">
                                    <label for="marital_status" class="form-label">बैबाहिक अवस्था *</label>
                                    <select id="marital_status" name="marital_status" class="form-select" required>
                                        <option value="">-- छान्नुहोस् --</option>
                                        @foreach (\App\Enums\MaritalStatusEnum::cases() as $marital_status)
                                            <option value="{{ $marital_status->value }}"
                                                {{ $marital_status->value == old('marital_status') ? 'selected' : '' }}>
                                                {{ $marital_status->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('marital_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="father_name" class="form-label">बुवाको नाम थर *</label>
                                    <input type="text" name="father_name" value="{{ old('father_name') }}"
                                        class="form-control @error('father_name') is-invalid @enderror" id="father_name"
                                        placeholder="बुवाको नाम थर" required />
                                    @error('father_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="grandfather_name" class="form-label">बाजे/ससुराको नाम थर *</label>
                                    <input type="text" name="grandfather_name" value="{{ old('grandfather_name') }}"
                                        class="form-control @error('grandfather_name') is-invalid @enderror"
                                        id="grandfather_name" placeholder="बाजे/ससुराको नाम थर " required />
                                    @error('grandfather_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="citizenship_no" class="form-label">नागरिकता नं. *</label>
                                    <input type="text" name="citizenship_no" value="{{ old('citizenship_no') }}"
                                        class="form-control @error('citizenship_no') is-invalid @enderror"
                                        id="citizenship_no" placeholder="नागरिकता नं." required />
                                    @error('citizenship_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="farmer_id_card_no" class="form-label">कृषक परिचयपत्र नं (कृषक सूचीकरण
                                        नम्बर)</label>
                                    <input type="text" name="farmer_id_card_no"
                                        value="{{ old('farmer_id_card_no') }}"
                                        class="form-control @error('farmer_id_card_no') is-invalid @enderror"
                                        id="farmer_id_card_no" placeholder="कृषक परिचयपत्र नं." />
                                    @error('farmer_id_card_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="national_id_card_no" class="form-label">
                                        राष्ट्रिय परिचयपत्र नम्बर</label>
                                    <input type="text" name="national_id_card_no"
                                        value="{{ old('national_id_card_no') }}"
                                        class="form-control @error('national_id_card_no') is-invalid @enderror"
                                        id="national_id_card_no" placeholder="राष्ट्रिय परिचयपत्र नम्बर" />
                                    @error('national_id_card_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="my-2">
                            <legend>
                                <h4 class="text-info">स्थायी ठेगाना *</h4>
                            </legend>
                            <h6 class="py-2">नोट: कृपया क्रमशः प्रदेश, जिल्ला, गा.पा./न.पा., वार्ड नं., गाउँ र टोल छनौट
                                गर्नुहोस् । </h6>
                            @livewire('address', [
                                'province_id' => $officeSetting->province_id,
                                'district_id' => $officeSetting->district_id,
                                'local_body_id' => $officeSetting->local_body_id,
                            ])
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="village" class="form-label">
                                        गाउँ</label>
                                    <input type="text" name="village" value="{{ old('village') }}"
                                        class="form-control @error('village') is-invalid @enderror" id="village"
                                        placeholder="गाउँ" />
                                    @error('village')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="tole" class="form-label">
                                        टोल</label>
                                    <input type="text" name="tole" value="{{ old('tole') }}"
                                        class="form-control @error('tole') is-invalid @enderror" id="tole"
                                        placeholder="टोल" />
                                    @error('tole')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>
                                <h4 class="text-info">नाता ? *</h4>
                            </legend>
                            <h6 class="py-2"> नोट: घरमुलीको आफै भएको खण्डमा खाली खोद्नु होस्</h6>
                            <div class="row">
                                <div class="col-md-6  mb-2">
                                    <label for="farmer_id" class="form-label">
                                        घरमुलीको नाम</label>
                                    <div class="input-group">
                                        <select name="farmer_id" multiple data-toggle="select2" id="farmer_id"
                                            class="form-select" aria-describedby="button-cooperatives">
                                            <option disabled>--- छान्नुहोस् ---</option>
                                            @foreach ($countrymen as $countryman)
                                                <option value="{{ $countryman->id }}"
                                                    {{ old('farmer_id') == $countryman->id ? 'selected' : '' }}>
                                                    {{ $countryman->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('farmer_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="relationship_id" class="form-label">
                                        नाता</label>
                                    <div class="input-group">
                                        <select name="relationship_id" multiple data-toggle="select2"
                                            id="relationship_id" class="form-control" aria-describedby="button-group">
                                            <option disabled>--- छान्नुहोस् ---</option>
                                            @foreach ($relationships as $relationship)
                                                <option value="{{ $relationship->id }}"
                                                    {{ old('relationship_id') == $relationship->id ? 'selected' : '' }}>
                                                    {{ $relationship->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('relationship_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>
                                <h4 class="text-info">संलग्नता ? *</h4>
                            </legend>
                            <h6 class="py-2"> नोट: कुनै समूह, सहकारी वा उद्यममा संलग्न भएमा ।</h6>
                            <div class="row">
                                <div class="col-md-4  mb-2">
                                    <label for="cooperatives" class="form-label">
                                        सहकारी</label>
                                    <div class="input-group">
                                        <select name="cooperatives[]" multiple data-toggle="select2" id="cooperatives"
                                            class="form-select" aria-describedby="button-cooperatives">
                                            <option disabled>--- छान्नुहोस् ---</option>
                                            @foreach ($cooperatives as $cooperative)
                                                <option value="{{ $cooperative->id }}">{{ $cooperative->name }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-sm btn-outline-primary" type="button"
                                            id="button-cooperatives" title="सहकारी थप" data-bs-toggle="modal"
                                            data-bs-target="#cooperative-modal">
                                            <i class="fa fa-plus"></i></button>
                                    </div>
                                    @error('cooperatives')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="groups" class="form-label">
                                        समूह</label>
                                    <div class="input-group">
                                        <select name="groups[]" multiple data-toggle="select2" id="groups"
                                            class="form-control" aria-describedby="button-group">
                                            <option disabled>--- छान्नुहोस् ---</option>
                                            @foreach ($groups as $group)
                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-sm btn-outline-primary" type="button" id="button-group"
                                            title="समुह थप" data-bs-toggle="modal" data-bs-target="#group-modal">
                                            <i class="fa fa-plus"></i></button>
                                    </div>
                                    @error('group')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="enterprises" class="form-label">
                                        उद्यम</label>
                                    <div class="input-group">
                                        <select name="enterprises[]" multiple data-toggle="select2" id="enterprises"
                                            class="form-control" aria-describedby="button-enterprise">
                                            <option disabled>--- छान्नुहोस् ---</option>
                                            @foreach ($enterprises as $enterprise)
                                                <option value="{{ $enterprise->id }}">{{ $enterprise->name }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-sm btn-outline-primary" type="button"
                                            id="button-enterprise" title="उधम थप" data-bs-toggle="modal"
                                            data-bs-target="#enterprise-modal">
                                            <i class="fa fa-plus"></i></button>
                                    </div>
                                    @error('enterprises')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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
    {{-- cooperative add modal --}}
    @include('grant::admin.inc.cooperative_form')

    {{-- group add modal --}}
    @include('grant::admin.inc.group_form')

    {{-- enterprise add modal --}}
    @include('grant::admin.inc.enterprise_form')

    @push('scripts')
        <script>
            $(document).ready(function() {
                if ($('#marital_status').val() === 'married') {
                    setStatus($('#marital_status').val())
                }
                $('#marital_status').on('change', function() {
                    setStatus($(this).val())
                });

                function setStatus(status) {
                    if (status === 'married') {
                        $('#marital-status-div').after(spouseInput())
                    } else {
                        $('.spouse').remove()
                    }
                }

                function spouseInput() {
                    return "<div class='spouse col-md-4 mb-2'>" +
                        "<label for='spouse_name' class='form-label'>पति/पत्नी नाम</label>" +
                        "<input type='text' name='spouse_name' value='{{ old('spouse_name') }}' class='form-control' id='spouse_name' placeholder='पति/पत्नी नाम' />" +
                        "@error('spouse_name') <div class='invalid-feedback'>{{ $message }}</div> @enderror </div>"
                }

            });
        </script>
    @endpush
    @push('style')
    @endpush
@endsection
