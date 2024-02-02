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
                        <li class="breadcrumb-item active">मेल सेटिंग सम्पादन गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">मेल सेटिंग</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">मेल सेटिंग</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.global.update-mail-setting')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="MAIL_MAILER" class="form-label">Mail Mailer *</label>
                                <select name="MAIL_MAILER"
                                        class="form-select @error('MAIL_MAILER') is-invalid @enderror" id="MAIL_MAILER">
                                    <option
                                        value="smtp" {{old('MAIL_MAILER', env('MAIL_MAILER')) == 'smtp' ? 'selected' :''}}>
                                        SMTP
                                    </option>
                                    <option
                                        value="sendmail" {{old('MAIL_MAILER', env('MAIL_MAILER')) == 'sendmail' ? 'selected' :''}}>
                                        Send Mail
                                    </option>
                                </select>
                                @error('MAIL_MAILER')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="MAIL_HOST" class="form-label">Mail Host *</label>
                                <input
                                    type="text"
                                    name="MAIL_HOST"
                                    value="{{old('MAIL_HOST',env('MAIL_HOST'))}}"
                                    class="form-control @error('MAIL_HOST') is-invalid @enderror"
                                    id="MAIL_HOST"
                                    placeholder="Mail Host"
                                />
                                @error('MAIL_HOST')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="MAIL_PORT" class="form-label">Mail Port *</label>
                                <input
                                    type="text"
                                    name="MAIL_PORT"
                                    value="{{old('MAIL_PORT', env('MAIL_PORT'))}}"
                                    class="form-control @error('MAIL_PORT') is-invalid @enderror"
                                    id="MAIL_PORT"
                                    placeholder="Mail Port"
                                />
                                @error('MAIL_PORT')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="MAIL_USERNAME" class="form-label">Mail Username *</label>
                                <input
                                    type="text"
                                    name="MAIL_USERNAME"
                                    value="{{old('MAIL_USERNAME',env('MAIL_USERNAME'))}}"
                                    class="form-control @error('MAIL_USERNAME') is-invalid @enderror"
                                    id="MAIL_USERNAME"
                                    placeholder="Mail Username"
                                />
                                @error('MAIL_USERNAME')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="MAIL_PASSWORD" class="form-label">Mail Password *</label>
                                <input
                                    type="text"
                                    name="MAIL_PASSWORD"
                                    value="{{old('MAIL_PASSWORD', env('MAIL_PASSWORD'))}}"
                                    class="form-control @error('MAIL_PASSWORD') is-invalid @enderror"
                                    id="MAIL_PASSWORD"
                                    placeholder="Mail Password"
                                />
                                @error('MAIL_PASSWORD')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="MAIL_ENCRYPTION" class="form-label">Mail Encryption *</label>
                                <select name="MAIL_ENCRYPTION"
                                        class="form-select @error('MAIL_ENCRYPTION') is-invalid @enderror"
                                        id="MAIL_ENCRYPTION">
                                    <option
                                        value="ssl" {{old('MAIL_ENCRYPTION', env('MAIL_ENCRYPTION')) == 'ssl' ? 'selected' :''}}>
                                        SSL
                                    </option>
                                    <option
                                        value="tls" {{old('MAIL_ENCRYPTION', env('MAIL_ENCRYPTION')) == 'tls' ? 'selected' :''}}>
                                        TLS
                                    </option>
                                </select>
                                @error('MAIL_ENCRYPTION')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="MAIL_FROM_ADDRESS" class="form-label">Mail From Address *</label>
                                <input
                                    type="text"
                                    name="MAIL_FROM_ADDRESS"
                                    value="{{old('MAIL_FROM_ADDRESS', env('MAIL_FROM_ADDRESS'))}}"
                                    class="form-control @error('MAIL_FROM_ADDRESS') is-invalid @enderror"
                                    id="MAIL_FROM_ADDRESS"
                                    placeholder="Mail From Address"
                                />
                                @error('MAIL_FROM_ADDRESS')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="MAIL_FROM_NAME" class="form-label">Mail From Name *</label>
                                <input
                                    type="text"
                                    name="MAIL_FROM_NAME"
                                    value="{{old('MAIL_FROM_NAME',env('MAIL_FROM_NAME'))}}"
                                    class="form-control @error('MAIL_FROM_NAME') is-invalid @enderror"
                                    id="MAIL_FROM_NAME"
                                    placeholder="Mail From Name"
                                />
                                @error('MAIL_FROM_NAME')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary mt-4">
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
                        <h4 class="header-title">मेल टेस्ट गर्नुहोस्</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.global.send-test-mail')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="email" class="form-label">Email *</label>
                                <input
                                    type="text"
                                    name="email"
                                    value="{{old('email')}}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    placeholder="Test Mail (example@gmail.com)"
                                />
                                @error('email')
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
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">निर्देशन</h4>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-danger">Please be carefull when you are configuring SMTP. For incorrect configuration you will get error at the time of order place, new registration, sending newsletter.</p>
                    <h4 class="mt-2">For Non-SSL</h4>
                    <ul class="list-group">
                        <li class="list-group-item text-dark">Select sendmail for Mail Driver if you face any issue after configuring smtp as Mail Driver</li>
                        <li class="list-group-item text-dark">Set Mail Host according to your server Mail Client Manual Settings</li>
                        <li class="list-group-item text-dark">Set Mail port as 587</li>
                        <li class="list-group-item text-dark">Set Mail Encryption as ssl if you face issue with tls</li>
                    </ul>
                    <br>
                    <h4>For SSL</h4>
                    <ul class="list-group mar-no">
                        <li class="list-group-item text-dark">Select sendmail for Mail Driver if you face any issue after configuring smtp as Mail Driver</li>
                        <li class="list-group-item text-dark">Set Mail Host according to your server Mail Client Manual Settings</li>
                        <li class="list-group-item text-dark">Set Mail port as 465</li>
                        <li class="list-group-item text-dark">Set Mail Encryption as ssl</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
