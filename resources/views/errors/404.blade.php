@extends('layouts.app')

@section('content')
<style>
    /* Fade-in animation */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px);}
        to   { opacity: 1; transform: translateY(0);}
    }
    .fade-in {
        animation: fadeInUp 1s cubic-bezier(.4,0,.2,1) forwards;
    }
    .delay-1 { animation-delay: .2s;}
    .delay-2 { animation-delay: .4s;}
    .delay-3 { animation-delay: .6s;}
    .delay-4 { animation-delay: .8s;}
    /* Floating effect for illustration */
    @keyframes float {
        0%, 100% { transform: translateY(0);}
        50% { transform: translateY(-20px);}
    }
    .float {
        animation: float 2.5s ease-in-out infinite;
    }
</style>
<div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 70vh;">
    <div class="float fade-in delay-1">
        <!-- Your SVG here -->
    </div>
    
    
    <h1 class="display-1 fw-bold mt-4 fade-in delay-2">៤០៤</h1>
    <h3 class="fw-semibold text-secondary mt-2 fade-in delay-3">Oops! Page Not Found</h3>
    <p class="text-muted mt-2 mb-4 fade-in delay-4">
        The page you are looking for doesn't exist or has been moved.
    </p>
    <a href="{{ route('customers.index') }}" class="btn btn-primary btn-lg px-5 shadow fade-in delay-4">
        Go Home
    </a>
</div>
@endsection
