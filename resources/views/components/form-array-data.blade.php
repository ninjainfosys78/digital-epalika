@props(['formdata'])
@foreach ($formdata as $key => $data)
    @if(is_array($data))
        <x-form-array-data :formdata="$data"/>
    @else
        {{ $key . ': ' . $data }} @if (!$loop->last)
            <br>
        @endif

    @endif
@endforeach
