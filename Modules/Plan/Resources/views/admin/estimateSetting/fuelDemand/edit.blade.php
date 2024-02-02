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

                        <li class="breadcrumb-item active">इन्धनको माग</li>
                    </ol>
                </div>
                <h4 class="page-title">इन्धनको माग</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">इन्धनको माग </h4>
                        <a href="{{route('admin.plan.fuelDemand.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>इन्धनको माग सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.plan.fuelDemand.update',$fuelDemand)}}" method="post">
                        @csrf
                        @method('put')

                        <fieldset class="mb-2">
                            <legend> विवरण</legend>
                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <label for="quantity" class="form-label">मात्रा</label>
                                    <input
                                        type="text"
                                        name="quantity"
                                        value="{{old('quantity',$fuelDemand->quantity)}}"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        id="quantity"
                                        placeholder="मात्रा"
                                    />
                                    @error('quantity')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="fuel_id" class="form-label">इन्धन  *</label>
                                    <select
                                        name="fuel_id"
                                        class="form-control @error('fuel_id') is-invalid @enderror"
                                        id="fuel_id" data-toggle="select2" data-width="100%" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach($fuels as $fuel)
                                            <option
                                                {{old('fuel_id',$fuel->id)== $fuelDemand->fuel_id ? 'selected' : ''}}
                                                value="{{$fuel->id}}">
                                                {{$fuel->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fuel_id')
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
                                                {{old('equipment_id',$equipment->id)==$fuelDemand->equipment_id ? 'selected' : ''}}
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
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
