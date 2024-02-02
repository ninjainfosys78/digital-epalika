@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('identity.admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">अपांगताको प्रकार</li>
                    </ol>
                </div>
                <h4 class="page-title"> अपांगताको प्रकार</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">नयाँ अपांगताको प्रकार थप्नुहोस्</h4>
                        <a href="{{ route('identity.admin.setting.governmentalDisabilityType.index') }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> अपांगताको प्रकार सुची
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <form action="{{ route('identity.admin.setting.governmentalDisabilityType.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="title" class="form-label">शिर्षक *</label>
                                <input type="text" name="title" value="{{ old('title') }}"
                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                    placeholder="शिर्षक" required />
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="title_en" class="form-label">शिर्षक (English) *</label>
                                <input type="text" name="title_en" value="{{ old('title_en') }}"
                                    class="form-control @error('title_en') is-invalid @enderror" id="title_en"
                                    placeholder="शिर्षक (English)" required />
                                @error('title_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="mb-3 xl:w-96">
                                    <label for="category">Category</label>
                                    <select name="category" id="category"
                                        class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none form-control"
                                        aria-label="Default select example" required>
                                        <option value="">Select Category</option>
                                        @foreach (\Modules\Identity\Enums\CategoryTypeEnum::cases() as $category)
                                            <option value="{{ $category->value }}"
                                                {{ old('category') == $category->value ? 'selected' : '' }}>
                                                {{ $category->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <div class="mb-3 xl:w-96">
                                    <label for="color">Card Color</label>
                                    <select name="color" id="color"
                                        class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none form-control"
                                        aria-label="Default select example" required>
                                        <option value="">Select Category</option>
                                        @foreach ($cardColors as $cardColor)
                                            <option value="{{ $cardColor->color }}"
                                                {{ old('color') == $cardColor->color ? 'selected' : '' }}>
                                                {{ $cardColor->title }} ({{ $cardColor->color }})

                                            </option>
                                        @endforeach
                                    </select>
                                    @error('color')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="header_color" class="form-label">हेडर रंग*</label>
                                <input type="color" name="header_color" value="{{ old('header_color') }}"
                                    class="form-control @error('header_color') is-invalid @enderror" id="header_color"
                                    placeholder="हेडर रंग" />
                                @error('header_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="font_color" class="form-label">फन्ट रंग *</label>
                                <input type="color" name="font_color" value="{{ old('font_color') }}"
                                    class="form-control @error('font_color') is-invalid @enderror" id="font_color"
                                    placeholder="फन्ट रंग" />
                                @error('font_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="raven_background" class="form-label">Background रंग *</label>
                                <input type="color" name="raven_background" value="{{ old('raven_background') }}"
                                    class="form-control @error('raven_background') is-invalid @enderror"
                                    id="raven_background" placeholder="Background रंग" />
                                @error('raven_background')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="position" class="form-label">स्थिति *</label>
                                <input type="number" name="position" value="{{ old('position') }}"
                                    class="form-control @error('position') is-invalid @enderror" id="position"
                                    placeholder="स्थिति" />
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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
