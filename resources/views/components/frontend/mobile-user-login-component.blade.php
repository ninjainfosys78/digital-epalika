<div class="card bg-transparent">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="loginTabs">
            <li class="nav-item">
                <a class="nav-link active" id="user-tab" data-bs-toggle="tab" href="#user">सेवाग्राही
                    लग-इन </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mr-0" style="margin-right: 0 !important" id="organization-tab" data-bs-toggle="tab"
                    href="#organization">संस्था लग-इन </a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="user">
                <h5 class="card-title text-white my-4">सेवाग्राही लग-इन </h5>
                <form action="{{ route('mobileUser.login') }}" method="post">
                    @csrf
                    <!-- User Login Form Fields -->
                    <div class="mb-3 input-group input-group-icon">
                        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                <path
                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                            </svg></span>
                        <label for="email" class="form-label visually-hidden">इमेल</label>
                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="email"
                            value="{{ old('email') }}" id="email" placeholder="इमेल" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 input-group input-group-icon">
                        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1" />
                            </svg></span>
                        <label for="password" class="form-label visually-hidden">पासवर्ड</label>
                        <input name="password" class="form-control @error('password') is-invalid @enderror"
                            type="password" id="password" placeholder="पासवर्ड" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-4 d-block w-100 py-2">लग-इन</button>
                    <div class="mt-1 text-center text-white">
                        सेवाग्रहिको खाता छैन ? &nbsp; <a href="{{ route('mobileUser.register.form') }}">साइन
                            अप</a>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="organization">
                <h5 class="card-title text-white my-4">संस्था लग-इन</h5>
                <form action="{{ route('organization.login') }}" method="post">
                    <!-- Organization Login Form Fields -->
                    @csrf
                    <div class="mb-3 input-group input-group-icon">
                        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                <path
                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                            </svg></span>
                        <label for="email" class="form-label visually-hidden">इमेल</label>
                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="email"
                            value="{{ old('email') }}" id="email" placeholder="इमेल" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 input-group input-group-icon">
                        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1" />
                            </svg></span>
                        <label for="password" class="form-label visually-hidden">पासवर्ड</label>
                        <input name="password" class="form-control @error('password') is-invalid @enderror"
                            type="password" id="password" placeholder="पासवर्ड" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- @if (config('app.env') === 'production')
                        <div class="mb-2">
                            {!! htmlFormSnippet() !!}
                            @error('g-recaptcha-response')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif --}}
                    <button type="submit" class="btn btn-primary mt-4 d-block w-100 py-2">लग-इन</button>
                    <div class="mt-1 text-center text-white">
                        संस्था दर्ता गर्नु भएको छैन भने? &nbsp; <a
                            href="{{ route('organization.register.form') }}">संस्था दर्ता गर्नुहोस
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
