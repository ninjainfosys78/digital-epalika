@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.plan.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">Labour Rate</li>
                    </ol>
                </div>
                <h4 class="page-title">Labour Rates</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">Labour Rates </h4>
                        <a href="{{route('admin.plan.labourRate.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>Labour Rates
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.plan.labourRate.update',$labourRate)}}" method="post">
                        @csrf
                        @method('put')
                        <fieldset class="mb-2">
                            <legend> विवरण</legend>
                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <label for="rate" class="form-label">दर</label>
                                    <input
                                        type="number"
                                        step="any"
                                        name="rate"
                                        value="{{old('rate',$labourRate->rate)}}"
                                        class="form-control @error('rate') is-invalid @enderror"
                                        id="rate"
                                        placeholder="दर"
                                    />
                                    @error('rate')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label for="labour_id" class="form-label">Labour</label>
                                    <select
                                        name="labour_id"
                                        class="form-control @error('labour_id') is-invalid @enderror"
                                        id="labour_id" data-toggle="select2" data-width="100%" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach($labours as $labour)
                                            <option
                                                {{old('labour_id',$labour->id)==$labourRate->labour_id ? 'selected' : ''}}
                                                value="{{$labour->id}}">
                                                {{$labour->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('labour_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="fiscal_year_id" class="form-label">Fiscal Year</label>
                                    <select
                                        name="fiscal_year_id"
                                        class="form-control @error('fiscal_year_id') is-invalid @enderror"
                                        id="fiscal_year_id" data-toggle="select2" data-width="100%" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach($fiscalYears as $fiscalYear)
                                            <option
                                                {{old('fiscal_year_id',$fiscalYear->id)==$labourRate->fiscal_year_id ? 'selected' : ''}}
                                                value="{{$fiscalYear->id}}">
                                                {{$fiscalYear->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fiscal_year_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(() => {
                const budgetHeadSelect = $('#budget_head_id');
                const allocatedAmountsContainer = $('#allocated-amounts');
                let allocatedAmounts = {}; // store allocated amounts for each option
                setProjectAllocatedAmountInputs();
                budgetHeadSelect.on('change', setProjectAllocatedAmountInputs);

                function setProjectAllocatedAmountInputs() {
                    allocatedAmountsContainer.empty();
                    const selectedOptions = budgetHeadSelect.find('option:selected').toArray();
                    selectedOptions.forEach((option, index) => {
                        const div = $('<div>').addClass('col-md-4 mb-2');
                        const label = $('<label>').addClass('form-label');
                        label.attr('for', `projectAllocatedAmounts${index}`);
                        label.text(`${$(option).text()} *`);

                        const budgetHeadId = $(option).val();
                        let amount = 0; // default amount is 0

                        // check if allocated amount exists for this option
                        if (allocatedAmounts.hasOwnProperty(budgetHeadId)) {
                            amount = allocatedAmounts[budgetHeadId];
                        }

                        const amountInput = $('<input>').attr({
                            type: 'number',
                            min: 0,
                            placeholder: $.trim($(option).text()),
                            id: `projectAllocatedAmounts${index}`,
                            name: `projectAllocatedAmounts[${index}][amount]`,
                            value: amount // set input value to stored amount
                        }).addClass('form-control');

                        const budgetHeadInput = $('<input>').attr({
                            type: 'hidden',
                            name: `projectAllocatedAmounts[${index}][budget_head_id]`,
                            value: budgetHeadId,
                        });

                        // update stored amount when input value changes
                        amountInput.on('input', () => {
                            allocatedAmounts[budgetHeadId] = amountInput.val();
                        });

                        div.append(label);
                        div.append(amountInput);
                        div.append(budgetHeadInput);

                        allocatedAmountsContainer.append(div);
                    });
                }
            });

        </script>
    @endpush
@endsection
