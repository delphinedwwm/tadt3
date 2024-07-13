@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Section pour afficher un utilisateur -->
        <div class="pull-left">
            <h2> Show User</h2>
        </div>
        <!-- Bouton pour revenir à la liste des utilisateurs -->
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Affichage du nom de l'utilisateur -->
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $user->name }}
        </div>
    </div>
    <!-- Affichage de l'email de l'utilisateur -->
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {{ $user->email }}
        </div>
    </div>
    <!-- Affichage des rôles de l'utilisateur -->
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Roles:</strong>
            <!-- Vérifie si l'utilisateur a des rôles attribués -->
            @if(!empty($user->getRoleNames()))
                <!-- Boucle pour afficher chaque rôle -->
                @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success">{{ $v }}</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
