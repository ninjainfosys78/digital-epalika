<div class="vertical-scroll">
    <div class="move">

        @foreach ($notices as $notice)
            <div class="">
                <h6 class="p-2 text-white mt-2 w-100 d-inline-flex justify-content-center align-items-center"
                    style="background-color: #0047ab">
                    {{ $notice->title }} [{{ $notice->date }}]</h6>
                <div class="files">
                    @foreach ($notice->files as $file)
                        @if (in_array($file->extension, ['jpg', 'jpeg', 'png']))
                            <img src="{{ $file->file_url }}" alt="">
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@push('styles')
    <style>
        .move {
            position: relative;
            box-sizing: border-box;
            animation: marquee {{ $notices?->pluck('files_count')?->sum() <= 0 ? 510 : $notices?->pluck('files_count')?->sum() * 35 }}s linear infinite;
            margin: 0 auto;
            text-align: center;
            color: var(--mainColor);
        }
    </style>
@endpush
