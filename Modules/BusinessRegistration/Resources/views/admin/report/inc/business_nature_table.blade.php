@foreach($businessNatures as $businessNature)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$businessNature['title']}}</td>
        @foreach($businessNature['wards'] as $ward_count)
            <td>{{$ward_count}}</td>
        @endforeach
        <td>{{$businessNature['total']}}</td>
    </tr>

@endforeach
<tr>
    <td colspan="2">जम्मा</td>
    @foreach(officeSetting()->localBody->ward_no as $ward_no)
        <th>{{$businessNatures->sum('wards.'.$loop->index)}}</th>
    @endforeach
    <td>{{$businessNatures->sum('total')}}</td>
</tr>
