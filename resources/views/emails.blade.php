@extends("layouts")

@section('content')
<div class="container">
    <div class="row">
        <!-- Sidebar menu -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-light">
                    📧 Email Menu
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('email.inbox') }}" class="list-group-item list-group-item-action">
                        📥 Inbox
                    </a>
                    <a href="{{ route('email.sent') }}" class="list-group-item list-group-item-action">
                        📤 Sent
                    </a>
                    <a href="{{ route('email.draft') }}" class="list-group-item list-group-item-action">
                        📝 Draft
                    </a>
                    <a href="{{ route('email.trash') }}" class="list-group-item list-group-item-action">
                        🗑️ Trash
                    </a>
                </div>
            </div>
        </div>

        <!-- Email list content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-light">
                    Email List (e.g. Inbox)
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>From</th>
                                <th>Subject</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($emails as $email)
                                <tr>
                                    <td>{{ $email->from }}</td>
                                    <td>
                                        <a href="{{ route('email.show', $email->id) }}">
                                            {{ $email->subject }}
                                        </a>
                                    </td>
                                    <td>{{ $email->created_at->format('M d, Y h:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No emails found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
