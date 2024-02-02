<table class="table table-striped mb-0">
    <thead>
        <tr>
            <th>क्र.सं.</th>
            <th>आर्थिक वर्ष</th>
            <th>सबममिसन नं</th>
            <th>दर्ता नं</th>
            <th>वडा नं</th>
            <th>स्थिती</th>
            <th>डेस्क</th>
            <th>Pending Days</th>
            <th>निर्माण कार्यको किसिम</th>
            <th>घर धनी</th>
            <th>आवेदन भर्ने संस्था</th>
            <th>#</th>

        </tr>
    </thead>
    <tbody>
        @forelse($maps as $mapApply)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mapApply->fiscalYear->title ?? '' }}</td>
                <td>{{ $mapApply->unique_id ?? '' }}</td>
                <td>{{ $mapApply->registration_no ?? '' }}</td>
                <td>{{ $mapApply->landDetail?->ward_no ?? '' }}</td>
                <td>{{ $mapApply->index_data['status'] ?? '' }}</td>
                <td>{{ $mapApply->index_data['desk'] ?? '' }}</td>
                <td>{{ $mapApply->index_data['pendingDays'] ?? '' }}</td>
                <td>{{ $mapApply->construction_type->label() ?? '' }}</td>
                <td>{{ $mapApply->houseOwner->name ?? ''}} , {{ $mapApply->houseOwner->address ?? ''}}</td>
                <td>{{ $mapApply->organization->name ?? '' }}</td>
                <td>
                    <div class="d-flex align-items-center gap-1">
                        {{-- @if ($mapApply->sent_to_organization == 'Accept')
                            <a href="{{ route('emap.admin.mapApply.mapRegistration.index', $mapApply) }}"
                                class="btn btn-outline-info btn-sm" style="width: 65px; height:40px;"
                                title="दर्ता गर्नुहोस्">
                                <i
                                    class="fa fa-{{ empty($mapApply->registration_no) ? 'times-circle' : 'check-circle' }}"></i>
                                दर्ता {{ empty($mapApply->registration_no) ? 'गर्नुहोस्' : 'भएको' }}
                            </a>
                        @endif --}}

                        <a href="{{ route('emap.admin.map.mapApply.mapDetail', [$mapApply, $application]) }}"
                            title="विवरण हेर्नुहोस" class="btn btn-xs btn-outline-success">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('emap.admin.mapApply.admin-step.form-list', $mapApply) }}"
                            title="नक्सा विवरण" class="btn btn-xs btn-outline-primary">
                            <i class="fa fa-step-forward"></i>
                        </a>
                    </div>
                </td>

            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="12">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
            </tr>
        @endforelse
    </tbody>
</table>
