@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.judicialCommittee.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">रसिद विवरण भर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">निवेदन फारम</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">रसिद विवरण भर्नुहोस्</h4>
                        <a href="{{ route('admin.judicialCommittee.complaintApplication.index') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list px-1"></i> निवेदन फारम सूची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form
                        action="{{ route('admin.judicialCommittee.complaintApplication.judicialReceiptBill.store', $complaintApplication) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="bill_no" class="form-label"> बिल नम्बर <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="bill_no" class="form-control"
                                    value="{{ old('bill_no', $complaintApplication->judicialReceiptBill->bill_no ?? '') }}"
                                    id="bill_no" placeholder="बिल नम्बर" />
                                @error('bill_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="entry_person" class="form-label"> रुजु गर्ने व्यक्ति <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="entry_person" class="form-control"
                                    value="{{ old('entry_person', $complaintApplication->judicialReceiptBill->entry_person ?? '') }}"
                                    id="entry_person" placeholder="प्रवेश गर्ने व्यक्ति" />
                                @error('entry_person')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="amount" class="form-label"> रकम <span class="text-danger">*</span></label>
                                <input type="number" name="amount" class="form-control"
                                    value="{{ old('amount', $complaintApplication->judicialReceiptBill->amount ?? '') }}"
                                    id="amount" placeholder="रकम" />
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component nameNe="bill_date" labelNe="बिल मिति *" nameEn="en_bill_date"
                                    labelEn="Bill Date" :editDateNe="$complaintApplication->judicialReceiptBill->bill_date ?? ''" :getTodayDate="false" />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="file" class="form-label"> फाइल </label>
                                <input type="file" name="file" class="form-control" id="file" />
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">
                                    पेश गर्नुहोस्
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
