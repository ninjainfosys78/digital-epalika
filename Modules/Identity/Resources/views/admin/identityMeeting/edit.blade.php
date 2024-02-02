@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('identity.admin.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">बैठक</li>
                    </ol>
                </div>
                <h4 class="page-title">बैठक</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">बैठक सम्पादन गर्नुहोस</h4>
                        <a href="{{ route('identity.admin.identityMeeting.index') }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-plus-circle"></i> बैठक सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('identity.admin.identityMeeting.update', $identityMeeting) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="title" class="form-label">बैठकको शिर्षक *</label>
                                <input type="text" name="title" value="{{ old('title', $identityMeeting->title) }}"
                                       class="form-control @error('title') is-invalid @enderror" id="title"
                                       placeholder="बैठकको शिर्षक"/>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component nameNe="date_bs"
                                                        labelNe="बैठक मिति *"
                                                        nameEn="date_ad"
                                                        labelEn="Meeting Date"
                                                        :getTodayDate="false"
                                                        :editDateNe="$identityMeeting->date_bs"
                                                        :editDateEn="$identityMeeting->date_ad"
                                />
                            </div>
                            <div class="col-md-12 mb-2">
                                <fieldset>
                                    <legend for="committees" class="form-label">समिति सदस्यहरु *</legend>
                                    <div class="row">
                                        @foreach ($disabilityCommittees as $disabilityCommittee)
                                            <div class="col-sm-3">
                                                <div class="form-check">
                                                    <input type="checkbox"
                                                           {{ in_array($disabilityCommittee->id, old('committees',($identityMeeting->disabilityCommittees?->pluck('id')?->toArray() ?? []))) ? 'checked' : '' }}
                                                           class="form-check-input" name="committees[]"
                                                           value="{{ $disabilityCommittee->id }}"
                                                           id="committees{{ $disabilityCommittee->id }}">
                                                    <label class="form-check-label"
                                                           for="committees{{ $disabilityCommittee->id }}">{{ $disabilityCommittee->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                        @error('committees')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @error('committees.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                @livewire('identity::invited-guest-livewire',['guests' => old('guests', $identityMeeting->invitedGuests)])
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="disabilityIdentityCards" class="form-label">अपाङ्गता परिचय पत्र को लागि
                                    योग्य
                                    *</label>
                                <div class="row">
                                    @foreach ($identityMeeting->disabilityIdentityCards as $disabilityIdentityCard)
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                       name="disabilityIdentityCards[{{ $loop->index }}][id]"
                                                       value="{{ $disabilityIdentityCard->id }}"
                                                       id="disabilityIdentityCards{{ $disabilityIdentityCard->id }}"
                                                    {{ in_array($disabilityIdentityCard->id, old('disabilityIdentityCards',($identityMeeting->disabilityIdentityCards?->pluck('id')?->toArray() ?? []))) ? 'checked' : '' }}
                                                >
                                                <label class="form-check-label"
                                                       for="disabilityIdentityCards{{ $disabilityIdentityCard->id }}">{{ $disabilityIdentityCard->name }}</label>
                                            </div>
                                            @error("disabilityIdentityCards.$loop->index.id")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <select
                                                name="disabilityIdentityCards[{{ $loop->index }}][gov_disability_type_id]"
                                                class="form-select form-select-sm" id="disabilityIdentityCards">
                                                <option value="">छान्नुहोस्</option>
                                                @foreach ($governmentDisabilityTypes as $governmentDisabilityType)
                                                    <option value="{{ $governmentDisabilityType->id }}"
                                                        {{ old("disabilityIdentityCards.$loop->index.gov_disability_type_id", $disabilityIdentityCard->gov_disability_type_id) == $governmentDisabilityType->id ? 'selected' : '' }}
                                                    >
                                                        {{ $governmentDisabilityType->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error("disabilityIdentityCards.$loop->index.gov_disability_type_id")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach
                                    @error('disabilityIdentityCards')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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

    @push('scripts')
        <script src="{{ asset('assets/backend/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/backend/ckeditor/editor.js') }}"></script>

        <script>

            window.addEventListener('guest-delete', event => {

                Swal.fire({
                    title: 'Do you want to save the changes?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Livewire.emit('deleteGuest', event.detail.index)
                    }
                })

            })
            window.addEventListener('guest-delete-error', event => {
                let timerInterval
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: 'Unexpected error occurred while deleting ' + event.detail.name + '!',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })

            })

        </script>
    @endpush
@endsection
