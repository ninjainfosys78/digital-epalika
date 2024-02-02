{{-- <div class="d-flex gap-4">
    <div class="main-heading text-center">
        @foreach ($headers as $header)
            <div
                style="color: {{$header->font_color??'red'}}; font-size: {{$header->font_size??1}}rem; font-weight: {{$header->font??'normal'}};">
                {{$header->title??''}}
            </div>
        @endforeach
    </div>
    @if($hasClock)
        <div class="main-date d-none d-lg-block">
            <h6><i class="fa fa-calendar"></i>
                <x-convert-to-unicode number="{{$year}}" id="today_year"></x-convert-to-unicode>
                {{$month}}
                <x-convert-to-unicode number="{{$day}}" id="today_day"></x-convert-to-unicode>
            </h6>
            <h6><i class="fa fa-clock"></i> <span id="clock-container"></span></h6>
            <h6><i class="fa fa-phone"></i> {{$officeSetting->phone??''}}</h6>
            <h6><i class="fa fa-envelope"></i> {{$officeSetting->email??''}}</h6>
        </div>
    @endif
</div> --}}


<div class="main-heading">
    <h2 class="sub-title mb-1">
        @foreach($headers as $header)
            @if($loop->first)
                    {{$header->title}}
                @else
                <span class="d-block">{{$header->title}}</span>
            @endif
        @endforeach

        </h2>
        {{-- <a class="link-btn mt-2 text-decoration-none" href="tel:{{officeSetting($ward ?? null)?->phone ?? ''}}">
            फोन नं - {{officeSetting($ward ?? null)?->phone ?? ''}}
        </a> --}}
</div>
