@extends("layouts")

@section("content")
<div class="container mt-4">
    <h3>Leads</h3>
    <a href="" class="btn btn-success mb-3">+ Add New Lead</a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company</th>
                <th>Source</th> <!-- New -->
                <th>Status</th>
                <th>Priority</th>
                <th>Assigned To</th>
                <th>Created At</th>
                <th>Notes</th> <!-- New -->
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $lead)
            <tr>
                <td>{{ $lead->first_name }} {{ $lead->last_name }}</td>
                <td>{{ $lead->email }}</td>
                <td>{{ $lead->phone }}</td>
                <td>{{ $lead->company_name }}</td>
                <td>{{ $lead->lead_source ?? '-' }}</td> <!-- New -->
                <td>
                    <span class="badge bg-info text-dark">{{ ucfirst($lead->lead_status) }}</span>
                </td>
                <td>
                    <span class="badge bg-{{ $lead->priority === 'high' ? 'danger' : ($lead->priority === 'low' ? 'secondary' : 'warning') }}">
                        {{ ucfirst($lead->priority) }}
                    </span>
                </td>
                <td>{{ $lead->assignedTo?->name ?? 'Unassigned' }}</td>
                <td>{{ $lead->created_at->format('Y-m-d') }}</td>
                <td>
                    @if($lead->notes)
                        <span title="{{ $lead->notes }}">{{ Str::limit($lead->notes, 30) }}</span>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
</table>

</div>

@endsection