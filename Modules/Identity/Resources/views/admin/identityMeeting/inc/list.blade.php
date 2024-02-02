<div class="modal fade" id="print" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" width>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="header-title mb-0">अपाङ्गता परिचय पत्रहरु</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>क्र.स</th>
                                                <th>फोटो</th>
                                                <th>नाम</th>
                                                <th>लिङ्ग</th>
                                                <th>नागरिकता नं./जन्म दर्ता नं.</th>
                                                <th>अपांगता</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($disabilityIdentityCards as $disabilityIdentityCard)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ $disabilityIdentityCard->photo_url }}" height="60"
                                                            alt="{{ $disabilityIdentityCard->name }}">
                                                    </td>
                                                    <td>{{ $disabilityIdentityCard->name }}</td>
                                                    <td>{{ $disabilityIdentityCard->gender->label() ?? '' }}</td>
                                                    <td>
                                                        {{ $disabilityIdentityCard->citizenship_no? $disabilityIdentityCard->citizenship_no."(नागरिकता)" : $disabilityIdentityCard->birth_registration_no ."(जन्म दर्ता)" }}
                                                    </td>
                                                    <td>{{ $disabilityIdentityCard->disabilityType->title }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" class="btn btn-xs btn-outline-danger mt-2"
                                data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

