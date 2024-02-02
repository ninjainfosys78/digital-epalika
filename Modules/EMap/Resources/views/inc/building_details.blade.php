<table style="border-collapse: collapse;border: 1px solid;width: 100%;">
    <thead>
    <tr>
        <th>क्र.सं.</th>
        <th colspan="2">विवरण</th>
        <th>कैफियत</th>
    </tr>
    </thead>
    <tbody>
    @foreach($buildingDetails as $buildingDetail)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$buildingDetail->detail->label()}}
            <td>{{$buildingDetail->description}}</td>
            <td>{{$buildingDetail->remarks}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
