<x-admin.layout>


<div class="container mt-5">
    <h2 class="mb-4">User Statistics</h2>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text display-6">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Creators</h5>
                    <p class="card-text display-6">{{ $creators }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Viewers</h5>
                    <p class="card-text display-6">{{ $viewers }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</x-admin.layout>
