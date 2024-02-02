<div>
    <div class="row">
        <div class="col-md-2">
            <img height="100" width="110" src="{{asset('images/np.png')}}">
        </div>
        <div class="col-md-8 text-center">
            @foreach ($officeHeaders as $header)
                <span
                    style="color: {{$header->font_color??'red'}}; font-size: {{$header->font_size??1}}rem; font-weight: {{$header->font??'normal'}};">
                {{$header->title??''}}
            </span>
                @if (!$loop->last)
                    <br>
                @endif
            @endforeach
            <div class="col-md-2">

            </div>
        </div>
    </div>
</div>
