@props(['form-data-type','map-apply','form'])
<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="header-title">{{$formDataType ->model?->title}}
                        थप्नुहोस्</h4>
                    <a href="javascript:void(0)"
                       route_action="{{ route('emap.admin.attach-document.print-template',[$mapApply,$form,$formDataType]) }}"
                       class="btn btn-primary btn-sm printDetail">
                        <i class="fa fa-print"></i> प्रिन्ट गर्नुहोस
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(count($mapApply->appliedDocuments->where('form_id', $form->id)?->where('form_data_id',$formDataType->id)) == 0)
                    <form
                        action="{{ route('emap.admin.appliedDocument.store', [$mapApply, $form, $formDataType]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="documents" class="form-label">फाईल*</label>
                                <input type="file" name="documents[]"
                                       class="form-control @error('documents') is-invalid @enderror"
                                       id="documents"
                                       multiple/>
                                @error('documents.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('documents')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                @else
                    <form
                        action="{{route('emap.admin.appliedDocument.update', [$mapApply, $form, $formDataType, $mapApply->appliedDocuments->where('form_id', $form->id ?? '')->sortByDesc('created_at')->first()->id]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="documents" class="form-label">फाईल*</label>
                                <input type="file" name="documents[]"
                                       class="form-control @error('documents') is-invalid @enderror"
                                       id="documents"
                                       multiple/>
                                @error('documents.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('documents')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="header-title">
                        {{$mapApply->model?->title}} विवरण
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @foreach($mapApply->appliedDocuments?->where('form_id', $form->id)?->where('form_data_id',$formDataType->id)?->load('appliedMapFiles') as $appliedDocument)
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-stripped">
                                    <thead>
                                    <tr>
                                        <th>फाइल</th>
                                        <th>स्थिति</th>
                                        <th>मिति</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            @foreach($appliedDocument->appliedMapFiles as $appliedMapFile)
                                                <a href="#"><i class="fa fa-download"></i></a>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{$appliedDocument->status->label()}}
                                        </td>
                                        <td>
                                            {{get_nepali_number($appliedDocument->created_at->toDateString())}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table table-stripped">
                                    <thead>
                                    <tr>
                                        <th>क्र.सं.</th>
                                        <th>फाइल</th>
                                        <th>स्थिति</th>
                                        <th>प्रतिक्रिया</th>
                                        <th>मिति</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($appliedDocument?->load('appliedDocumentStatuses.appliedMapFiles')?->appliedDocumentStatuses->sortByDesc('created_at') as $appliedDocumentStatus)
                                        <tr>
                                            <td>{{get_nepali_number($loop->iteration)}}</td>
                                            <td>
                                                @foreach($appliedDocument->appliedMapFiles ?? [] as $appliedMapFile)
                                                    <a href="#"><i class="fa fa-download"></i></a>
                                                @endforeach
                                            </td>
                                            <td>
                                                {{$appliedDocumentStatus->status->label() ?? ''}}
                                            </td>
                                            <td>
                                                {{$appliedDocumentStatus->comment ?? ''}}
                                            </td>
                                            <td>
                                                {{get_nepali_number($appliedDocumentStatus->created_at->toDateString()) ?? ''}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>



