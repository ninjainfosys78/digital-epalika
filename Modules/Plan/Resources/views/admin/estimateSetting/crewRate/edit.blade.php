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

                        <li class="breadcrumb-item active">चालक दलको दर </li>
                    </ol>
                </div>
                <h4 class="page-title">चालक दलको दर </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">चालक दलको दर  </h4>
                        <a href="{{route('admin.plan.crewRate.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i>चालक दलको दर  सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.plan.crewRate.update',$crewRate)}}" method="post">
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
                                        value="{{old('quantity',$crewRate->quantity)}}"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        id="quantity"
                                        placeholder="मात्रा"
                                    />
                                    @error('quantity')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="labour_id" class="form-label">श्रम  *</label>
                                    <select
                                        name="labour_id"
                                        class="form-control @error('labour_id') is-invalid @enderror"
                                        id="labour_id" data-toggle="select2" data-width="100%" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach($labours as $labour)
                                            <option
                                                {{old('labour_id',$labour->id)== $crewRate->labour_id ? 'selected' : ''}}
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
                                    <label for="equipment_id" class="form-label">उपकरण  *</label>
                                    <select
                                        name="equipment_id"
                                        class="form-control @error('equipment_id') is-invalid @enderror"
                                        id="equipment_id" data-toggle="select2" data-width="100%" required>
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach($equipments as $equipment)
                                            <option
                                                {{old('equipment_id',$equipment->id)==$crewRate->equipment_id ? 'selected' : ''}}
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
