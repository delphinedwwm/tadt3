@extends('layouts.app')

@section('content')
<div class="container my-4">
    <ul class="navbar-nav ms-auto d-flex flex-row gap-3">
        <!-- Static Links -->
        <li class="nav-item">
            <a class="nav-link btn btn-outline-primary" href="{{ route('users.index') }}">
                <i class="bi bi-people"></i> Manage Users
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-outline-primary" href="{{ route('roles.index') }}">
                <i class="bi bi-shield-lock"></i> Manage Role
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-outline-primary" href="{{ route('categories.index') }}">
                <i class="bi bi-tags"></i> Manage Category
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-outline-primary" href="{{ route('questionsanswers.index') }}">
                <i class="bi bi-question-circle"></i> Manage Question Answer
            </a>
        </li>

        <!-- User Info -->
        <li class="nav-item d-flex align-items-center">
            <span class="nav-link text-secondary">
                <i class="bi bi-person-circle"></i> {{ Auth::user()->last_name }}
            </span>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-outline-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>
@endsection
