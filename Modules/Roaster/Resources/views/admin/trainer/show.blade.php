@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.roaster.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.roaster.trainer.index') }}">प्रशिक्षक</a>
                        </li>
                        <li class="breadcrumb-item">
                            प्रशिक्षक विवरण
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">प्रशिक्षक विवरण</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card text-center">
                <div class="card-body">
                    <img src="{{ $trainer->photoUrl ?? '' }}" alt="{{ $trainer->name ?? '' }}"
                        class="rounded-circle avatar-lg img-thumbnail">
                    <h3 class="mb-0">{{ $trainer->name ?? '' }}</h3>
                    <p class="text-secondary mb-1"> {{ $trainer->designation->title ?? '' }}
                        ({{ $trainer->level ?? '' }})</p>
                </div>
            </div> <!-- end card -->

            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">बिषय विज्ञता</h4>

                    <div class="inbox-widget" data-simplebar style="max-height: 350px;">
                        <ul class="mt-2">
                            @foreach ($trainer->subjects as $subject)
                                <li>{{ $subject->title ?? '' }}</li>
                            @endforeach
                        </ul>
                    </div> <!-- end inbox-widget -->
                </div>
            </div> <!-- end card-->

        </div> <!-- end col-->

        <div class="col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-fill navtab-bg">
                        <li class="nav-item">
                            <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                व्यक्तिगत विवरण
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="aboutme">
                            <table class="table table-sm mb-0 table-striped table-hover table-bordered">
                                <tr>
                                    <th>नाम</th>
                                    <td>{{ $trainer->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>पद</th>
                                    <td>{{ $trainer->designation->title ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>तह</th>
                                    <td>{{ $trainer->level ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>फोन</th>
                                    <td>{{ $trainer->phone ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>इमेल</th>
                                    <td>{{ $trainer->email ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>स्थायी लेखा नम्बर</th>
                                    <td>{{ $trainer->pan ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>ठेगाना</th>
                                    <td>{{ $trainer->localBody->local_body ?? '' }}-{{ $trainer->ward ?? '' }}
                                        , {{ $trainer->district->district ?? '' }},
                                        {{ $trainer->province->province ?? '' }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @if (config('trainer.status.compactForm'))
                <hr>
                @if (config('trainer.type.bankDetailForm') == 'compact')
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">बैंक खाता</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $trainer->bank_detail ?? '' }}
                        </div>
                    </div>
                    <hr>
                @endif

                @if (config('trainer.type.experienceForm') == 'compact')
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">कार्य अनुभव (बर्ष)</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $trainer->experience ?? '' }}
                        </div>
                    </div>
                    <hr>
                @endif

                @if (config('trainer.type.qualificationForm') == 'compact')
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">शैक्षिक योग्यता</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $trainer->qualification ?? '' }}
                        </div>
                    </div>
                    <hr>
                @endif

                @if (config('trainer.type.experienceAsTraineeForm') == 'compact')
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">संलग्न तालिमको विवरण </h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $trainer->experience_as_trainee ?? '' }}
                        </div>
                    </div>
                    <hr>
                @endif

                @if (config('trainer.type.experienceAsTrainerForm') == 'compact')
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">तालिममा प्रशिक्षक भएको अनुभव</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $trainer->experience_as_trainer ?? '' }}
                        </div>
                    </div>
                @endif
            @endif

            @if (config('trainer.status.bankDetailForm') && config('trainer.type.bankDetailForm') == 'extended')
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>१. बैंक खाता विवरण</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>क्र.सं.</th>
                                        <th>बैंकको नाम</th>
                                        <th>शाखा</th>
                                        <th>खाता नं.</th>
                                        <th>खाता वालाको नाम</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($trainer->trainerBankDetails as $trainerBankDetail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $trainerBankDetail->bank_name ?? '' }}</td>
                                            <td>{{ $trainerBankDetail->bank_branch ?? '' }}</td>
                                            <td>{{ $trainerBankDetail->account_number ?? '' }}</td>
                                            <td>{{ $trainerBankDetail->account_holder ?? '' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No Data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            @if (config('trainer.status.experienceForm') && config('trainer.type.experienceForm') == 'extended')
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>२. कार्य अनुभव</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>क्र.सं.</th>
                                        <th>कार्यालय/संस्था</th>
                                        <th>पद</th>
                                        <th>मिति देखि</th>
                                        <th>मिति सम्म</th>
                                        <th>मुख्य जिम्मेवारी</th>
                                        <th>कैफियत</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($trainer->trainerExperiences as $workExperience)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $workExperience->office ?? '' }}</td>
                                            <td>{{ $workExperience->designation->title ?? '' }}</td>
                                            <td>{{ $workExperience->from ?? '' }}</td>
                                            <td>{{ $workExperience->to ?? '' }}</td>
                                            <td>{{ $workExperience->responsibility ?? '' }}</td>
                                            <td>{{ $workExperience->remarks ?? '' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No Data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            @if (config('trainer.status.qualificationForm') && config('trainer.type.qualificationForm') == 'extended')
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>३. शैक्षिक योग्यता</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>क्र.सं.</th>
                                        <th>शैक्षिक तह</th>
                                        <th>विषय</th>
                                        <th>विश्वविद्यालय/शैक्षिक संस्था</th>
                                        <th>सम्पन्न वर्ष</th>
                                        <th>मुख्य विषय</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($trainer->trainerQualifications as $trainerQualification)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $trainerQualification->achievement ?? '' }}</td>
                                            <td>{{ $trainerQualification->institute ?? '' }}</td>
                                            <td>{{ $trainerQualification->passed_year ?? '' }}</td>
                                            <td>{{ $trainerQualification->major_subjects ?? '' }}</td>
                                            <td>{{ $trainerQualification->remarks ?? '' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No Data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            @if (config('trainer.status.experienceAsTraineeForm') && config('trainer.type.experienceAsTraineeForm') == 'extended')
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>४. संलग्न तालिमको विवरण</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>क्र.सं.</th>
                                        <th>तालिमको विषय</th>
                                        <th>तालिम दिने निकाय</th>
                                        <th>तालिमको अवधि</th>
                                        <th>सहभागीको स्तर</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($trainer->trainerExperienceAsTrainees as $trainerExperienceAsTrainee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $trainerExperienceAsTrainee->subject ?? '' }}</td>
                                            <td>{{ $trainerExperienceAsTrainee->provider ?? '' }}</td>
                                            <td>{{ $trainerExperienceAsTrainee->duration ?? '' }}</td>
                                            <td>{{ $trainerExperienceAsTrainee->venue ?? '' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No Data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            @if (config('trainer.status.experienceAsTrainerForm') && config('trainer.type.experienceAsTrainerForm') == 'extended')
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>५. तालिममा प्रशिक्षक भएको अनुभव</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>क्र.सं.</th>
                                        <th>प्रशिक्षणको विषय</th>
                                        <th>तालिम दिने निकाय</th>
                                        <th>तालिमको अवधि</th>
                                        <th>सहभागीको स्तर</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($trainer->trainerExperienceInTrainings as $trainerExperienceInTraining)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $trainerExperienceInTraining->sector ?? '' }}</td>
                                            <td>{{ $trainerExperienceInTraining->subject ?? '' }}</td>
                                            <td>{{ $trainerExperienceInTraining->organization ?? '' }}</td>
                                            <td>{{ $trainerExperienceInTraining->training_level ?? '' }}</td>
                                            <td>{{ $trainerExperienceInTraining->training_time ?? '' }}</td>
                                            <td>{{ $trainerExperienceInTraining->remarks ?? '' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No Data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
