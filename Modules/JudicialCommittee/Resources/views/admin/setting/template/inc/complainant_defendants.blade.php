@foreach($data as $complainantDefendant)
    <span>
        <u>{{$complainantDefendant->grandfather_name}}</u> को नाती, <u>{{$complainantDefendant->father_name}}</u> को
        छोरा/छोरी <u>{{$complainantDefendant->spouse_name}}</u> को पति/पत्नी,
        <u>{{$complainantDefendant->localBody->local_body??''}}-{{$complainantDefendant->ward_no}}
            ,{{$complainantDefendant->district->district??''}}</u> बस्ने वर्ष <u>{{$complainantDefendant->age}}</u> को
        <u>{{$complainantDefendant->name}}</u>
        {{!$loop->last ? ',' : ''}}
    </span>
@endforeach
