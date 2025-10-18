@extends('layouts')

@section('content')
<div class="connect-email text-center mt-5">
    <h3>Connect Your Email</h3>
    <p>Start sending and receiving emails from your account.</p>

    <!-- Button 1: Route name ব্যবহার করে -->
    <a href="{{ route('emailconnect.google') }}" class="btn btn-danger me-2">
        Connect Gmail (Route)
    </a>
    
    <!-- Button 2: Direct URL -->
    <a href="/emailconnect/google" class="btn btn-primary me-2">
        Connect Gmail (Direct)
    </a>
    
    <!-- Button 3: Working test route -->
    <a href="/test-auth-google" class="btn btn-success me-2">
        Test Google (Working)
    </a>
</div>

<!-- Debug info -->
<div class="mt-5 p-3 bg-light">
    <h5>Debug Information:</h5>
    <p>Current Route: {{ request()->route()->getName() }}</p>
    <p>EmailConnect Google Route: {{ route('emailconnect.google') }}</p>
</div>
@endsection