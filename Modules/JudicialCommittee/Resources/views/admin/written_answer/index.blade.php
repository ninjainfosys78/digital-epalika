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

                        <li class="breadcrumb-item active">लिखित जवाफ</li>
                    </ol>
                </div>
                <h4 class="page-title">लिखित जवाफ</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-body px-0">
                    <h5 class="card-title">
                        साक्षीहरु
                    </h5>
                    <form
                        action="{{ route('admin.judicialCommittee.complaintApplication.witness.store', $complaintApplication) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label for="name" class="form-label">नाम *</label>
                                <input type="text" id="name" name="name" placeholder="नाम"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="age" class="form-label">उमेर *</label>
                                <input type="number" min="1" id="age" name="age" placeholder="उमेर"
                                    class="form-control @error('age') is-invalid @enderror">
                                @error('age')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="phone" class="form-label">फोन *</label>
                                <input type="text" id="phone" name="phone" placeholder="फोन"
                                    class="form-control @error('phone') is-invalid @enderror">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="address" class="form-label">ठेगाना *</label>
                                <input type="text" id="address" name="address" placeholder="ठेगाना"
                                    class="form-control @error('address') is-invalid @enderror">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fa fa-save"> पेश गर्नुहोस्</i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-3">
                        <div class="table-responsive">
                            <table class="table table-sm mb-0 table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>क्र.स</th>
                                        <th>नाम</th>
                                        <th>उमेर</th>
                                        <th>फोन</th>
                                        <th>ठेगाना</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($complaintApplication->witnesses as $witness)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $witness->name }}</td>
                                            <td>{{ $witness->age }}</td>
                                            <td>{{ $witness->phone }}</td>
                                            <td>{{ $witness->address }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">लिखित जवाफ सूची</h4>
                        @can('writtenAnswer_create')
                            <a href="{{ route('admin.judicialCommittee.complaintApplication.writtenAnswer.create', $complaintApplication) }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus-circle"></i> लिखित जवाफ थप्नुहोस्
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0 table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>पेश मिति</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($complaintApplication->writtenAnswers as $writtenAnswer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $writtenAnswer->submitted_date }}</td>
                                        <td class="d-flex gap-1">
                                            @can('writtenAnswer_access')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.judicialCommittee.complaintApplication.writtenAnswer.show', [$complaintApplication, $writtenAnswer]) }}"
                                                    title="विवरण हेर्नुहोस्"
                                                    class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('writtenAnswer_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.judicialCommittee.complaintApplication.writtenAnswer.edit', [$complaintApplication, $writtenAnswer]) }}"
                                                    title="सम्पादन गर्नुहोस्"
                                                    class="btn btn-xs btn-outline-warning {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        प्रतिवादीको सम्बन्धित फोटो/फाईलहरू
                    </h5>
                    <form
                        action="{{ route('admin.judicialCommittee.complaintApplication.supportedDocument.store', $complaintApplication) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="document_name" class="form-label">फाइलको नाम *</label>
                                <input type="text" id="document_name" name="document_name" placeholder="फाइलको नाम"
                                    class="form-control @error('document_name') is-invalid @enderror">
                                @error('document_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="document" class="form-label">फाइल *</label>
                                <input type="file" id="document" name="document"
                                    class="form-control @error('document') is-invalid @enderror">
                                @error('document')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fa fa-save"> पेश गर्नुहोस्</i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-3">
                        @foreach ($complaintApplication->supportedDocuments as $supportedDocument)
                            <div class="col-md-4 mb-3">
                                <div class="card border border-info">
                                    <div class="card-header d-flex justify-content-between">
                                        <h5 class="card-title">
                                            {{ $supportedDocument->document_name }}
                                        </h5>
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('admin.file-url-download', ['file_url' => $supportedDocument->document]) }}"
                                                class="btn btn-xs btn-outline-primary mx-1">
                                                <i class="fa fa-download"></i>
                                            </a>
                                            <form
                                                action="{{ route('admin.judicialCommittee.complaintApplication.supportedDocument.destroy', [$complaintApplication, $supportedDocument]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="show_confirm btn btn-sm btn-danger ml-2">
                                                    <i class="fa fa-window-close"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if ($supportedDocument->extension === 'pdf')
                                            <iframe src="{{ $supportedDocument->document_url }}" frameborder="0"
                                                width="100%"></iframe>
                                        @elseif(in_array($supportedDocument->extension, ['png', 'jpg', 'jpeg']))
                                            <img src="{{ $supportedDocument->document_url }}" class="card-image"
                                                alt="Image" height=150px;" width="100%">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
