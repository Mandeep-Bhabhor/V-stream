<x-user.layouts>
    <h1 class="text-center my-4">Welcome to the Laravel Application</h1>

    <div class="container">
        <h2 class="mb-4 text-primary">Uploaded Videos</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($videos as $video)
                @php
                    $filename = pathinfo($video->video, PATHINFO_FILENAME);
                    $hlsPath = $filename . '/master.m3u8';
                    $hlsUrl = 'http://192.168.131.214:8080/' . $hlsPath;
                @endphp

                <div class="col">
                    <div class="card h-100 shadow-sm rounded-4 border-0">
                        <div style="position: relative; width: 100%; padding-top: 56.25%; overflow: hidden; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                            <video id="video-{{ $video->id }}" controls style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></video>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $filename }}</h5>
                            <div id="quality-select-{{ $video->id }}" class="mt-2"></div>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var video = document.getElementById('video-{{ $video->id }}');
                        var videoSrc = "{{ $hlsUrl }}";
                        var qualitySelectContainer = document.getElementById('quality-select-{{ $video->id }}');

                        if (Hls.isSupported()) {
                            var hls = new Hls();
                            hls.loadSource(videoSrc);
                            hls.attachMedia(video);

                            hls.on(Hls.Events.MANIFEST_PARSED, function () {
                                var qualities = hls.levels.map((level, index) => ({
                                    label: level.height + 'p',
                                    index: index
                                }));

                                var select = document.createElement('select');
                                select.classList.add('form-select');

                                // Auto option
                                var autoOption = document.createElement('option');
                                autoOption.value = -1;
                                autoOption.textContent = 'Auto';
                                select.appendChild(autoOption);

                                qualities.forEach(q => {
                                    var option = document.createElement('option');
                                    option.value = q.index; 
                                    option.textContent = q.label;
                                    select.appendChild(option);
                                });

                                select.addEventListener('change', function () {
                                    var selectedLevel = parseInt(this.value);
                                    hls.currentLevel = selectedLevel;
                                });

                                qualitySelectContainer.appendChild(select);
                            });
                        } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                            video.src = videoSrc;
                        }
                    });
                </script>
            @endforeach
        </div>
    </div>

    {{-- Include HLS.js --}}
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
</x-user.layouts>
