<x-user.layouts>
    <div class="container mt-5">
        <!-- Card Container -->
        <div class="card shadow mx-auto" style="max-width: 500px;">
            <div class="card-header bg-primary text-white text-center">
                <h2>Update Your Profile</h2>
            </div>
            <div class="card-body">
                <!-- Success Message -->
                @if(session()->has('success'))
                    <div class="alert alert-success text-center">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <!-- Profile Update Form -->
                <form action="{{ url('/editprofile'.'/'.$user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="name" 
                            name="name" 
                            placeholder="Enter name" 
                            value="{{ $user->name }}" 
                        />
                        <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            class="form-control" 
                            id="email" 
                            name="email" 
                            placeholder="Enter email" 
                            value="{{ $user->email }}" 
                        />
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input 
                            type="password" 
                            class="form-control" 
                            id="password" 
                            name="password" 
                            placeholder="Enter password" 
                            value="{{ $user->password }}" 
                        />
                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-pencil-square me-2"></i>Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Custom Styling -->
    <style>
        .form-label {
            font-weight: 600;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 4px rgba(13, 110, 253, 0.25);
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #084298;
            border-color: #084298;
        }
    </style>
</x-user.layouts>
