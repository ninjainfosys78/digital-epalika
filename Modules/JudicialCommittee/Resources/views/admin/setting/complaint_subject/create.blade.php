@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.judicialCommittee.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">उजुरी विषय</li>
                    </ol>
                </div>
                <h4 class="page-title">उजुरी विषय</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">उजुरी विषय थप्नुहोस </h4>
                        <a href="{{ route('admin.judicialCommittee.setting.complaintSubject.index') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> उजुरी विषय सूची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.judicialCommittee.setting.complaintSubject.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="lawsuit_nature_id" class="form-label">मुद्दा प्रकृति *</label>
                                <select name="lawsuit_nature_id" class="form-select" id="lawsuit_nature_id">
                                    <option value="">-- छान्नुहोस् --</option>
                                    @foreach ($lawsuitNatures as $lawsuitNature)
                                        <option {{ $lawsuitNature->id == old('lawsuit_nature_id') ? 'selected' : '' }}
                                            value="{{ $lawsuitNature->id }}">
                                            {{ $lawsuitNature->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('lawsuit_nature_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="subject" class="form-label">विषय *</label>
                                <input type="text" name="subject" value="{{ old('subject') }}"
                                    class="form-control  @error('subject') is-invalid @enderror" id="subject"
                                    placeholder="विषय" />
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fa fa-check"> पेश गर्नुहोस</i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
