@extends('layouts')

@section('content')

<div class="row">
    
    {{-- Main email content (list / detail) --}}
    <div class="col-md-9">
        <div class="d-flex align-items-center justify-content-between mb-3 p-2 border-bottom">
            <h4 class="mb-0">Inbox</h4>
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-primary btn-sm" id="composeBtn">
                    <i class="bi bi-pencil-square"></i> Compose
                </button>
                <input type="text" class="form-control form-control-sm" placeholder="Search emails" id="emailSearch" style="width: 200px;">
                <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Filter
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?folder=inbox">All</a></li>
                        <li><a class="dropdown-item" href="?folder=read">Read</a></li>
                        <li><a class="dropdown-item" href="?folder=unread">Unread</a></li>
                    </ul>
                </div>
                <button class="btn btn-light btn-sm">
                    <i class="bi bi-gear"></i>
                </button>
            </div>
        </div>

        @foreach($emails as $email)
            <div class="d-flex align-items-center justify-content-between p-2 border-bottom email-row 
                {{ $email->is_read == 1 ? 'unread-mail' : '' }}" 
                data-email-id="{{ $email->id }}" style="cursor:pointer;">
                
                <!-- Part 1: Profile pic + name + email -->
                <div class="d-flex align-items-center" style="width: 30%;">
                    <img src="https://ui-avatars.com/api/?name={{ $email->from_email }}" class="rounded-circle me-2" width="40" height="40">
                    <div>
                        <div class="fw-bold">{{ $email->from_email }}</div>
                        <small>{{ $email->from_name ?? 'No Name' }}</small>
                    </div>
                </div>

                <!-- Part 2: Subject + time + body preview -->
                <div style="width: 50%;">
                    <div class="fw-bold">{{ $email->subject }}</div>
                    <small class="text-muted">{{ Str::limit($email->body, 60) }}</small>
                    <div><small class="text-muted">{{ $email->created_at->format('d M, H:i') }}</small></div>
                </div>

                <!-- Part 3: Action icons -->
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-outline-success btn-sm convertBtn" data-email-id="{{ $email->id }}">
                        <i class="bi bi-diagram-3"></i>
                    </button>
                    <button class="btn btn-outline-primary btn-sm markReadBtn" data-email-id="{{ $email->id }}">
                        <i class="bi bi-envelope-open"></i>
                    </button>
                    <form action="{{ route('emails.destroy', $email->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm" type="submit">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach


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
