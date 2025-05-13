<x-creator.layout>
<div class="container mt-5">
    <h2 class="mb-4">Upload New Video</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('creator.videos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Video Title</label>
            <input type="text" name="title" id="title" class="form-control" required maxlength="255">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Video Description</label>
            <textarea name="description" id="description" rows="4" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="video" class="form-label">Upload Video (Max: 50 MB)</label>
            <input type="file" name="video" id="video" class="form-control" accept="video/*" required>
            <small class="text-muted">Allowed formats: mp4, avi, mov, mkv</small>
        </div>

        <button type="submit" class="btn btn-success">Upload Video</button>
    </form>
</div>
<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        const fileInput = document.getElementById('video');
        const file = fileInput.files[0];

        if (file && file.size > 50 * 1024 * 1024) { // 50 MB in bytes
            e.preventDefault();
            alert('The video file must be less than 50MB.');
        }
    });
</script>

</x-creator.layout>
