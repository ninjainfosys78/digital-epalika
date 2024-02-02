<table class="table table-bordered">
    <thead>
    <tr>
        <th>प्रशिक्षार्थी आईडी</th>
        <th>फोटो</th>
        <th>पुरा नाम</th>
        <th>ठेगाना</th>
        <th>फोन</th>
        <th>इमेल</th>
        <th>छान्नुहोस्</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @forelse($trainees as $trainee)
        <tr>
            <td>
                {{$trainee->reference_id ?? ''}}
            </td>
            <td>
                <img src="{{$trainee->photo_url}}" height="60px;" alt="Image">
            </td>
            <td>{{$trainee->full_name ?? ''}}</td>
            <td>{{$trainee->localBody->local_body ?? ''}}-{{$trainee->ward_no}}
                , {{$trainee->district->district ?? ''}} ,{{$trainee->province->province ??''}}</td>
            <td>{{$trainee->phone_no}}</td>
            <td>{{$trainee->email_id}}</td>
            <td>

                @if($trainee->select == 'Verified')
                <span class="badge bg-success">Verified</span>
            @else
            <form
            action="{{ route('traineeOrganization.admin.trainee.updateSelectTrainee', $trainee) }}"
            method="post">
            @csrf
            @method('put')
            <div class="input-group d-flex align-items-center">
                <select class="form-select form-select-sm" name="select"
                    id="select" aria-label="Example select with button addon"
                    @if($trainee->select=='Verified') disabled @endif>
                    <option value="" disabled selected>--- छान्नुहोस् ---</option>
                    <option value="Selected"
                    {{ $trainee->select == 'Selected' ? 'selected' : '' }}>
                    Selected</option>
                <option value="Verified"
                    {{ $trainee->select == 'Verified' ? 'selected' : '' }}>Verified
                </option>

                </select>
                <button  class="btn btn-lg btn-outline-primary" type="submit"  @if($trainee->select=='Verified') disabled @endif ><i class="fa fa-paper-plane"></i></button>
            </div>

        </form>
            @endif
            </td>
            <td class="d-flex justify-center">
                @if($trainee->select != 'Verified')
                <a  href="{{route('traineeOrganization.admin.trainee.editTrainee', [$training,$trainee])}}" type="button"
                   class="btn btn-sm btn-primary">
                    <i class="fa fa-edit"></i>
                </a>
                @endif

                <a  href="{{route('traineeOrganization.admin.trainee.showTrainee',[$training,$trainee] )}}" class="btn btn-info btn-sm">
                    <i class="fa fa-eye"></i>
                </a>
                @if($trainee->select == 'Verified')
                <a  href="{{route('traineeOrganization.admin.attendance.index', [$training,$trainee])}}" type="button"
                class="btn btn-sm btn-primary">
                 <i class="fa fa-plus"></i>
             </a>
             @endif

            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8">Data not found !!!</td>
        </tr>
    @endforelse

    </tbody>
</table>
