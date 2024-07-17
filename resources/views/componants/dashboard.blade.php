@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Tableau de bord</h2>
        </div>
    </div>
</div>
<ul class="navbar-nav ms-auto">
    <!-- Authentication Links -->
    <li class="nav-item dropdown">
        <a id="dashboardDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Manage
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dashboardDropdown">
            <a class="dropdown-item" href="{{ route('users.index') }}">Manage Users</a>
            <a class="dropdown-item" href="{{ route('roles.index') }}">Manage Role</a>
            <a class="dropdown-item" href="{{ route('categories.index') }}">Manage Category</a>
            <a class="dropdown-item" href="{{ route('questionsanswers.index') }}">Manage Question Answer</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            Hardik Savani
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>
</ul>

@endsection