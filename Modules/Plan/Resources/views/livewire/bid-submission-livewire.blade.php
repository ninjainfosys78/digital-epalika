<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4 class="header-title">
            आर्थिक कारोबारको विवरण
        </h4>
        <div class="d-flex gap-1">
            <a href="{{ route('admin.plan.project.index') }}" class="btn btn-sm btn-outline-primary">
                <i class="fa fa-list"></i> योजना/कार्यक्रमहरू
            </a>
            <button type="button" wire:click="create" class="btn btn-xs btn-outline-primary">
                <i class="fa fa-plus-circle"> नयाँ थप्नुहोस्</i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                <tr>
                    <th>क्र.स</th>
                    <th>मिति</th>
                    <th>शीर्षक</th>
                    <th>बिल/पेश्कीको क्रम</th>
                    <th>योजना स्वीकृत रकम</th>
                    <th>खर्च रकम</th>
                    <th>बाँकी रकम</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td>- -</td>
                    <td>- -</td>
                    <td>रू. {{$project->project_allocated_amounts_sum_amount}}</td>
                    <td>- -</td>
                    <td>रू. {{$project->project_allocated_amounts_sum_amount}}</td>
                    <td>- -</td>
                </tr>
                @php
                    $balance=$project->project_allocated_amounts_sum_amount;
                @endphp
                @forelse($project->projectBidSubmissions as $key=>$projectBidSubmission)
                    @php
                        $balance-=$projectBidSubmission->amount;
                    @endphp
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$projectBidSubmission->date}}</td>
                        <td>{{$projectBidSubmission->submission_type->label()}}</td>
                        <td>{{$projectBidSubmission->submission_no}}</td>
                        <td>- -</td>
                        <td>रू. {{$projectBidSubmission->amount}}</td>
                        <td>रू. {{$balance}}</td>
                        <td>
                            <button type="button" wire:click="edit({{$projectBidSubmission->id}})"
                                    class="btn btn-xs btn-outline-primary">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" wire:click="delete({{$projectBidSubmission->id}})"
                                    class="btn btn-xs btn-outline-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="8">
                            तालिकामा कुनै डाटा उपलब्ध छैन !!!
                        </td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="4" class="text-center">जम्मा</th>
                    <td>रू. {{$project->allocated_amount}}</td>
                    <td>रू. {{$project->projectBidSubmissions->sum('amount')}}</td>
                    <td>
                        रू. {{$project->project_allocated_amounts_sum_amount-$project->projectBidSubmissions->sum('amount')}}</td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="modal fade show {{!$createModalOpened ? 'd-none' : ''}}" id="bs-example-modal-lg" tabindex="-1"
             aria-labelledby="myLargeModalLabel" aria-modal="true" role="dialog"
             style="display: block;backdrop-filter: brightness(50%);">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title text-light" id="myLargeModalLabel">
                             विल विवरण थप्नुहोस्
                        </h4>
                        <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="store">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="submission_type" class="form-label">बिल/पेश्कीको प्रकार *</label>
                                    <select
                                        wire:model="form.submission_type"
                                        id="submission_type"
                                        class="form-select @error('form.submission_type') is-invalid @enderror">
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach(\Modules\Plan\Enums\BidSubmissionTypeEnum::cases() as $submissionType)
                                            <option
                                                value="{{$submissionType->value}}">
                                                {{$submissionType->label()}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('form.submission_type')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="submission_no" class="form-label">बिल/पेश्कीको क्रम</label>
                                    <input
                                        type="text"
                                        wire:model="form.submission_no"
                                        class="form-control @error('form.submission_no') is-invalid @enderror"
                                        id="submission_no"
                                        placeholder="बिल/पेश्कीको क्रम"
                                    />
                                    @error('form.submission_no')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="date" class="form-label"> मिति *</label>
                                    <input
                                        type="text"
                                        wire:model="form.date"
                                        class="form-control @error('form.date') is-invalid @enderror"
                                        id="date"
                                        placeholder="मिति"
                                    />
                                    @error('form.date')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="amount" class="form-label"> रकम * </label>
                                    <input
                                        type="number"
                                        wire:model="form.amount"
                                        class="form-control @error('form.amount') is-invalid @enderror"
                                        id="amount"
                                        placeholder="रकम"
                                    />
                                    @error('form.amount')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="button" wire:click="closeModal" class="btn btn-danger">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade show {{!$editModalOpened ? 'd-none' : ''}}" id="bs-example-modal-lg" tabindex="-1"
             aria-labelledby="myLargeModalLabel" aria-modal="true" role="dialog"
             style="display: block;backdrop-filter: brightness(50%);">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title text-light" id="myLargeModalLabel">
                            विल विवरण सम्पादन गर्नुहोस्
                        </h4>
                        <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="update">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="submission_type" class="form-label">बिल/पेश्कीको प्रकार *</label>
                                    <select
                                        wire:model="form.submission_type"
                                        id="submission_type"
                                        class="form-select @error('form.submission_type') is-invalid @enderror">
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach(\Modules\Plan\Enums\BidSubmissionTypeEnum::cases() as $submissionType)
                                            <option
                                                value="{{$submissionType->value}}">
                                                {{$submissionType->label()}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('form.submission_type')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="submission_no" class="form-label">बिल/पेश्कीको क्रम</label>
                                    <input
                                        type="text"
                                        wire:model="form.submission_no"
                                        class="form-control @error('form.submission_no') is-invalid @enderror"
                                        id="submission_no"
                                        placeholder="बिल/पेश्कीको क्रम"
                                    />
                                    @error('form.submission_no')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="date" class="form-label"> मिति *</label>
                                    <input
                                        type="text"
                                        wire:model="form.date"
                                        class="form-control @error('form.date') is-invalid @enderror"
                                        id="date"
                                        placeholder="मिति"
                                    />
                                    @error('form.date')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="amount" class="form-label"> रकम * </label>
                                    <input
                                        type="number"
                                        wire:model="form.amount"
                                        class="form-control @error('form.amount') is-invalid @enderror"
                                        id="amount"
                                        placeholder="रकम"
                                    />
                                    @error('form.amount')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="button" wire:click="closeModal" class="btn btn-danger">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script src="{{asset('assets/backend/js/plugins/datepicker.min.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#date").nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    container: '#bs-example-modal-lg',
                    onChange: function () {
                        let inputFieldDate = $("#date").val();
                        let parsedDate = NepaliFunctions.ParseDate(inputFieldDate);
                        let englishDate = NepaliFunctions.BS2AD(parsedDate.parsedDate)
                        let formattedDate = NepaliFunctions.ConvertDateFormat(englishDate, "YYYY-MM-DD")
                        //$("#en_from_date").val(formattedDate);

                        Livewire.emit('dateChanged', inputFieldDate, formattedDate);
                    }
                });
            });
        </script>
    @endpush
@endonce
