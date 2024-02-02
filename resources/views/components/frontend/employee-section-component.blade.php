{{-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($employees->chunk(3) as $empChunk)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <div class="emp-section">
                    @foreach ($empChunk as $employee)
                        <div class="emp-card d-flex align-items-center p-1 rounded border">
                            <div class="flex-shrink-0">
                                <img src="{{ $employee->photo_url }}" class="rounded" alt="{{ $employee->name }}" width="100" height="120">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5>{{ $employee->name }}</h5>
                                <h6 class="text-muted">{{ $employee->designation }}</h6>
                                <h6 class="text-muted"><i class="fa fa-phone"></i> {{ $employee->phone }}</h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div> --}}

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($employees as $employee)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <div class="emp-section">
                    <div class="emp-card d-flex align-items-center p-1 rounded border bg-white border-0">
                        <div class="flex-shrink-0">
                            <img src="{{ $employee->photo_url }}" class="rounded" alt="{{ $employee->name }}"
                                width="120" height="120">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0 fw-bolder sub-header">{{ $employee->name }}</h5>
                            <h5 class="text-muted mb-0 sub-header">{{ $employee->designation }}
                                <span class="d-block"><i class="fa fa-phone"></i> {{ $employee->phone }} </span>
                                <span class="d-block"><i class="fa fa-envelope"></i> {{ $employee->email }}</span>
                            </h5>
                        </div>
                    </div>
                    <!-- <div class="bg-overlay"></div> -->
                </div>
            </div>
        @endforeach
    </div>
</div>
