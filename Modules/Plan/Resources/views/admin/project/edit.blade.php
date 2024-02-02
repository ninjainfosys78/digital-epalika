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
                        <li class="breadcrumb-item active">योजनाहरु</li>
                    </ol>
                </div>
                <h4 class="page-title">योजनाहरु</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">आयोजनाको विवरण सम्पादन गर्नुहोस </h4>
                        <a href="{{route('admin.plan.project.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> योजना/कार्यक्रम हरू
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('admin.plan.project.update',$project)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label for="registration_no" class="form-label">दर्ता नं. *</label>
                                <input
                                    type="text"
                                    name="registration_no"
                                    value="{{old('registration_no',$project->registration_no)}}"
                                    class="form-control @error('registration_no') is-invalid @enderror"
                                    id="registration_no"
                                    placeholder="दर्ता नं."
                                    required
                                />
                                @error('registration_no')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="project_status" class="form-label">योजनाको अबस्था *</label>
                                <select
                                    name="project_status"
                                    class="form-control @error('project_status') is-invalid @enderror"
                                    id="project_status" data-toggle="select2" data-width="100%">
                                    <option value="">--- छान्नुहोस् ---</option>
                                    @foreach(\Modules\Plan\Enums\ProjectStatusEnum::cases() as $projectStatus)
                                        <option
                                            {{old('project_status',$project->project_status->value)==$projectStatus->value ? 'selected' : ''}}
                                            value="{{$projectStatus->value}}">
                                            {{$projectStatus->label()}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('project_status')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <fieldset class="mb-2">
                            <legend>आयोजनाको विवरण</legend>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="project_name" class="form-label">योजना/कार्यक्रमको नाम *</label>
                                    <input
                                        type="text"
                                        name="project_name"
                                        value="{{old('project_name',$project->project_name)}}"
                                        class="form-control @error('project_name') is-invalid @enderror"
                                        id="project_name"
                                        placeholder="योजना/कार्यक्रमको नाम"
                                        required
                                    />
                                    @error('project_name')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="purpose" class="form-label">उद्देश्य</label>
                                    <input
                                        type="text"
                                        name="purpose"
                                        value="{{old('purpose',$project->purpose)}}"
                                        class="form-control @error('purpose') is-invalid @enderror"
                                        id="purpose"
                                        placeholder="उद्देश्य"
                                    />
                                    @error('purpose')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="plan_area_id" class="form-label">योजनाको क्षेत्र *</label>
                                    <select
                                        name="plan_area_id"
                                        class="form-control @error('plan_area_id') is-invalid @enderror"
                                        id="plan_area_id" data-toggle="select2" data-width="100%" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach($planAreas as $planArea)
                                            @if(count($planArea->planAreas)>0)
                                                <optgroup label="{{$planArea->area_name}}">
                                                    @foreach($planArea->planAreas as $plan_sub_area)
                                                        <option
                                                            {{old('plan_area_id',$project->plan_area_id)==$plan_sub_area->id ? 'selected' : ''}}
                                                            value="{{$plan_sub_area->id}}">
                                                            {{$plan_sub_area->area_name}}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @else
                                                <option
                                                    {{old('plan_area_id',$project->plan_area_id)==$planArea->id ? 'selected' : ''}}
                                                    value="{{$planArea->id}}">
                                                    {{$planArea->area_name}}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('plan_area_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="plan_level_id" class="form-label">योजनाको स्तर *</label>
                                    <select
                                        name="plan_level_id"
                                        class="form-control @error('plan_level_id') is-invalid @enderror"
                                        id="plan_level_id" data-toggle="select2" data-width="100%">
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach($planLevels as $planLevel)
                                            @if(count($planLevel->planLevels)>0)
                                                <optgroup label="{{$planLevel->level_name}}">
                                                    @foreach($planLevel->planLevels as $plan_sub_level)
                                                        <option
                                                            {{old('plan_level_id',$project->plan_level_id)==$plan_sub_level->id ? 'selected' : ''}}
                                                            value="{{$plan_sub_level->id}}">
                                                            {{$plan_sub_level->level_name}}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @else
                                                <option
                                                    {{old('plan_level_id',$project->plan_level_id)==$planLevel->id ? 'selected' : ''}}
                                                    value="{{$planLevel->id}}">
                                                    {{$planLevel->level_name}}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('plan_level_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="project_venue" class="form-label">आयोजना स्थल </label>
                                    <input
                                        type="text"
                                        name="project_venue"
                                        value="{{old('project_venue',$project->project_venue)}}"
                                        class="form-control @error('project_venue') is-invalid @enderror"
                                        id="project_venue"
                                        placeholder="आयोजना स्थल"
                                    />
                                    @error('project_venue')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="ward_no" class="form-label"> वडा नं.</label>
                                    <select
                                        name="ward_no[]"
                                        class="form-control @error('ward_no') is-invalid @enderror"
                                        multiple
                                        id="ward_no" data-toggle="select2" data-width="100%">
                                        <option disabled>--- छान्नुहोस् ---</option>
                                        @foreach($officeSetting->localBody->ward_no as $ward)
                                            <option
                                                {{in_array($ward,$project->ward_no) ? 'selected' : ''}}
                                                value="{{$ward}}">
                                                {{$ward}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ward_no')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="expense_head_id" class="form-label">खर्चको किसिम *</label>
                                    <select
                                        name="expense_head_id"
                                        class="form-control @error('expense_head_id') is-invalid @enderror"
                                        id="expense_head_id" data-toggle="select2" data-width="100%" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach($expenseHeads as $expenseHead)
                                            <option
                                                {{old('expense_head_id',$project->expense_head_id)==$expenseHead->id ? 'selected' : ''}}
                                                value="{{$expenseHead->id}}">
                                                {{$expenseHead->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('expense_head_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="mb-2">
                            <legend>बजेट *</legend>
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <label for="budget" class="form-label fw-bold">बजेट शिर्षक <span
                                        class="text-danger">*</span></label>
                                <button
                                    type="button"
                                    class="btn btn-xs btn-outline-info"
                                    data-target-element="budget"
                                    data-toggle="add-more">
                                    <i class="fas fa-plus-circle"></i> नयाँ थप्नुहोस्
                                </button>
                            </div>
                            <div id="budget">
                                @foreach($project->projectAllocatedAmounts as $key=>$projectAllocatedAmount)
                                <div class="main">
                                    <div class="text-end">
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-toggle="remove-parent" data-parent=".main"
                                                data-target-element="budget">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="row border-bottom mb-2">
                                        <input type="hidden" name="projectAllocatedAmounts[{{$key}}][id]"
                                               value="{{$projectAllocatedAmount->id}}">
                                        <div class="col-md-6 mb-2">
                                            <label for="budget_head_id" class="form-label">बजेट शिर्षक *</label>
                                            <select
                                                name="projectAllocatedAmounts[{{$key}}][budget_head_id]"
                                                class="form-select @error('budget_head_id') is-invalid @enderror"
                                                id="budget_head_id">
                                                <option value="" disabled>--- छान्नुहोस् ---</option>
                                                @foreach($budgetHeads as $budgetHead)
                                                    @if(count($budgetHead->budgetHeads)>0)
                                                        <optgroup label="{{$budgetHead->title}}">
                                                            @foreach($budgetHead->budgetHeads as $budget_sub_head)
                                                                <option
                                                                    {{old('budget_head_id')==$budget_sub_head->id ? 'selected' : ''}}
                                                                    value="{{$budget_sub_head->id}}">
                                                                    {{$budget_sub_head->title}}
                                                                </option>
                                                            @endforeach
                                                        </optgroup>
                                                    @else
                                                        <option
                                                            {{old('budget_head_id')==$budgetHead->id ? 'selected' : ''}}
                                                            value="{{$budgetHead->id}}">
                                                            {{$budgetHead->title}}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('budget_head_id')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="amount" class="form-label">रकम *</label>
                                            <input
                                                type="number"
                                                name="projectAllocatedAmounts[{{$key}}][amount]"
                                                class="form-control"
                                                id="amount"
                                                placeholder="रकम"
                                                required
                                                min="0"
                                                value="{{$projectAllocatedAmount->amount}}"
                                            />
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </fieldset>
                        <fieldset class="mb-2">
                            <legend>चौमासिक अनुसार लक्ष्य</legend>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="first_quarterly_amount" class="form-label">पहिलो चौमासिक आर्थिक लक्ष्य</label>
                                    <input
                                        type="number"
                                        name="first_quarterly_amount"
                                        value="{{old('first_quarterly_amount', $project->first_quarterly_amount)}}"
                                        class="form-control @error('first_quarterly_amount') is-invalid @enderror"
                                        id="first_quarterly_amount"
                                        placeholder="पहिलो चौमासिक आर्थिक लक्ष्य"
                                    />
                                    @error('first_quarterly_amount')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="first_quarterly_goal" class="form-label">पहिलो चौमासिक भौतिक लक्ष्य</label>
                                    <input
                                        type="number"
                                        name="first_quarterly_goal"
                                        value="{{old('first_quarterly_goal', $project->first_quarterly_goal)}}"
                                        class="form-control @error('first_quarterly_goal') is-invalid @enderror"
                                        id="first_quarterly_goal"
                                        placeholder="पहिलो चौमासिक भौतिक लक्ष्य"
                                    />
                                    @error('first_quarterly_goal')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="second_quarterly_amount" class="form-label">दोश्रो चौमासिक आर्थिक लक्ष्य</label>
                                    <input
                                        type="number"
                                        name="second_quarterly_amount"
                                        value="{{old('second_quarterly_amount', $project->second_quarterly_amount)}}"
                                        class="form-control @error('second_quarterly_amount') is-invalid @enderror"
                                        id="second_quarterly_amount"
                                        placeholder="दोश्रो चौमासिक आर्थिक लक्ष्य"
                                    />
                                    @error('second_quarterly_amount')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="second_quarterly_goal" class="form-label">दोश्रो चौमासिक भौतिक लक्ष्य</label>
                                    <input
                                        type="number"
                                        name="second_quarterly_goal"
                                        value="{{old('second_quarterly_goal', $project->second_quarterly_goal)}}"
                                        class="form-control @error('second_quarterly_goal') is-invalid @enderror"
                                        id="second_quarterly_goal"
                                        placeholder="दोश्रो चौमासिक भौतिक लक्ष्य"
                                    />
                                    @error('second_quarterly_goal')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="third_quarterly_amount" class="form-label">तेश्रो चौमासिक आर्थिक लक्ष्य</label>
                                    <input
                                        type="number"
                                        name="third_quarterly_amount"
                                        value="{{old('third_quarterly_amount', $project->third_quarterly_amount)}}"
                                        class="form-control @error('third_quarterly_amount') is-invalid @enderror"
                                        id="third_quarterly_amount"
                                        placeholder="तेश्रो चौमासिक आर्थिक लक्ष्य"
                                    />
                                    @error('third_quarterly_amount')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="third_quarterly_goal" class="form-label">तेश्रो चौमासिक भौतिक लक्ष्य</label>
                                    <input
                                        type="number"
                                        name="third_quarterly_goal"
                                        value="{{old('third_quarterly_goal', $project->third_quarterly_goal)}}"
                                        class="form-control @error('third_quarterly_goal') is-invalid @enderror"
                                        id="third_quarterly_goal"
                                        placeholder="तेश्रो चौमासिक भौतिक लक्ष्य"
                                    />
                                    @error('third_quarterly_goal')
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
@endsection
