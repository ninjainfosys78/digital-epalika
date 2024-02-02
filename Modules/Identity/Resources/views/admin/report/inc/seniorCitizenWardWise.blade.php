<tr>
    <td>1</td>
    @foreach($wardData as $data)
        <td>{{$data}}</td>
    @endforeach
    <td>{{$seniorCitizenDetails->count()}}</td>
</tr>
