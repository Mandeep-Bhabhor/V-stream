<x-admin.layout>
    <div class="container mt-5">
        <h2 class="mb-4 text-center custom-h-heading">All Creator Videos</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Creator Name</th>
                        <th>Upload Date</th>
                        <th>Total Likes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($videos as $index => $video)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $video->title }}</td>
                            <td>{{ $video->uploader->name }}</td>
                            <td>{{ $video->created_at->format('d-m-Y H:i A') }}</td>
                            <td>{{ $video->likes->count() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No videos found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin.layout>
