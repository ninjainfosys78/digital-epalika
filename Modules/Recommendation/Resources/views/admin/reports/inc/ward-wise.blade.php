@foreach($recommendationCategories as $recommendationCategory)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$recommendationCategory['title']}}</td>
        @foreach($recommendationCategory['wards'] as $ward_count)
            <td>{{$ward_count}}</td>
        @endforeach
        <td>{{$recommendationCategory['total']}}</td>
    </tr>

@endforeach
<tr>
    <td colspan="2">जम्मा</td>
    @foreach(officeSetting()->localBody->ward_no as $ward_no)
        <th>{{$recommendationCategories->sum('wards.'.$loop->index)}}</th>
    @endforeach
    <td>{{$recommendationCategories->sum('total')}}</td>
</tr>
