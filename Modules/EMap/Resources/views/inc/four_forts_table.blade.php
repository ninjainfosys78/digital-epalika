<table style="border-collapse: collapse;border: 1px solid;width: 100%;">
    <thead>
    <tr>
        <th>विवरण</th>
        <th>पूर्व</th>
        <th>दक्षिण</th>
        <th>पश्चिम</th>
        <th>उत्तर</th>
    </tr>
    </thead>
    <tbody>
    @foreach($fourForts as $fourFort)
    <tr>
        <td>{{$fourFort->detail->label()}}
        <td>{{$fourFort->east}}</td>
        <td>{{$fourFort->north}}</td>
        <td>{{$fourFort->west}}</td>
        <td>{{$fourFort->south}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
