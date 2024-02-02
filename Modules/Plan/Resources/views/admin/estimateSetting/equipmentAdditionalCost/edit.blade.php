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

                        <li class="breadcrumb-item active">उपकरण अतिरिक्त लागत</li>
                    </ol>
                </div>
                <h4 class="page-title">उपकरण अतिरिक्त लागत</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">उपकरण अतिरिक्त लागत </h4>
                        <a href="{{route('admin.plan.equipmentAdditionalCost.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>उपकरण अतिरिक्त लागत सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    @livewire('plan::equipment-form-livewire',['formData'=>$equipment])
                    {{-- <form action="{{route('admin.plan.equipmentAdditionalCost.update',$equipmentAdditionalCost)}}" method="post">
                        @csrf
                        @method('put')

                        <fieldset class="mb-2">
                            <legend> विवरण</legend>
                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <label for="rate" class="form-label">दर</label>
                                    <input
                                        type="number"
                                        name="rate"
                                        value="{{old('rate',$equipmentAdditionalCost->rate)}}"
                                        class="form-control @error('rate') is-invalid @enderror"
                                        id="rate"
                                        placeholder="दर"
                                    />
                                    @error('rate')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="unit_id" class="form-label">एकाई *</label>
                                    <select
                                        name="unit_id"
                                        class="form-control @error('unit_id') is-invalid @enderror"
                                        id="unit_id" data-toggle="select2" data-width="100%" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach($units as $unit)
                                            <option
                                                {{old('unit_id',$unit->id)== $equipmentAdditionalCost->unit_id ? 'selected' : ''}}
                                                value="{{$unit->id}}">
                                                {{$unit->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="fiscal_year_id" class="form-label">आर्थिक वर्ष *</label>
                                    <select
                                        name="fiscal_year_id"
                                        class="form-control @error('fiscal_year_id') is-invalid @enderror"
                                        id="fiscal_year_id" data-toggle="select2" data-width="100%" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach($fiscalYears as $fiscalYear)
                                            <option
                                                {{old('fiscal_year_id',$fiscalYear->id)== $equipmentAdditionalCost->fiscal_year_id ? 'selected' : ''}}
                                                value="{{$fiscalYear->id}}">
                                                {{$fiscalYear->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fiscal_year_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="equipment_id" class="form-label">उपकरण  *</label>
                                    <select
                                        name="equipment_id"
                                        class="form-control @error('equipment_id') is-invalid @enderror"
                                        id="equipment_id" data-toggle="select2" data-width="100%" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach($equipments as $equipment)
                                            <option
                                                {{old('equipment_id',$equipment->id)== $equipmentAdditionalCost->equipment_id ? 'selected' : ''}}
                                                value="{{$equipment->id}}">
                                                {{$equipment->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('equipment_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>


                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>

@endsection
