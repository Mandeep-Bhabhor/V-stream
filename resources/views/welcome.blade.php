<x-user.layouts>
    <h1 class="text-center my-4">Welcome to the Laravel Application</h1>

    <div class="container">
        <h2 class="mb-4 text-primary">Uploaded Videos</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($videoFiles as $file)
                <div class="col">
                    <div class="card h-100 shadow-sm rounded-4 border-0">
                        <video class="card-img-top rounded-top-4" controls>
                            <source src="{{ asset('uploads/video/' . $file->getFilename()) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div class="card-body">
                            <h5 class="card-title">{{ $file->getFilename() }}</h5>
                            <p class="card-text text-muted">
                                Uploaded video file. Size: {{ round($file->getSize() / 1024 / 1024, 2) }} MB
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-user.layouts>
