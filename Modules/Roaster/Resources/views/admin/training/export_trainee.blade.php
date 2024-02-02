
@if($training->form_type===\Modules\Roaster\Enums\TrainingTypeEnum::TRAINEE)
    <table>
        <tr>
            <td>क्र.सं.</td>
            <td>फोटो</td>
            <td>पुरा नाम</td>
            <td>ठेगाना</td>
            <td>नागरिता नं</td>
            <td>सम्पर्क न</td>
            <td>इमेल</td>
            <td> शैक्षिक योग्यता</td>
            <td>लिङ्ग</td>
            <td> जातीयता</td>
            <td> हालको व्यवसाय</td>
        </tr>
        @foreach($training->trainingTrainees as $trainee)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <a href="{{$trainee->model->photo_url ??''}}">
                        {{$trainee->model->photo_url ??''}}
                    </a>
                </td>
                <td>{{$trainee->model->full_name ??''}}</td>
                <td>{{$trainee->model->localBody->local_body ??''}} {{$trainee->model->ward_no ??''}} {{$trainee->model->district->district ??''}}{{$trainee->model->province->province ??''}}</td>
                <td>{{$trainee->model->citizenship_no??''}}</td>
                <td>{{$trainee->model->phone_no??''}}</td>
                <td>{{$trainee->model->email_id??''}}</td>
                <td>{{$trainee->model->qualification??''}}</td>
                <td>{{$trainee->model->gender??''}}</td>
                <td>{{$trainee->model->ethnicity->title??''}}</td>
                <td>{{$trainee->model->current_profession??''}}</td>
            </tr>
        @endforeach

    </table>
@else
    <table>
        <tr>
            <td>क्र.सं.</td>
            <td>फोटो</td>
            <td>पुरा नाम</td>
            <td>ठेगाना</td>
            <td>पद</td>
            <td>सेवा समुह</td>
            <td>सेवा अवधि</td>
            <td>सम्पर्क न</td>
            <td>इमेल</td>
            <td> शैक्षिक योग्यता</td>
        </tr>
        @foreach($training->trainingTrainees as $trainee)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <a href="{{$trainee->model->photo_url ??''}}">{{$trainee->model->photo_url ??''}}</a>
                </td>
                <td>{{$trainee->model->employee_name ??''}}</td>
                <td>{{$trainee->model->localBody->local_body ??''}} {{$trainee->model->ward_no ??''}} {{$trainee->model->district->district ??''}}{{$trainee->model->province->province ??''}}</td>
                <td>{{$trainee->model->designation->title??''}}</td>
                <td>{{$trainee->model->department->title??''}}</td>
                <td>{{$trainee->model->service_time??''}}</td>
                <td>{{$trainee->model->contact_no??''}}</td>
                <td>{{$trainee->model->email??''}}</td>
                <td>{{$trainee->model->education_qualification??''}}</td>
            </tr>
        @endforeach

    </table>
@endif

