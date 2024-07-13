@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Section pour créer un nouvel utilisateur -->
        <div class="pull-left">
            <h2>Create New User</h2>
        </div>
        <!-- Bouton pour revenir à la liste des utilisateurs -->
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('users.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

<!-- Affiche les erreurs de validation, le cas échéant -->
@if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
         @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
         @endforeach
      </ul>
    </div>
@endif

<!-- Formulaire pour créer un nouvel utilisateur -->
<form method="POST" action="{{ route('users.store') }}">
    @csrf <!-- Protection contre les attaques CSRF -->
    <div class="row">
        <!-- Champ pour le nom de l'utilisateur -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" placeholder="Name" class="form-control">
                @error('name')
                <span>{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- Champ pour l'email de l'utilisateur -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email" placeholder="Email" class="form-control">
                @error('email')
                <span>{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- Champ pour le mot de passe de l'utilisateur -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" placeholder="Password" class="form-control">
                
            </div>
        </div>
        <!-- Champ pour la confirmation du mot de passe de l'utilisateur -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control">
            </div>
        </div>
        <!-- Sélection pour les rôles de l'utilisateur -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                <select name="roles[]" class="form-control" multiple="multiple">
                    @foreach ($roles as $value => $label)
                        <option value="{{ $value }}">
                            {{ $label }}
                        </option>
                     @endforeach
                </select>
            </div>
        </div>
        <!-- Bouton de soumission du formulaire -->
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </div>
    </div>
</form>

<!-- Mention du projet -->
<p class="text-center text-primary"><small>Delphine Moulin DWWM</small></p>
@endsection
