<table class="table-bordered">
    <thead>
    <tr>
        <td>क्र.सं.</td>
        <td>नाम</td>
        <td>पद</td>
        <td>हस्ताक्षर</td>
    </tr>
    </thead>
    <tbody>
    @foreach($disabilityCommittees as $disabilityCommittee)
        <tr>
            <td>{{get_nepali_number($loop->iteration)}}</td>
            <td>{{$disabilityCommittee->name}}</td>
            <td>{{$disabilityCommittee->designation}}</td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>
