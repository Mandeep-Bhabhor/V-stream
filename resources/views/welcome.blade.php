<x-user.layouts>
    <h1 class="text-center my-4">Welcome to the Laravel Application</h1>

    <div class="container">
        <h2 class="mb-4 text-primary">Uploaded Videos</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($videos as $video)
                <div class="col">
                    <div class="card h-100 shadow-sm rounded-4 border-0">
                        <video class="card-img-top rounded-top-4" controls>
                            <source src="{{ asset($video->video) }}" alt="{{ $video->title }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                       
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-user.layouts>
