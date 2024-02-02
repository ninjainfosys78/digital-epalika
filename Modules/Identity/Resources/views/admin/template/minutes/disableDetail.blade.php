<table>
    <thead>
    <tr>
        <td>क्र.सं.</td>
        <td>नाम</td>
        <td>नागरिकता/जन्मदर्ता नं</td>
        <td>वर्ग</td>
        <th>लिङ्ग</th>
    </tr>
    </thead>
    <tbody>
    @foreach($disabilityIdentityCards as $disabilityIdentityCard)
        <tr>
            <td>{{get_nepali_number($loop->iteration)}}</td>
            <td>{{ $disabilityIdentityCard->name ?? ''}}</td>
            <td>
                {{ $disabilityIdentityCard->citizenship_no
                        ? $disabilityIdentityCard->citizenship_no."(नागरिकता)"
                        : $disabilityIdentityCard->birth_registration_no ."(जन्म दर्ता)" }}
            </td>
            <td>
                {{$disabilityIdentityCard->governmentalDisabilityType->title ?? ''}}
            </td>
            <td>{{ $disabilityIdentityCard->gender->label() ?? '' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
