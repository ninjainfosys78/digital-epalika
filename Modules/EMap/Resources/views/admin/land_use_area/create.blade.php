@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">भूउपयोग क्षेत्र </h4>
                <div class="mb-3">
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
                        <li class="breadcrumb-item active">भूउपयोग क्षेत्र</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="header-title">भूउपयोग क्षेत्र थप्नुहोस्</h4>
                    <a href="{{ route('emap.admin.landUseArea.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-list"></i> भूउपयोग क्षेत्र सूची
                    </a>
                </div>
            </div>
            <div class="px-0 card-body">
                <form action="{{ route('emap.admin.landUseArea.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="title" class="form-label">शिर्षक *</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror" id="title"
                                placeholder="शिर्षक" />
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="coordinates" class="form-label">क्षेत्र *</label>
                            <input type="hidden" name="coordinates" id="coordinates" value="{{ old('coordinates') }}">
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
