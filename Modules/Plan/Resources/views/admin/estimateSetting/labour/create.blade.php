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

                        <li class="breadcrumb-item active">Labour</li>
                    </ol>
                </div>
                <h4 class="page-title">Labours</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">Labours </h4>
                        <a href="{{ route('admin.plan.labour.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>Labours
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('admin.plan.labour.store') }}" method="post">
                        @csrf

                        <fieldset class="mb-2">
                            <legend> विवरण</legend>
                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <label for="title" class="form-label">शिर्षक</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        class="form-control @error('title') is-invalid @enderror" id="title"
                                        placeholder="शिर्षक" />
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label for="unit_id" class="form-label">एकाई *</label>
                                    <select name="unit_id" class="form-control @error('unit_id') is-invalid @enderror"
                                        id="unit_id" data-toggle="select2" data-width="100%" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach ($units as $unit)
                                            <option {{ old('unit_id') == $unit->id ? 'selected' : '' }}
                                                value="{{ $unit->id }}">
                                                {{ $unit->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
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
