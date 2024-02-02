@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">नयाँ घर धनीको विवरण</h4>
                <div class="mb-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('emap.admin.dashboard') }}">
                                <img class="icon me-1" src="http://127.0.0.1:8000/assets/backend/images/home.svg"
                                    alt="document-icon"> गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                        <a href="{{ route('emap.admin.mapApply.admin-step.form-list',$mapApply) }}">
                            चरण
                            </a>



                        </li>
                        <li class="breadcrumb-item active">घर धनीको विवरण</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ घर धनीको विवरण</h4>
                    </div>
                </div>
            </div>
            <div class="card-body px-0">
                <form action="{{ route('emap.admin.houseOwnerArchive.store',$mapApply) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="card p-4 mb-4">


                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="name"> जग्गा धनीको नाम </label>
                                    <input class="form-control form-control-sm" type="text" value="{{ old('name') }}" name="name" id="name"
                                         placeholder=" जग्गा धनीको नाम">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="phone"> फोन नं.</label>
                                    <input class="form-control form-control-sm" type="text" value="{{ old('phone') }}" id="phone"
                                        name="phone" placeholder="फोन नं.">
                                    @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="father_name">बुवाको नाम</label>
                                    <input class="form-control form-control-sm" type="text" value="{{ old('father_name') }}" id="father_name"
                                        name="father_name" placeholder="बुवाको नाम">
                                    @error('father_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="grandfather_name"> हजुरबुबाको नाम</label>
                                    <input class="form-control form-control-sm" type="text"  value="{{ old('grandfather_name') }}" id="grandfather_name"
                                        name="grandfather_name" placeholder="हजुरबुबाको नाम">
                                    @error('grandfather_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="citizenship_no"> नागरिकता नम्बर</label>
                                    <input class="form-control form-control-sm" type="text"  value="{{ old('citizenship_no') }}" id="citizenship_no"
                                        name="citizenship_no" placeholder="नागरिकता नम्बर">
                                    @error('citizenship_no')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="citizenship_issue_date"> नागरिकता लिएको मिति</label>
                                    <input class="form-control form-control-sm"  value="{{ old('citizenship_issue_date') }}" type="text" id="citizenship_issue_date"
                                        name="citizenship_issue_date" placeholder="yyyy/mm/dd">
                                    @error('citizenship_issue_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="citizenship_issue_district_id"> नागरिकता लिएको
                                        जिल्ला</label>
                                    <select class="form-select form-select-sm" name="citizenship_issue_district_id"
                                        id="citizenship_issue_district_id">
                                        <option value="">--- जिल्ला छान्नुहोस् ---</option>
                                        @foreach ($allDistricts as $district)
                                            <option value="{{ $district->id }}" {{ old('citizenship_issue_district_id') ==  $district->id ? 'selected':'' }}>
                                                {{ $district->district }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('citizenship_issue_district_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="address"> ठेगाना</label>
                                    <input class="form-control form-control-sm" type="text"  value="{{ old('address') }}" id="address"
                                        name="address" placeholder="ठेगाना">
                                    @error('address')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="local_body"> पालिका</label>
                                    <input class="form-control form-control-sm" type="text"  value="{{ old('local_body') }}" id="local_body"
                                        name="local_body" placeholder="पालिका">
                                    @error('local_body')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="ward_no"> वडा नं.</label>
                                    <input class="form-control form-control-sm" type="number" value="{{ old('ward_no') }}" id="ward_no"
                                    name="ward_no" min="0" placeholder="वडा नं.">
                                    @error('ward_no')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                @livewire('multiple-file')
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        पेश गर्नुहोस
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="header-title mb-0">पुरानो घर धनीको विवरण</h4>

        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>क्र.स</th>
                        <th>जग्गा धनीको नाम</th>
                        <th>फोन नं.</th>
                        <th>बुवाको नाम</th>
                        <th>हजुरबुबाको नाम</th>
                        <th>नागरिकता नम्बर</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($houseOwnerArchives as $houseOwnerArchive)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $houseOwnerArchive->name }}</td>
                            <td>{{ $houseOwnerArchive->phone }}</td>
                            <td>{{ $houseOwnerArchive->father_name}}</td>
                            <td>{{ $houseOwnerArchive->grandfather_name }}</td>
                            <td>{{ $houseOwnerArchive->citizenship_no }}</td>
                            <td class="d-flex">
                                <a data-bs-type="edit"
                                    href="{{ route('emap.admin.houseOwnerArchive.show', [$mapApply,$houseOwnerArchive]) }}"
                                    class="btn btn-xs me-1 btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                    data-bs-toggle="tooltip" data-bs-placement="top">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
