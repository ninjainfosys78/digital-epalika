<table style="border-collapse: collapse;border: 1px solid;width: 100%;">
    <thead>
    <tr>
        <th>क्र.सं.</th>
        <th>विवरण</th>
        <th>मापदण्ड अनुसार</th>
        <th>नक्सा अनुसार</th>
        <th>अनुपालन</th>
        <th>कैफियत</th>
    </tr>
    </thead>
    <tbody>
    @foreach($criteriaDetails as $criteriaDetail)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$criteriaDetail->detail->label()}}
            <td>{{$criteriaDetail->according_to_criteria}}</td>
            <td>{{$criteriaDetail->according_to_map}}</td>
            <td>{{$criteriaDetail->compliance}}</td>
            <td>{{$criteriaDetail->remarks}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
