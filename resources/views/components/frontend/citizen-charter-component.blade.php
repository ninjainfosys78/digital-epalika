<div class="row d-none">
    @foreach ($citizenCharters as $citizenCharter)
        <div class="col-md-4 mb-4">
            <div class="card border-0 h-100 mb-3">
                <div class="card-body p-4">
                    <h5 class="card-title card-title fs-5 fw-bold">
                        {{ get_nepali_number($loop->iteration) }}.{{ $citizenCharter->service }}</h5>
                    <p class="card-subtitle mb-2" style="font-size: 16px">
                        <span class="d-block" style="font-size: 13px; font-weight: 600; margin: 5px 0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-diagram-3" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                            </svg>
                            शाखा: {{ $citizenCharter->branch?->title ?? '' }}
                        </span>
                        <span class="d-block" style="font-size: 13px; font-weight: 600; margin: 5px 0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-clock" viewBox="0 0 16 16">
                                <path
                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                            </svg>
                            लाग्ने
                            समय: {{ $citizenCharter->time }}</span>

                        <span class="d-block" style="font-size: 13px; font-weight: 600; margin: 5px 0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-badge" viewBox="0 0 16 16">
                                <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path
                                    d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492z" />
                            </svg>
                            जिम्मेवार व्यक्ति:
                            {{ $citizenCharter->responsible_person }}
                        </span>
                    </p>
                    <button type="button" class="btn btn-outline-primary btn-sm mt-4" data-bs-toggle="modal"
                        data-bs-target="#exampleModal{{ $loop->iteration }}">
                        विवरण हेर्नुहोस्
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-dark" id="exampleModalLabel{{ $loop->iteration }}">
                                        {{ $citizenCharter->service }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="card-subtitle mb-2" style="font-size: 16px">
                                        <span class="d-block" style="font-size: 14px; font-weight: 600; margin: 5px 0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-diagram-3" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                                            </svg>
                                            शाखा: {{ $citizenCharter->branch?->title ?? '' }}
                                        </span>
                                        <span class="d-block" style="font-size: 14px; font-weight: 600; margin: 5px 0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                <path
                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                            </svg>
                                            लाग्ने
                                            समय: {{ $citizenCharter->time }}</span>
                                        <span class="d-block" style="font-size: 14px; font-weight: 600; margin: 5px 0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                                            </svg>
                                            सेवा शुल्क तथा दस्तुर रकम:
                                            <span class="badge text-bg-primary"
                                                style="font-size: 14px;">{{ $citizenCharter->amount }}</span>
                                        </span>
                                        <span class="d-block" style="font-size: 14px; font-weight: 600; margin: 5px 0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
                                                <path
                                                    d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                                <path
                                                    d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492z" />
                                            </svg>
                                            जिम्मेवार व्यक्ति:
                                            <span class="badge text-bg-secondary"
                                                style="font-size: 14px;">{{ $citizenCharter->responsible_person }}</span>
                                        </span>
                                    </p>
                                    <p class="card-text"
                                        style="font-size: 15px;
    font-weight: 500;
    line-height: 25px;
    text-align: justify;">
                                        {{ $citizenCharter->required_document }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<table class="table table-borderless position-relative overflow-hidden" id="marqueeTable">
    <thead class="sticky-top table-headcolor">
        <tr>
            <th scope="col">क्र.सं.</th>
            <th scope="col">शाखा</th>
            <th scope="col">सेवा</th>
            <th scope="col" width="20%">आवश्यक कागजातहरु</th>
            <th scope="col" width="20%">सेवा शुल्क तथा दस्तुर रकम</th>
            <th scope="col">लाग्ने समय</th>
            <th scope="col">जिम्मेवार व्यक्ति</th>
        </tr>
    </thead>
    <tbody class="move_table table-primary" id="marqueeRows">
        @foreach ($citizenCharters as $citizenCharter)
            <tr>
                <th scope="row">{{ get_nepali_number($loop->iteration) }}</th>
                <td>{{ $citizenCharter->branch?->title ?? '' }}</td>
                <td>{{ $citizenCharter->service }}</td>
                <td>{{ $citizenCharter->required_document }}</td>
                <td>{{ $citizenCharter->amount }}</td>
                <td>{{ $citizenCharter->time }}</td>
                <td>{{ $citizenCharter->responsible_person }}</td>
            </tr>
            <tr class="empty">
                <td></td>
            </tr>
        @endforeach

    </tbody>
</table>
@push('scripts')
    <script>
        const marqueeTable = document.getElementById('marqueeTable');
        const marqueeRows = document.getElementById('marqueeRows');
        for (let i = 0; i < 9; i++) {
            const clone = marqueeRows.cloneNode(true);
            marqueeTable.appendChild(clone);
        }
        const clonedRowsHeight = marqueeRows.clientHeight * 20;

        // Reset the scroll position to the top when the animation completes
        marqueeTable.addEventListener('animationiteration', () => {
            marqueeTable.scrollTop = 0;
        });
    </script>
@endpush

@push('styles')
    <style>
        @keyframes marquee {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-100%);
            }
        }

        .move_table {
            position: relative;
            box-sizing: border-box;
            animation: marquee {{ count($citizenCharters) <= 0 ? 10 : count($citizenCharters) * 10 }}s linear infinite;
            margin: 0 auto;
            text-align: center;
            color: var(--mainColor);
        }

        tr.empty td,
        tr.empty th {
            background-color: transparent !important;
        }

        tr td {
            background-color: #fff !important;
            text-align: justify;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        tbody tr th {
            background-color: #fff !important;
            color: #333;
        }

        thead tr th {
            background-color: #0047ab !important;
            color: #fff;
        }
    </style>
@endpush
