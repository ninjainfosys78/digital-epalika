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
                        <li class="breadcrumb-item active">नगद अनुदान जारि</li>
                    </ol>
                </div>
                <h4 class="page-title">नगद अनुदान जारि गर्नुहोस्</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ नगद अनुदान थप्नुहोस्</h4>
                        <a href="{{ route('admin.grant.cashGrant.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> नगद अनुदानको सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.grant.cashGrant.update',$cashGrant) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <fieldset>
                            <legend>
                                <h4 class="text-info">नगद अनुदानको विवरण</h4>
                            </legend>
                            <h6 class="py-2">नोट: कृपया नगद अनुदानको विवरण भर्दा ध्यान दिएर भर्नु होला ।</h6>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="grant_for" class="form-label">
                                        नाम <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" value="{{ old('name',$cashGrant->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" id="name" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="grant_for" class="form-label">
                                        ठेगान(वडा) <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="address" value="{{ old('address',$cashGrant->address) }}"
                                        class="form-control @error('address') is-invalid @enderror" id="address" />
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="grant_for" class="form-label">
                                        उमेर <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="age" value="{{ old('age',$cashGrant->age) }}"
                                        class="form-control @error('age') is-invalid @enderror" id="age" />
                                    @error('age')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="grant_for" class="form-label">
                                        सम्पर्क नं<span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="contact" value="{{ old('contact',$cashGrant->contact) }}"
                                        class="form-control @error('contact') is-invalid @enderror" id="contact" />
                                    @error('contact')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="grant_for" class="form-label">
                                        नागरिकत नं <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="citizenship_no" value="{{ old('citizenship_no',$cashGrant->citizenship_no) }}"
                                        class="form-control @error('citizenship_no') is-invalid @enderror" id="citizenship_no" />
                                    @error('citizenship_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="grant_for" class="form-label">
                                        बुवाको नाम <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="father_name" value="{{ old('father_name',$cashGrant->father_name) }}"
                                        class="form-control @error('father_name') is-invalid @enderror" id="father_name" />
                                    @error('father_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="grant_for" class="form-label">
                                        बाजे नाम <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="grandfather_name" value="{{ old('grandfather_name',$cashGrant->grandfather_name) }}"
                                        class="form-control @error('grandfather_name') is-invalid @enderror" id="grandfather_name" />
                                    @error('grandfather_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="helplessness_type_id" class="form-label">
                                        असहायताको प्रकार <span class="text-danger">*</span>
                                    </label>
                                    <select name="helplessness_type_id" id="helplessness_type_id" class="form-select" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach ($helplessnesstypes as $helplessnesstype)
                                            <option value="{{ $helplessnesstype->id }}"
                                                {{ $helplessnesstype->id == old('helplessness_type_id,',$cashGrant->helplessness_type_id) ? 'selected' : '' }}>
                                                {{ $helplessnesstype->helplessness_type }}
                            
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('helplessness_types_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="grant_for" class="form-label">
                                        नगद <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="cash" value="{{ old('cash',$cashGrant->cash) }}"
                                        class="form-control @error('cash') is-invalid @enderror" id="cash" />
                                    @error('cash')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="file" class="form-label">कागजपत्र<span class="text-danger">*</span></label>
                                    <input type="file" name="file" value="{{ old('file',$cashGrant->file) }}"
                                        class="form-control @error('file') is-invalid @enderror" id="file" />
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <label for="remark" class="form-label">कैफियत</label>
                                <textarea name="text" id="remark" class="form-control" rows="4"> value="{{ old('remark',$cashGrant->remark) }}" </textarea>
                                @error('remark')
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
    @include('grant::admin.inc.grantOffice_form')
    @include('grant::admin.inc.grantProgram_form')
    @include('grant::admin.inc.grantType_form')
@endsection
