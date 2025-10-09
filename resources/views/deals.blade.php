@extends("layouts")

@section("content")
<div class="container mt-4">
    <h3>Deals</h3>
    <a href="" class="btn btn-success mb-3">+ Add New Deal</a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Deal Name</th>
                <th>Amount</th>
                <th>Stage</th>
                <th>Probability</th>
                <th>Close Date</th>
                <th>Priority</th>
                <th>Source</th>
                <th>Lead</th>
                <th>Contact</th>
                <th>Assigned To</th>
                <th>Created By</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deals as $deal)
            <tr>
                <td>
                    {{ $deal->deal_name }}
                    @if($deal->description)
                        <br><small class="text-muted" title="{{ $deal->description }}">
                            {{ Str::limit($deal->description, 30) }}
                        </small>
                    @endif
                </td>
                <td>${{ number_format($deal->amount, 2) }}</td>
                <td>
                    <span class="badge bg-secondary">{{ ucfirst($deal->stage) }}</span>
                </td>
                <td>{{ $deal->probability ? $deal->probability . '%' : '-' }}</td>
                <td>{{ $deal->close_date ?? '-' }}</td>
                <td>
                    <span class="badge bg-{{ $deal->priority === 'high' ? 'danger' : ($deal->priority === 'low' ? 'secondary' : 'warning') }}">
                        {{ ucfirst($deal->priority) }}
                    </span>
                </td>
                <td>{{ $deal->deal_source ?? '-' }}</td>
                <td>{{ $deal->lead?->first_name ?? '-' }}</td>
                <td>{{ $deal->contact?->name ?? '-' }}</td>
                <td>{{ $deal->assignedUser?->name ?? 'Unassigned' }}</td>
                <td>{{ $deal->creator?->name ?? '-' }}</td>
                <td>{{ $deal->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
