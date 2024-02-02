<span id="unicode{{$id}}"></span>
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#unicode{{$id}}").html(NepaliFunctions.ConvertToUnicode({{$number}}))
        });
    </script>
@endpush

