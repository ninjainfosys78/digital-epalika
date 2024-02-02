@extends('emap::organization.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $formDataType->model?->title }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ $formDataType->model?->title }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0"></h4>
                      <span>
                          <button class="btn btn-sm btn-info"
                                  onclick="printJS({
                        printable: 'printData',
                        targetStyles: ['*'],
                        ignoreElements:['ignore-header'],
                        type: 'html'
                        })">
                              <i class="fa fa-print"></i> प्रिन्ट गर्नुहोस
                          </button>

                          <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                  data-bs-target="#status_model">
                              <i class="fa fa-file"></i> फाईल राख्नुहोस
                          </button>
                      </span>
                        <div class="modal fade" id="status_model" tabindex="-1" aria-labelledby="statusLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="statusLabel">नयाँ फाईल राख्नुहोस</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <form method="POST" enctype="multipart/form-data" action="{{ route('organization.admin.uploadFormStoreDocument',$formStore) }}">
                                            @csrf
                                            @method('put')

                                            <div class="mb-3">
                                                <label for="document" class="form-label">फाईल *</label>
                                                <input type="file" name="document"
                                                       class="form-control @error('document') is-invalid @enderror" id="document"
                                                        />
                                                @error('document')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">बन्द</button>
                                                <button type="submit" class="btn btn-primary">पेश गर्नुहोस्</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="printData">
                    {!! $template !!}
                </div>
            </div>
        </div>
    </div>
@endsection
