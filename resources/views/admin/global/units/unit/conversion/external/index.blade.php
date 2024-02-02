@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.global.units.unit.index')}}">मापन एकाइ</a>
                        </li>
                        <li class="breadcrumb-item active">मापन एकाइ थप्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">मापन एकाइ</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">मापन एकाइ थप्नुहोस्</h4>
                        <a href="{{route('admin.global.units.unit.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> मापन एकाइ सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.global.units.unit.external-unit-conversion.store',$unit)}}" method="post">
                        @csrf

                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>क्र.सं.</th>
                                    <th>देखि</th>
                                    <th>
                                        सम्म
                                        @error('conversion')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </th>
                                    <th>
                                        दर
                                        @error('conversion')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($conversionUnits as $index=>$conversionUnit)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$unit->title}}</td>
                                        <td>{{$conversionUnit->title}}
                                            <input
                                                type="hidden"
                                                name="conversion[{{$index}}][conversion_to]"
                                                value="{{old('conversion.'.$index.'.conversion_to',$conversionUnit->id)}}"
                                                class="form-control @error('conversion.'.$index.'.conversion_to') is-invalid @enderror"
                                                id="conversion[{{$index}}][conversion_to]"
                                                readonly
                                            />
                                            @error('conversion.'.$index.'.conversion_to')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <input
                                                type="text"
                                                name="conversion[{{$index}}][rate]"
                                                value="{{old('conversion.'.$index.'.rate',$conversions->where('conversion_to', $conversionUnit->id)->first()->rate ?? 0)}}"
                                                class="form-control @error('conversion.'.$index.'.rate') is-invalid @enderror"
                                                id="conversion[{{$index}}][rate]"
                                                min="0"
                                            />
                                            @error('conversion.'.$index.'.rate')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                        </div>

                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
