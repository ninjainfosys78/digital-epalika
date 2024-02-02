@foreach($recommendationCategoryCounts as $recommendationCategoryCount)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$recommendationCategoryCount['title']}}</td>
        <td>{{$recommendationCategoryCount['total']}}</td>
    </tr>

@endforeach
<tr>
    <td colspan="2">जम्मा</td>
    <td>{{$recommendationCategoryCounts->sum('total')}}</td>
</tr>
