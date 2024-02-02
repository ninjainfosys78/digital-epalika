@foreach($governmentalDisabilityTypes as $governmentalDisabilityType)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$governmentalDisabilityType['title']}}</td>
        @foreach($governmentalDisabilityType['wards'] as $ward_count)
            <td>{{$ward_count}}</td>
        @endforeach
        <td>{{$governmentalDisabilityType['total']}}</td>
    </tr>

@endforeach
<tr>
    <td colspan="2">जम्मा</td>
    @foreach(officeSetting()->localBody->ward_no as $ward_no)
        <th>{{$governmentalDisabilityTypes->sum('wards.'.$loop->index)}}</th>
    @endforeach
    <td>{{$governmentalDisabilityTypes->sum('total')}}</td>
</tr>
