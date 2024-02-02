@extends('admin.layouts.master')
@section('content')
    <div class="row" xmlns:livewire="http://www.w3.org/1999/html">
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
                            <a href="{{route('admin.grant.cooperative.index')}}">सहकारी</a>
                        </li>
                        <li class="breadcrumb-item active">सहकारी थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">सहकारी थप्नुहोस्</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">सहकारी थप्नुहोस्</h4>
                        <a href="{{route('admin.grant.cooperative.index')}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> सहकारी सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.grant.cooperative.update',$cooperative)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <fieldset>
                                    <legend><h4 class="text-info"> सहकारीको विवरण </h4></legend>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label for="name" class="form-label">सहकारी नाम</label>
                                            <input
                                                type="text"
                                                name="name"
                                                value="{{old('name',$cooperative->name)}}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="name"
                                                placeholder="सहकारी नाम"
                                                required
                                            />
                                            @error('name')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="name" class="form-label">सहकारी प्रकार</label>
                                            <select name="cooperative_type_id" id="cooperative_type_id"
                                                    class="form-control @error('cooperative_type_id') is-invalid @enderror" required>
                                                <option value="">सहकारी प्रकार छान्नुहोस्</option>
                                                @foreach($cooperativeTypes as $cooperativeType)
                                                    <option
                                                        {{$cooperativeType->id==old('cooperative_type_id', $cooperative->cooperativeType->id) ? 'selected' : ''}}
                                                        value="{{$cooperativeType->id}}">{{$cooperativeType->title}}</option>
                                                @endforeach
                                            </select>
                                            @error('cooperative_type_id')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label for="registration_no" class="form-label">दर्ता नं</label>
                                            <input
                                                type="text"
                                                name="registration_no"
                                                value="{{old('registration_no', $cooperative->registration_no)}}"
                                                class="form-control @error('registration_no') is-invalid @enderror"
                                                id="registration_no"
                                                placeholder="दर्ता नं"
                                                required
                                            />
                                            @error('registration_no')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <x-date-input-component
                                                nameNe="c_registration_date" labelNe="दर्ता मिति *"
                                                nameEn="en_c_registration_date" labelEn="Registration Date"
                                                :getTodayDate="false"
                                                :editDateNe="$cooperative->registration_date"
                                            />
                                            @error('registration_date')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="vat_pan" class="form-label">प्यान भ्याट</label>
                                            <input
                                                type="text"
                                                name="vat_pan"
                                                value="{{old('vat_pan',$cooperative->vat_pan)}}"
                                                class="form-control @error('vat_pan') is-invalid @enderror"
                                                id="vat_pan"
                                                placeholder="प्यान भ्याट"
                                            />
                                        </div>

                                        <div class="col-md-6 mb-2">
                                            <label for="affiliation_id" class="form-label">आवध्ता </label>
                                            <select name="affiliation_id" id="affiliation_id"
                                                    class="form-select @error('affiliation_id') is-invalid @enderror">
                                                <option value="">आवध्ता छान्नुहोस्</option>
                                                @foreach($affiliations as $affiliation)
                                                    <option
                                                        {{$affiliation->id==old('affiliation_id',$cooperative->affiliation_id) ? 'selected' : ''}}
                                                        value="{{$affiliation->id}}">
                                                        {{$affiliation->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('affiliation_id')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label for="objective" class="form-label">उद्देश्य</label>
                                            <textarea name="objective" id="objective" class="form-control"
                                                      placeholder="उद्देश्य"
                                                      cols="45"
                                                      rows="3">{{old('objective',$cooperative->objective)}}</textarea>
                                            @error('objective')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <fieldset>
                                <legend><h4 class="text-info"> स्थायी ठेगाना </h4></legend>
                                <p>नोट: कृपया क्रमशः प्रदेश, जिल्ला, गा.पा./न.पा., वार्ड नं., गाउँ र टोल छनौट गर्नुहोस्
                                    ।</p>
                                @livewire('address', [
                                'province_id' => $cooperative->province_id,
                                'district_id' => $cooperative->district_id,
                                'local_body_id' => $cooperative->local_body_id,
                                'ward_no' => $cooperative->ward_no
                                ])
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="village" class="form-label">गाउँ</label>
                                        <input
                                            type="text"
                                            name="village"
                                            id="village"
                                            class="form-control @error('village') is-invalid @enderror"
                                            value="{{old('village', $cooperative->village)}}"
                                            placeholder="गाउँ"
                                        >
                                    </div>
                                    @error('village')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    <div class="col-md-6 mb-2">
                                        <label for="tole" class="form-label">टोल</label>
                                        <input
                                            type="text"
                                            name="tole"
                                            id="tole"
                                            class="form-control @error('tole') is-invalid @enderror"
                                            value="{{old('tole', $cooperative->tole)}}"
                                            placeholder="टोल"
                                        >
                                    </div>
                                    @error('tole')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </fieldset>
                        </div>
                        <div class="row my-2">
                            <fieldset>
                                <legend>
                                    <h4 class="text-info">संलग्न कृषकहरू</h4>
                                </legend>
                                <p>सहकारीमा संलग्न कृषकहरू छान्नुहोस् </p>
                                <div class="col-md-6 mb-2">
                                    <label for="farmers" class="form-label">
                                        कृषक</label>

                                    <div class="input-group">
                                        <select name="farmers[]" multiple data-toggle="select2"
                                                id="farmers" class="form-select">
                                            <option disabled>--- छान्नुहोस् ---</option>
                                            @foreach($farmers as $farmer)
                                                <option
                                                    {{ in_array($farmer->id, $cooperative->farmers->pluck('id')->toArray()) ? 'selected' : '' }}
                                                    value="{{$farmer->id}}">{{$farmer->name}} ({{$farmer->unique_id}})</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-sm btn-outline-primary" type="button"
                                                id="button-farmer"
                                                title="कृषक थप" data-bs-toggle="modal" data-bs-target="#farmer-modal">
                                            <i class="fa fa-plus"></i></button>
                                    </div>
                                    @error('farmers')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </fieldset>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            पेश गर्नुहोस्
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('grant::admin.inc.farmer_form')
@endsection
