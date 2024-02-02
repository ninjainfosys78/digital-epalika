@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.plan.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.plan.project.index') }}">
                                योजनाहरु
                            </a>
                        </li>
                        <li class="breadcrumb-item active">आर्थिक कारोबारको विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">आर्थिक कारोबारको विवरण</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">आर्थिक कारोबारको विवरण</h4>
                        <a href="{{ route('admin.plan.project.consumerCommitteeTransaction.create', $project) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <table class="table table-sm table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>क्र.स</th>
                                <th>मिति</th>
                                <th>शीर्षक</th>
                                <th>योजना स्वीकृत रकम</th>
                                <th>खर्च रकम</th>
                                <th>बाँकी रकम</th>
                                <th>कैफियत</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>- -</td>
                                <td>रू. {{ $project->project_allocated_amounts_sum_amount }}</td>
                                <td>- -</td>
                                <td>रू. {{ $project->project_allocated_amounts_sum_amount }}</td>
                                <td>- -</td>
                                <td>- -</td>
                            </tr>
                            @php
                                $balance = $project->project_allocated_amounts_sum_amount;
                            @endphp
                            @forelse($project->consumerCommitteeTransactions as $transaction)
                                @php
                                    $balance -= $transaction->amount;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->date }}</td>
                                    <td>{{ $transaction->type?->label() }}</td>
                                    <td class="text-center">- -</td>
                                    <td>रू. {{ $transaction->amount }}</td>
                                    <td>रू. {{ $balance }}</td>
                                    <td>{{ $transaction->remarks }}</td>
                                    <td>
                                        <a data-bs-type="edit"
                                            href="{{ route('admin.plan.project.consumerCommitteeTransaction.edit', [$project, $transaction]) }}"
                                            class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form
                                            action="{{ route('admin.plan.project.consumerCommitteeTransaction.destroy', [$project, $transaction]) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button data-bs-type="delete"
                                                class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-center">जम्मा</th>
                                <td>रू. {{ $project->project_allocated_amounts_sum_amount }}</td>
                                <td>रू. {{ $project->consumerCommitteeTransactions->sum('amount') }}</td>
                                <td>
                                    रू.
                                    {{ $project->project_allocated_amounts_sum_amount - $project->consumerCommitteeTransactions->sum('amount') }}
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
