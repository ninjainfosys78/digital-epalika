<table style="border-collapse: collapse;border: 1px solid;width: 100%;">
    <thead>
    <tr>
        <th>क्र.सं.</th>
        <th>नाम</th>
        <th>पद</th>
        <th>फोन</th>
        <th>इमेल</th>
    </tr>
    </thead>
    <tbody>
    @foreach($meetingParticipants as $meetingParticipant)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$meetingParticipant->name}}
            <td>{{$meetingParticipant->designation}}</td>
            <td>{{$meetingParticipant->phone}}</td>
            <td>{{$meetingParticipant->email}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
