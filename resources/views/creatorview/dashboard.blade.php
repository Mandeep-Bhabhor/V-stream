<x-creator.layout>
    
        <div class="container mt-4">
            <h3>My Uploaded Videos</h3>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Uploaded Date</th>
                        <th>Total Likes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($videos as $video)
                        <tr>
                            <td>{{ $video->title }}</td>
                            <td>{{ $video->created_at->format('d M Y') }}</td>
                            <td>{{ $video->likes_count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No videos uploaded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
 
    
</x-creator.layout>