<div class="news-slider-wrapper">
    <div class="d-flex align-items-center w-100">
        <h2>समाचार</h2>
        <marquee behavior="scroll" scrolldelay="100" scrollamount="6">
            <ul class="news-list mt-3">
                @foreach($scrollNews as $scrollNew)
                    <li>
                        {{$scrollNew->title}}
                    </li>
                @endforeach
            </ul>
        </marquee>
    </div>
</div>
