<h6>बैठक विवरण.......</h6>
<table border="1" cellpadding="1" cellspacing="0" style="width:100%">
    <thead style="vertical-align: middle">
        <tr>
            <td>हस्ताक्षर</td>
            <td>क्र.सं.</td>
            <td>नाम थर</td>
            <td>पद</td>
        </tr>
    </thead>
    <tbody>
        @forelse($committees as $committee)
            <tr>
                <td></td>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $committee->name }}</td>
                <td>{{ $committee->designation }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
