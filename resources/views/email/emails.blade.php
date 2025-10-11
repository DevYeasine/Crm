@extends('layouts')

@section('content')
<div class="row">
    
    {{-- Main email content (list / detail) --}}
    <div class="col-md-9">
        <h3>Emails ({{ ucfirst($folder) }})</h3>
        <ul class="list-group">
            @foreach($emails as $email)
    <li class="list-group-item d-flex justify-content-between align-items-center" 
        data-bs-toggle="modal" data-bs-target="#emailModal{{ $email->id }}">
        <!-- Left: profile image -->
        <div class="email-left me-3">
            <img src="https://via.placeholder.com/40" alt="Profile" class="rounded-circle">
        </div>

        <!-- Middle: name & subject -->
        <div class="email-middle flex-grow-1">
            <div><strong>{{ $email->from_email }}</strong></div>
            <div>{{ Str::limit($email->subject, 50) }}</div>
        </div>

        <!-- Right: actions -->
        <div class="email-right text-end">
            @if($email->priority ?? false)
                <span class="badge bg-warning text-dark">Priority</span>
            @endif
        </div>
    </li>

    <!-- Modal -->
    <div class="modal fade" id="emailModal{{ $email->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $email->subject }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>From:</strong> {{ $email->from_email }}</p>
                    <p>{{ $email->body }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
        </ul>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $emails->links() }}
        </div>
    </div>
    {{-- Email module sidebar (just inside email page) --}}
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="card-header">Folders</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ route('emails.folder', 'inbox') }}">Inbox</a></li>
                <li class="list-group-item"><a href="{{ route('emails.folder', 'sent') }}">Sent</a></li>
                <li class="list-group-item"><a href="{{ route('emails.folder', 'trash') }}">Trash</a></li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">Connected Accounts</div>
            <ul class="list-group list-group-flush">
                @foreach($emailAccounts as $account)
                <li class="list-group-item">{{ $account->email }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
