@foreach($objectTransactions as $objectTransaction)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$objectTransaction['title']}}</td>
        @foreach($objectTransaction['wards'] as $ward_count)
            <td>{{$ward_count}}</td>
        @endforeach
        <td>{{$objectTransaction['total']}}</td>
    </tr>

@endforeach
<tr>
    <td colspan="2">जम्मा</td>
    @foreach(officeSetting()->localBody->ward_no as $ward_no)
        <th>{{$objectTransactions->sum('wards.'.$loop->index)}}</th>
    @endforeach
    <td>{{$objectTransactions->sum('total')}}</td>
</tr>
