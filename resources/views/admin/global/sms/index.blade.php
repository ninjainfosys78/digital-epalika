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
                            <a href="{{route('admin.global.dashboard')}}">सेटिङ</a>
                        </li>
                        <li class="breadcrumb-item active">एस.एम.एस सेटिंग सम्पादन गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">एस.एम.एस सेटिंग</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">समय एस.एम.एस सेटिंग</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.global.update-samaya-sms-config')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="SAMAYA_SMS_KEY" class="form-label">API Key *</label>
                                <input
                                    type="text"
                                    name="SAMAYA_SMS_KEY"
                                    value="{{old('SAMAYA_SMS_KEY', config('sms.samaya.api_key'))}}"
                                    class="form-control @error('SAMAYA_SMS_KEY') is-invalid @enderror"
                                    id="SAMAYA_SMS_KEY"
                                    placeholder="SAMAYA SMS Key"
                                />
                                @error('SAMAYA_SMS_KEY')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="SAMAYA_SMS_ID" class="form-label">Sender Id *</label>
                                <input
                                    type="text"
                                    name="SAMAYA_SMS_ID"
                                    value="{{old('SAMAYA_SMS_ID',config('sms.samaya.sms_id'))}}"
                                    class="form-control @error('SAMAYA_SMS_ID') is-invalid @enderror"
                                    id="SAMAYA_SMS_ID"
                                    placeholder="SAMAYA SMS ID"
                                />
                                @error('SAMAYA_SMS_ID')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">आकास एस.एम.एस सेटिंग</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.global.update-aakash-sms-config')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="AAKASH_SMS_KEY" class="form-label">API Key *</label>
                                <input
                                    type="text"
                                    name="AAKASH_SMS_KEY"
                                    value="{{old('AAKASH_SMS_KEY', config('sms.aakash.api_key'))}}"
                                    class="form-control @error('AAKASH_SMS_KEY') is-invalid @enderror"
                                    id="AAKASH_SMS_KEY"
                                    placeholder="AAKASH SMS KEY"
                                />
                                @error('AAKASH_SMS_KEY')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
