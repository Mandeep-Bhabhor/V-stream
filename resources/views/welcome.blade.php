<x-user.layouts>
    @if (session('unauthorized'))
        <div class="alert alert-danger my-2">
            {{ session('unauthorized') }}
        </div>
    @endif

    <h1 class="text-center my-4">Welcome to the Laravel Application</h1>

    <div class="container">
        <h2 class="mb-4 text-primary">Uploaded Videos</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($videos as $video)
                @php
                    $filename = pathinfo($video->video, PATHINFO_FILENAME);
                    $hlsPath = '/uploads/encoded/' . $filename . '/master.m3u8';
                @endphp

                <div class="col">
                    <div class="card h-100 shadow-sm rounded-4 border-0">
                        <div
                            style="position: relative; width: 100%; padding-top: 56.25%; overflow: hidden; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                            <video id="video-{{ $video->id }}" controls
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></video>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $filename }}</h5>
                            <p class="card-text text-muted">Uploaded by: {{ $video->uploader->name }}</p>
                            <div id="quality-select-{{ $video->id }}" class="mt-2"></div>

                            <div class="flex items-center gap-2 mt-4">
                                <form id="like-form-{{ $video->id }}" action="{{ route('like.video', $video->id) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                                <button onclick="toggleLike({{ $video->id }})"
                                    id="like-button-{{ $video->id }}"
                                    class="btn btn-sm btn-outline-primary rounded-pill">
                                    👍 Like
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Per-video Script --}}
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var video = document.getElementById('video-{{ $video->id }}');
                        var videoSrc = "{{ $hlsPath }}";
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
                                    hls.currentLevel = parseInt(this.value);
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

        {{-- Like Button Script --}}
        <script>
            function toggleLike(videoId) {
                fetch(`/toggle-like/${videoId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const btn = document.getElementById('like-button-' + videoId);
                    if (data.liked) {
                        btn.classList.remove('btn-outline-primary');
                        btn.classList.add('btn-primary');
                        btn.innerHTML = '👍 Liked';
                    } else {
                        btn.classList.remove('btn-primary');
                        btn.classList.add('btn-outline-primary');
                        btn.innerHTML = '👍 Like';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('You must login first to like.');
                    window.location.href = '/login';
                });
            }
        </script>
    </div>

    {{-- Include HLS.js --}}
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
</x-user.layouts>
