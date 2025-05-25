<x-user.layouts>
    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="mx-auto">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg">
                        <div class="card-header bg-danger text-white text-center">
                            <h2 class="mb-0">Welcome to the Login Page</h2>
                        </div>
                        <div class="card-body p-4">
                            <!-- Success Message -->
                            @if(session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session()->get('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <!-- Login Form -->
                            <form action="ulogin" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" />
                                    <small class="text-danger">@error('email'){{ $message }}@enderror</small>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" />
                                    <small class="text-danger">@error('password'){{ $message }}@enderror</small>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-outline-danger btn-block">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user.layouts>
