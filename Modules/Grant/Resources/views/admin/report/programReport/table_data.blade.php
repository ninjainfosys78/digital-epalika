@forelse($grant->grantDetails as $grantDetail)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$grantDetail->model?->name}}</td>
        <td>{{$grantDetail->model?->spouse_name}}</td>
        <td>{{$grantDetail->model?->father_name}}</td>
        <td>{{$grantDetail->model?->grandfather_name}}</td>
        <td>{{$grantDetail->model?->citizenship_no}}</td>
        <td>{{$grantDetail->model?->phone_no}}</td>
        <td>{{$grantDetail->grant?->grantOffice?->office_name}}</td>
    </tr>
@empty
    <tr>
        <td colspan="10" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
    </tr>
@endforelse

