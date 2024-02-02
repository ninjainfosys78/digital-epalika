@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">सडक विवरण</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="http://127.0.0.1:8000/assets/backend/images/home.svg"
                                    alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="">इ-नक्सा</a>
                        </li>
                        <li class="breadcrumb-item active">सडक विवरण</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">सडक विवरण थप्नुहोस्</h4>
                        <a href="{{ route('emap.admin.streetDetail.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> सडक विवरण सूची
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0">
                <form action="{{ route('emap.admin.streetDetail.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="name" class="form-label">नाम </label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" id="name" placeholder="नाम" />
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="from" class="form-label">देखि</label>
                            <input type="text" name="from" value="{{ old('from') }}"
                                class="form-control @error('from') is-invalid @enderror" id="from"
                                placeholder="देखि" />
                            @error('from')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="to" class="form-label">सम्म</label>
                            <input type="text" name="to" value="{{ old('to') }}"
                                class="form-control @error('to') is-invalid @enderror" id="to" placeholder="सम्म" />
                            @error('to')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="setback" class="form-label">सेटब्याक</label>
                            <input type="text" name="setback" value="{{ old('setback') }}"
                                class="form-control @error('setback') is-invalid @enderror" id="setback"
                                placeholder="सेटब्याक" />
                            @error('setback')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="street_code" class="form-label">सडक कोड</label>
                            <input type="text" name="street_code" value="{{ old('street_code') }}"
                                class="form-control @error('street_code') is-invalid @enderror" id="street_code"
                                placeholder="सडक कोड" />
                            @error('street_code')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="condition" class="form-label">अवस्था</label>
                            <select name="condition" id="condition" class="form-control">
                                @foreach (Modules\EMap\Enums\RoadConditionEnum::cases() as $enum)
                                    <option value="{{ $enum->value }}">{{ $enum->label() }}</option>
                                @endforeach
                            </select>
                            @error('condition')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="wards" class="form-label">वडा</label>
                            <input type="text" name="wards" value="{{ old('wards') }}"
                                class="form-control @error('wards') is-invalid @enderror" id="wards"
                                placeholder="वडा" />
                            @error('wards')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="right_of_way" class="form-label">Right Of Way</label>
                            <input type="text" name="right_of_way" value="{{ old('right_of_way') }}"
                                class="form-control @error('right_of_way') is-invalid @enderror" id="right_of_way"
                                placeholder="Right Of Way" />
                            @error('right_of_way')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="width" class="form-label">सडकको चौडाई</label>
                            <input type="text" name="width" value="{{ old('width') }}"
                                class="form-control @error('width') is-invalid @enderror" id="width"
                                placeholder="सडकको चौडाई" />
                            @error('width')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="col-md-6 mb-2">
                            <label for="road_type" class="form-label">सडकको प्रकार </label>
                            <select name="road_type" id="road_type" class="form-control">
                                @foreach (Modules\EMap\Enums\RoadTypeEnum::cases() as $enum)
                                    <option value="{{ $enum->value }}">{{ $enum->label() }}</option>
                                @endforeach
                            </select>
                            @error('road_type')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="coordinates" class="form-label">क्षेत्र *</label>
                            <input type="hidden" name="coordinates" id="coordinates" value="{{ old('coordinates') }}">
                            @error('coordinates')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div id="map"></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/backend/css/leaflet/leaflet.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/backend/css/leaflet/leaflet.draw.css') }}" />
        <style>
            #map {
                height: 400px;
            }
        </style>
    @endpush
    @push('scripts')
        <script src="{{ asset('assets/backend/js/leaflet/leaflet.js') }}"></script>
        <script src="{{ asset('assets/backend/js/leaflet/leaflet.draw.js') }}"></script>
        <script>
            // Initialize the map
            const map = L.map('map', {
                center: new L.LatLng(28.05, 81.61667),
                zoom: 13
            });

            // Add a tile layer (you can use other providers as well)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19
            }).addTo(map);

            // Initialize the Leaflet Draw plugin for drawing shapes
            const drawnItems = new L.FeatureGroup();
            map.addLayer(drawnItems);

            const drawControl = new L.Control.Draw({
                edit: {
                    featureGroup: drawnItems
                },
                draw: {
                    marker: true, // Disable default marker
                    circle: true, // Enable circle drawing
                }
            });
            map.addControl(drawControl);

            const fieldData = document.getElementById('coordinates').value;

            if (fieldData) {
                L.geoJSON(JSON.parse(fieldData)).addTo(map);
            }

            function createEditFunction(e) {
                const layer = e.layer;
                drawnItems.addLayer(layer);

                const serializedData = [];

                // Serialize each drawn layer as GeoJSON string
                drawnItems.eachLayer(function(layer) {
                    if (layer instanceof L.Circle) {
                        // If it's a circle, calculate the radius based on the coordinates
                        const radius = layer.getRadius();
                        const center = layer.getLatLng();
                        const circleData = {
                            type: 'Feature',
                            geometry: {
                                type: 'Point',
                                coordinates: [center.lng, center.lat]
                            },
                            properties: {
                                radius: radius
                            }
                        };
                        serializedData.push(circleData);
                    } else {
                        // For other shapes (points, lines, polygons), directly serialize as GeoJSON
                        serializedData.push(layer.toGeoJSON());
                    }
                });

                // Serialize the data array as a JSON string
                document.getElementById('coordinates').value = JSON.stringify(serializedData);

            }

            map.on(L.Draw.Event.CREATED, createEditFunction);
            map.on(L.Draw.Event.EDITED, createEditFunction);
        </script>
    @endpush
@endsection
