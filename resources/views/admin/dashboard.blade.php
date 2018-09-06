@extends('../layouts.app')

@section('content')
<div class="container">
    <h3>Admin Dashboard
    <div class="row justify-content-center">
        <div class="col-md-4 pull-left">
            <div class="card">
                <div class="card-header">Data Summary</div>
                <div class="card-body">
                    <ul>
                        <li>Total Users: {{ $totalUsers }}</li>
                        <li>Total Cities: {{ $totalCities }}</li>
                        <li>Total Jobs: {{ $totalJobs }}</li>
                        <li>Total Roles: {{ $totalRoles }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
