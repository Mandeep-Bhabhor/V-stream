<x-admin.layout>
    <div class="container mt-5">
        <h1 class="text-center mb-4">All Videos</h1>

        {{-- Loading Spinner --}}
        <div id="loadingSpinner" style="display:none;" class="text-center mb-3">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Encoding...</span>
            </div>
            <p class="mt-2">Encoding in progress, please wait...</p>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Uploader ID</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Resolution</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $index => $video)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $video->title }}</td>
                            <td>{{ $video->uploader_id }}</td>
                            <td>{{ $video->duration }}</td>
                            <td>{{ $video->resolution }}</td>
                            <td>
                                <form action="{{ route('admin.encode', $video->id) }}" method="POST" class="encode-form">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Encode</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($videos->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center text-muted">No videos found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- JavaScript to handle loading spinner --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.encode-form');
            const spinner = document.getElementById('loadingSpinner');

            forms.forEach(function(form) {
                form.addEventListener('submit', function() {
                    spinner.style.display = 'block'; // Show loading spinner
                });
            });
        });
    </script>
</x-admin.layout>
