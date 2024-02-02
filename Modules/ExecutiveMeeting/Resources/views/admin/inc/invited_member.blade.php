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
    @foreach($invitedMembers as $invitedMember)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$invitedMember->name}}
            <td>{{$invitedMember->designation}}</td>
            <td>{{$invitedMember->phone}}</td>
            <td>{{$invitedMember->email}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
