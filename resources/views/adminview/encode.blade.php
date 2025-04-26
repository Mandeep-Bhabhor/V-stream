<x-admin.layout>
  <div class="container mt-5">
      <h1 class="text-center mb-4">All Videos</h1>

      <div class="table-responsive">
          <table class="table table-bordered table-hover align-middle">
              <thead class="table-success">
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Title</th>
                      <th scope="col">Uploader ID</th>
                      <th scope="col">duration</th>
                      <th scope="col">resolution</th>
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
                              <form action="{{ route('admin.encode', $video->id) }}" method="POST">
                                  @csrf
                                  <button type="submit" class="btn btn-sm btn-primary">Encode</button>
                              </form>
                          </td>
                      </tr>
                  @endforeach

                  @if ($videos->isEmpty())
                      <tr>
                          <td colspan="4" class="text-center text-muted">No videos found.</td>
                      </tr>
                  @endif
              </tbody>
          </table>
      </div>
  </div>
</x-admin.layout>
