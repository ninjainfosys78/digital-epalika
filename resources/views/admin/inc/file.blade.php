{{--<div class="row">--}}
    @if($file['isFile'])
        <div class="col-xl-4 col-lg-6">
            <div class="card m-1 shadow-none border">
                <div class="p-2">
                    <div class="row align-items-center">
                        <div class="col-auto pe-0">
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-secondary rounded">
                                    <i class="fa {{collect($file)->has('detail') ? $file['detail']['icon'] : ''}} font-18"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col text-truncate">
                            <a class="text-muted fw-bold"> {{collect($file)->has('label') ? $file['label'] : ''}}</a>
                            <p class="mb-0 font-13">{{collect($file)->has('detail') ? $file['detail']['size'] : ''}}</p>
                        </div>
                    </div> <!-- end row -->
                </div> <!-- end .p-2-->
            </div> <!-- end col -->
        </div> <!-- end col-->
    @else
        <div class="row">
            <h5 class="mb-2 ms-2">{{collect($file)->has('label') ? \Illuminate\Support\Str::upper($file['label']) : ''}}</h5>
        </div>
    @endif
    @if(collect($file)->has('children'))
        {{--        has Child--}}
        @foreach($file['children'] as $child)
            @include('admin.inc.file', ['file' => $child])
        @endforeach
    @endif
{{--</div> <!-- end row-->--}}
