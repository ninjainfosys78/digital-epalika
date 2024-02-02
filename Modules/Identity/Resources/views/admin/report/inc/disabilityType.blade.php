@foreach($disabilityTypes as $disabilityType)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$disabilityType['title']}}</td>
        @foreach($disabilityType['wards'] as $ward_count)
            <td>{{$ward_count}}</td>
        @endforeach
        <td>{{$disabilityType['total']}}</td>
    </tr>

@endforeach
<tr>
    <td colspan="2">जम्मा</td>
    @foreach(officeSetting()->localBody->ward_no as $ward_no)
        <th>{{$disabilityTypes->sum('wards.'.$loop->index)}}</th>
    @endforeach
    <td>{{$disabilityTypes->sum('total')}}</td>
</tr>
