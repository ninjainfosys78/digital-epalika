<table class="table table-sm mb-0 table-bordered">
    <thead>
    <tr>
        <th>क्र.स.</th>
        <th>नाम</th>
        <th>उमेर</th>
        <th>फोन</th>
        <th>ठेगाना</th>
    </tr>
    </thead>
    <tbody>
    @foreach($witnesses as $witness)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$witness->name}}</td>
            <td>{{$witness->age}}</td>
            <td>{{$witness->phone}}</td>
            <td>{{$witness->address}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
