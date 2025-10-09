@extends("layouts")

@section("content")
<div class="container mt-4">
    <h3>Contacts</h3>
    <a href="" class="btn btn-success mb-3">+ Add New Contact</a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company</th>
                <th>Job Title</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>
                    {{ $contact->full_name }}
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone ?? '-' }}</td>
                <td>{{ $contact->company ?? '-' }}</td>
                <td>{{ $contact->job_title ?? '-' }}</td>
                <td>
                    <span class="badge bg-{{ $contact->status === 'active' ? 'success' : 'secondary' }}">
                        {{ ucfirst($contact->status) }}
                    </span>
                </td>
                <td>{{ $contact->creator?->name ?? '-' }}</td>
                <td style="white-space: nowrap;">
                    <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Are you sure you want to delete this contact?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
