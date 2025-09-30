@extends("layouts")

@section('content')
<div class="container">
    <h1>All Integrations</h1>
    
    <div class="row">
        @foreach($integrations as $integration)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $integration->name }}</h5>
                    <p class="card-text">
                        <strong>Type:</strong> {{ $integration->type }}<br>
                        <strong>Status:</strong> 
                        <span class="badge bg-{{ $integration->status == 'active' ? 'success' : 'secondary' }}">
                            {{ $integration->status }}
                        </span><br>
                        <strong>Tenant:</strong> {{ $integration->tenant->name }}<br>
                        <strong>Created by:</strong> {{ $integration->creator->name ?? 'N/A' }}
                    </p>
                    @if($integration->credentials)
                        <span class="badge bg-info">Connected</span>
                    @else
                        <span class="badge bg-warning">Not Connected</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection