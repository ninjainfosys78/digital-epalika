<table class="table">
    <thead>
    <tr>
        @foreach($values->SipharisFormField->SipharishFormFields as $fields)
            <th>{{$fields->field_name}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach(json_decode($values->value, true) as $data)
        <tr>
            @foreach($values->SipharisFormField->SipharishFormFields as $fields)
                <td>
                    @if($data[$fields->slug]['type'] == 'image')
                        <img src="{{Storage::disk('public')->url($data[$fields->slug]['value'])}}"
                             style="width: 150px;height: 150px;object-fit: contain;" alt="">

                    @else
                        {{$data[$fields->slug]['value']}}
                    @endif
                </td>
            @endforeach

        </tr>
    @endforeach
    </tbody>
</table>
