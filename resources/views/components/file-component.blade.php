@props(['form-data-type','map-apply','form'])
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="header-title">{{$formDataType ->model?->title}}
                        थप्नुहोस्</h4>
                    <a href="javascript:void(0)"
                       route_action="{{ route('organization.admin.printTemplate',[$mapApply,$formDataType]) }}" class="btn btn-primary btn-sm printDetail">
                        <i class="fa fa-print"></i> प्रिन्ट गर्नुहोस
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(count($mapApply->appliedDocuments->where('form_data_id', $formDataType->id)) == 0)
                    <form
                        action="{{ route('organization.admin.appliedDocument.store', [$mapApply, $form, $formDataType]) }}"
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
                        action="{{ route('organization.admin.appliedDocument.update', [$mapApply, $form, $formDataType, $mapApply->appliedDocuments->where('form_id', $form->id)->sortByDesc('created_at')?->first()?->id]) }}"
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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="header-title">
                        {{$formDataType->model?->title}} विवरण
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                        <tr>
                            <th>क्र.स</th>
                            <th>फाइल</th>
                            <th>स्थिति</th>
                            <th>मिति</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mapApply->appliedDocuments?->load('appliedMapFiles','appliedDocumentStatuses')?->where('form_data_id', $formDataType->id) as $appliedDocument)
                            <tr>
                                <td>{{ get_nepali_number($loop->iteration) }}</td>
                                <td>

                                    @foreach ($appliedDocument->appliedMapFiles as $appliedMapFile)
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#view_file{{ $appliedMapFile->id }}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                        <!-- view file model pass url dynamically in the model-->
                                <div class="modal fade" id="view_file{{ $appliedMapFile->id }}" tabindex="-1" aria-labelledby="fileLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <iframe src="{{ $appliedMapFile->document_url }}" class="img-fluid" style="height: 100%; width:100%;"></iframe>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">बन्द</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                </td>
                                <td>{{$appliedDocument->status->label()}}</td>
                                <td>{{$appliedDocument->created_at->toDateString()}}</td>

                            </tr>

                            @foreach ($appliedDocument->appliedDocumentStatuses?->load('appliedMapFiles') as $status)
                            <tr style="background-color: #e8e5e5;">
                                <td style="font-weight: bold;">{{ get_nepali_number($loop->iteration) }}</td>
                                <td>    @foreach ($status->appliedMapFiles as $statusFile)
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#view_file_org{{ $statusFile->id }}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                        <!-- view file model pass url dynamically in the model-->
                                <div class="modal fade" id="view_file_org{{ $statusFile->id }}" tabindex="-1" aria-labelledby="fileLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <iframe src="{{ $statusFile->document_url }}" class="img-fluid" style="height: 100%; width:100%;"></iframe>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">बन्द</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach</td>
                                <td>{{ $status->status->label() }}</td>
                                <td>{{$status->created_at->toDateString()}}</td>

                            </tr>
                            @endforeach
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



