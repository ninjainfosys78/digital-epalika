@extends('roaster::traineeUser.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('traineeOrganization.admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a
                                href="{{ route('traineeOrganization.admin.attendance.index', [$training, $trainee]) }}">हाजिरी</a>
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">हाजिरी</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">हाजिरीहरु</h4>

                        <a href="{{ route('traineeOrganization.admin.attendance.create', [$training, $trainee]) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्
                        </a>

                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.सं</th>
                                    <th>मिति</th>
                                    <th>स्थिति</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendances as $attendance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attendance->date }}</td>
                                        <td>{{ $attendance->status->label() ?? '' }}</td>

                                        <td class="d-flex gap-1">

                                            <a href="{{ route('traineeOrganization.admin.attendance.edit', [$training, $trainee, $attendance]) }}"
                                                class="btn btn-xs btn-outline-info" title="सम्पादन गर्नुहोस्">
                                                <i class="fa fa-edit"></i>
                                            </a>


                                            <form
                                                action="{{ route('traineeOrganization.admin.attendance.destroy', [$training, $trainee, $attendance]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-xs btn-outline-danger" title="मेटाउनुहोस्">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
