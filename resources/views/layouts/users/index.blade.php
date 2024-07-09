@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success mb-2" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> Create New User</a>
        </div>
    </div>
</div>

<!-- Affiche un message de succès s'il y en a un -->
@session('success')
    <div class="alert alert-success" role="alert"> 
        {{ $value }}
    </div>
@endsession

<table class="table table-bordered">
   <tr>
       <th>No</th>
       <th>Name</th>
       <th>Email</th>
       <th>Roles</th>
       <th width="280px">Action</th>
   </tr>
   <!-- Boucle à travers les données des utilisateurs -->
   @foreach ($data as $key => $user)
    <tr>
        <td>{{ ++$i }}</td> <!-- Incrémente le compteur pour chaque utilisateur -->
        <td>{{ $user->name }}</td> <!-- Affiche le nom de l'utilisateur -->
        <td>{{ $user->email }}</td> <!-- Affiche l'email de l'utilisateur -->
        <td>
          @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
               <label class="badge bg-success">{{ $v }}</label> <!-- Affiche tous les rôles de l'utilisateur -->
            @endforeach
          @endif
        </td>
        <td>
             <!-- Liens d'action pour afficher, éditer et supprimer l'utilisateur -->
             <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}"><i class="fa-solid fa-list"></i> Show</a>
             <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
             
             <!-- Formulaire de suppression de l'utilisateur -->
             <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
              </form>
        </td>
    </tr>
   @endforeach
</table>

<!-- Affiche la pagination avec le style Bootstrap 5 -->
{!! $data->links('pagination::bootstrap-5') !!}

<!-- Mention du projet -->
<p class="text-center text-primary"><small>Delphine Moulin DWWM</small></p>
@endsection
