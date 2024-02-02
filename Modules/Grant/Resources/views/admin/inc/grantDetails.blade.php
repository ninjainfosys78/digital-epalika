<table class="table table-bordered table-striped table-centered table-condensed">
    <thead>
    <tr>
        <th>अनुदानको नाम</th>
        <th>अनुदानग्रहिको नाम</th>
    </tr>
    </thead>

    <tbody>

    @foreach($grants as $grant)
        <tr>
            <td>
                {{$grant->grant->grant_program_name->name ?? ''}} ({{$grant->grant->fiscalYear->title ?? ''}})
            </td>
            <td>
                {{$grant->model->name ?? ''}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
