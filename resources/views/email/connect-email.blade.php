@extends('layouts')

@section('content')
<div class="connect-email text-center mt-5">
    <h3>Connect Your Email</h3>
    <p>Start sending and receiving emails from your account.</p>

    <a href="{{ route('email.connect', ['provider'=>'gmail']) }}" class="btn btn-danger me-2">
        Connect Gmail
    </a>
    <a href="{{ route('email.connect', ['provider'=>'outlook']) }}" class="btn btn-primary">
        Connect Outlook
    </a>
</div>
@endsection
