<div>
    <video controls="controls" id="myVideo" autoplay></video>
</div>

@push('scripts')
    <script>
        const videoSource = [];
        @foreach($videos as $video)
            videoSource[{{$loop->index}}] = "{{$video->video_url}}";
        @endforeach
        let i = 0; // define i
        const videoCount = videoSource.length;
        function videoPlay(videoNum) {
            const myVideo = $('#myVideo');
            if (myVideo.length === 0) {
                return;
            }
            myVideo.attr('src', videoSource[videoNum]);
            myVideo.get(0).load();
            myVideo.get(0).play();
        }
        videoPlay(i);
        $('#myVideo').on('ended', function() {
            myHandler();
        });
        function myHandler() {
            i++;
            if (i >= videoCount) {
                i = 0;
            }
            videoPlay(i);
        }
    </script>
@endpush
