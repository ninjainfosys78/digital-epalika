@extends('frontend.layouts.master')
@section('content')
    <div class="content-section">
        <div class="breadcrumb mt-3 d-flex">
            <div class="breadcrumb-item">
                <a class="whitespace-nowrap text-primary-500" href="{{ route('welcome') }}">ई-पालिका</a>
                <i class="fa fa-angle-double-right text-light"></i>
                <a class="ml-1 text-primary-500">हेल्प डेस्क </a>
            </div>
        </div>
        <div class="text-center mt-2 text-decoration-underline">
            <h5 class="fw-bold">सेवाहरु हेर्न सम्बन्धित शाखामा क्लिक गर्नुहोस्</h5>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card p-0">
                    <div class="card-header">
                        <div class="text-center position-relative d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold">शाखाहरु</h5>
                            <button class="btn btn-primary btn-sm float-end position-absolute top-0 end-0 resetBtn"
                                title="Reset">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        <div class="accordion mt-2" id="branches">
                            @foreach ($branches as $branch)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="branch{{ $loop->iteration }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $loop->iteration }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $loop->iteration }}">
                                            {{ $branch->branch_name }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $loop->iteration }}"
                                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="branch{{ $loop->iteration }}" data-bs-parent="#branches">
                                        <div class="accordion-body">
                                            <ul class="list-group">
                                                @forelse($branch->branches as $subBranch)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center load_data"
                                                        data-bs-url="{{ route('digitalBoard.getServices', $subBranch) }}">
                                                        <h6>{{ $loop->iteration }}. {{ $subBranch->branch_name }}</h6>
                                                        <button class="btn btn-info btn-sm text-white">सेवाहरु हेर्नुहोस्
                                                        </button>
                                                    </li>
                                                @empty
                                                    <li class="list-group-item d-flex justify-content-between align-items-center load_data"
                                                        data-bs-url="{{ route('digitalBoard.getServices', $branch) }}">
                                                        <h6> {{ $branch->branch_name }}</h6>
                                                        <button class="btn btn-info btn-sm text-white">सेवाहरु हेर्नुहोस्
                                                        </button>
                                                    </li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-info p-0">
                    <div class="card-header">
                        <div class="text-center">
                            <h6 class="fw-bold fs-5">सेवाहरु</h6>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        <ul class="list-group" id="data">
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script>
            let inactivityTime = function() {
                let time;
                window.onload = resetTimer;
                document.onmousemove = resetTimer;
                document.onkeypress = resetTimer;

                function resetData() {
                    ajaxCall('{{ route('digitalBoard.getServices') }}');
                }

                function resetTimer() {
                    clearTimeout(time);
                    time = setTimeout(resetData, 1000 * 60 * 5)
                }
            };
            $(document).ready(function() {
                ajaxCall('{{ route('digitalBoard.getServices') }}');
                inactivityTime();
            });
            $('.load_data').click(function() {
                let url = $(this).data('bs-url');
                ajaxCall(url);
            });
            $('.resetBtn').click(function() {
                ajaxCall('{{ route('digitalBoard.getServices') }}');
            });

            function ajaxCall(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        const printTo = $('#data');
                        printTo.empty();
                        data.forEach(function(item, key) {
                            let sn = key + 1;
                            let url = "{{ route('digitalBoard.service.view', ':id') }}".replace(':id', item
                                .id);
                            printTo.append(`<li class="list-group-item d-flex justify-content-between align-items-center">
                                   <h6>` + sn + `. ` + item.service_name + `</h6>
                                 <a class="btn btn-info btn-sm text-white" href="` + url + `">सेवाहरु हेर्नुहोस्</a>
                            </li>`)
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection
