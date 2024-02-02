<li class="list-item">
    @if($folder['children']->isNotEmpty())
        <button class="btn-collapse" type="button" data-bs-toggle="collapse"
                data-bs-target="#{{\Illuminate\Support\Str::slug($folder['label'] ?? 'default')}}"
                aria-expanded="false" aria-controls="{{\Illuminate\Support\Str::slug($folder['label'] ?? 'default')}}">+
        </button>
        <div class="file-handle" data-bs-folder="{{$folder['path'] ?? ''}}">
            {{Str::title(Str::replace('_', ' ', $folder['label'])) ??''}}
        </div>
        @foreach($folder['children'] as $child)
            <ul class="file-list collapse" id="{{\Illuminate\Support\Str::slug($folder['label'] ?? 'default')}}">
                @include('inc.sideFolders',['folder'=>$child])
            </ul>
        @endforeach
    @else
        <div class="file-handle text-truncate" data-bs-folder="{{$folder['path'] ?? ''}}">
            <i class="fa fa-folder font-18 align-middle me-2"></i> {{Str::title(Str::replace('_', ' ', $folder['label'])) ??''}}
        </div>
    @endif
</li>

