<tr>
    <td>1</td>
    @foreach($wardData as $data)
        <td>{{$data}}</td>
    @endforeach
    <td>{{$disabilityIdentityCards->count()}}</td>
</tr>
