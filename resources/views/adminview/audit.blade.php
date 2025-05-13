<x-admin.layout>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">User Login Audit Logs</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>User Type</th>
                        <th>Login Time</th>
                        <th>Logout Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($audits as $index => $audit)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $audit->user->name }}</td>
                            <td>{{ $audit->user->usertype }}</td>
                           <td>{{ $audit->created_at }}</td>

                            <td>{{ $audit->logout_time }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No audit logs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
       
    </div>
</x-admin.layout>
<x-slot name="title">Audit Logs</x-slot>
