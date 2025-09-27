@extends("layouts")

@section("content")
<div class="container mt-4">
    <h3>Leads</h3>
    <a href="" class="btn btn-success mb-3">+ Add New Lead</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company</th>
                <th>Job Title</th>
                <th>Source</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Assigned To</th>
                <th>Created By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- @forelse($leads as $lead) -->
                <tr>
                    <td>{{ $lead->id }}</td>
                    <td>{{ $lead->first_name }} {{ $lead->last_name }}</td>
                    <td>{{ $lead->email }}</td>
                    <td>{{ $lead->phone }}</td>
                    <td>{{ $lead->company_name }}</td>
                    <td>{{ $lead->job_title }}</td>
                    <td>{{ $lead->lead_source }}</td>
                    <td>
                        <span class="badge bg-info">{{ $lead->lead_status }}</span>
                    </td>
                    <td>
                        <span class="badge bg-warning">{{ ucfirst($lead->priority) }}</span>
                    </td>
                    <td>{{ optional($lead->assignedUser)->name }}</td>
                    <td>{{ optional($lead->creator)->name }}</td>
                    <td>
                        <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <!-- @empty -->
                <tr>
                    <td colspan="12" class="text-center">No leads found</td>
                </tr>
            <!-- @endforelse -->
        </tbody>
    </table>
</div>

@endsection