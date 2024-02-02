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
                            <a href="{{route('admin.businessRegistration.setting.investmentRevenue.index')}}">कारोबार
                                गर्ने वस्तु उप श्रेणी </a>
                        </li>
                        <li class="breadcrumb-item active">पुँजीगत लगानी र राजस्वो</li>
                    </ol>
                </div>
                <h4 class="page-title">पुँजीगत लगानी र राजस्वो</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">पुँजीगत लगानी र राजस्वो सम्पादन गर्नुहोस्</h4>
                        <a href="{{route('admin.businessRegistration.setting.investmentRevenue.index')}}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> पुँजीगत लगानी र राजस्वो सूची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form
                        action="{{route('admin.businessRegistration.setting.investmentRevenue.update', $investmentRevenue)}}"
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <fieldset class="border p-2 mb-2">
                            <legend class="font-16 text-info">
                                <strong> पुँजीगत लगानी र राजस्वो</strong>
                            </legend>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="title" class="form-label">शिर्षक *</label>
                                    <input
                                        type="text"
                                        name="title"
                                        value="{{old('title',$investmentRevenue->title)}}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="title"
                                        placeholder="शिर्षक"
                                        required
                                    />
                                    @error('title')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="object_transaction_id" class="form-label">बर्ग *</label>
                                    <select name="object_transaction_id" id="object_transaction_id"
                                            class="form-control" required>
                                        <option value="">छान्नुहोस्</option>
                                        @forelse($objectTransactions as $objectTransaction)
                                            <option value="{{$objectTransaction->id}}"
                                                {{$objectTransaction->objectTransactions?->count() > 0 ? 'disabled' : ''}}
                                                {{old('object_transaction_id',$investmentRevenue->object_transaction_id)===$objectTransaction->id ? 'selected':''}}>
                                                {{$objectTransaction->title}}
                                            </option>
                                            @foreach($objectTransaction->objectTransactions as $object)
                                                <option
                                                    value="{{$object->id}}"
                                                    {{old('object_transaction_id',$investmentRevenue->object_transaction_id)===$objectTransaction->id ? 'selected':''}}>
                                                    ---{{$object->title}}</option>
                                            @endforeach
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('object_transaction_id')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror

                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="registration_amount" class="form-label">नयाँ व्यवसाय दर्ता गर्दा लाग्ने
                                        शुल्क*</label>
                                    <input
                                        type="text"
                                        name="registration_amount"
                                        value="{{old('registration_amount',$investmentRevenue->registration_amount)}}"
                                        class="form-control @error('registration_amount') is-invalid @enderror"
                                        id="registration_amount"
                                        placeholder="नयाँ व्यवसाय दर्ता गर्दा लाग्ने शुल्क"
                                        required
                                    />
                                    @error('registration_amount')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="renew_amount" class="form-label">व्यवसाय नबिकरण दर्ता गर्दा लाग्ने शुल्क
                                        *</label>
                                    <input
                                        type="text"
                                        name="renew_amount"
                                        value="{{old('renew_amount',$investmentRevenue->renew_amount)}}"
                                        class="form-control @error('renew_amount') is-invalid @enderror"
                                        id="renew_amount"
                                        placeholder="व्यवसाय नबिकरण दर्ता गर्दा लाग्ने शुल्क"
                                        required
                                    />
                                    @error('renew_amount')
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

