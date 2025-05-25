 <x-creator.layout>
    <div class="container mt-4">
        <h3 class="text-light mb-4 "><i class="bi bi-collection-play-fill me-2 text-success"></i>My Uploaded Videos</h3>

        <div class="table-responsive">
            <table class="table table-hover table-dark table-borderless rounded shadow-sm overflow-hidden">
                <thead class="table-danger text-center">
                    <tr>
                        <th scope="col"><i class="bi bi-film"></i> Title</th>
                        <th scope="col"><i class="bi bi-calendar-date"></i> Uploaded Date</th>
                        <th scope="col"><i class="bi bi-hand-thumbs-up"></i> Total Likes</th>
                    </tr>
                </thead>
                <tbody class="text-light text-center align-middle">
                    @forelse ($videos as $video)
                        <tr>
                            <td>{{ $video->title }}</td>
                            <td>{{ $video->created_at->format('d M Y') }}</td>
                            <td>{{ $video->likes_count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted">No videos uploaded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-creator.layout>
