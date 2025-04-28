<x-user.layouts>

    @if (session('unauthorized'))
        <div class="alert alert-danger my-2">
            {{ session('unauthorized') }}
        </div>
    @endif

    <h1 class="text-center my-4">Liked Videos</h1>

    <div class="container">
        @if ($likedVideos->isEmpty())
            <p class="text-muted text-center">You haven't liked any videos yet.</p>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($likedVideos as $video)
                    @php
                        $filename = pathinfo($video->video, PATHINFO_FILENAME);
                        $hlsPath = '/uploads/encoded/' . $filename . '/master.m3u8';
                    @endphp

                    <div class="col">
                        <div class="card h-100 shadow-sm rounded-4 border-0">
                            <div style="position: relative; width: 100%; padding-top: 56.25%; overflow: hidden; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                                <video id="liked-video-{{ $video->id }}" controls
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></video>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">{{ $filename }}</h5>
                                <p class="card-text text-muted">Uploaded by: {{ $video->uploader->name }}</p>
                                <div id="liked-quality-select-{{ $video->id }}" class="mt-2"></div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var video = document.getElementById('liked-video-{{ $video->id }}');
                            var videoSrc = "{{ $hlsPath }}";
                            var qualitySelectContainer = document.getElementById('liked-quality-select-{{ $video->id }}');

                            if (Hls.isSupported()) {
                                var hls = new Hls();
                                hls.loadSource(videoSrc);
                                hls.attachMedia(video);

                                hls.on(Hls.Events.MANIFEST_PARSED, function() {
                                    var qualities = hls.levels.map((level, index) => ({
                                        label: level.height + 'p',
                                        index: index
                                    }));

                                    var select = document.createElement('select');
                                    select.classList.add('form-select');

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

                                    select.addEventListener('change', function() {
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
        @endif
    </div>

    {{-- Include HLS.js once --}}
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

</x-user.layouts>
