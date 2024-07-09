@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Titre de la page -->
        <div class="pull-left">
            <h2>Role Management</h2>
        </div>
        <!-- Bouton pour créer un nouveau rôle, visible seulement si l'utilisateur a la permission 'role-create' -->
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success btn-sm mb-2" href="{{ route('roles.create') }}"><i class="fa fa-plus"></i> Create New Role</a>
        @endcan
        </div>
    </div>
</div>

<!-- Affichage du message de succès, si disponible -->
@session('success')
    <div class="alert alert-success" role="alert"> 
        {{ $value }}
    </div>
@endsession

<!-- Tableau des rôles -->
<table class="table table-bordered">
  <tr>
     <th width="100px">No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
  <!-- Boucle pour afficher chaque rôle -->
  @foreach ($roles as $key => $role)
    <tr>
        <!-- Affiche le numéro incrémental -->
        <td>{{ ++$i }}</td>
        <!-- Affiche le nom du rôle -->
        <td>{{ $role->name }}</td>
        <!-- Actions disponibles pour chaque rôle -->
        <td>
            <!-- Lien pour afficher les détails du rôle -->
            <a class="btn btn-info btn-sm" href="{{ route('roles.show',$role->id) }}"><i class="fa-solid fa-list"></i> Show</a>
            <!-- Lien pour éditer le rôle, visible seulement si l'utilisateur a la permission 'role-edit' -->
            @can('role-edit')
                <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
            @endcan

            <!-- Formulaire pour supprimer le rôle, visible seulement si l'utilisateur a la permission 'role-delete' -->
            @can('role-delete')
            <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>
            @endcan
        </td>
    </tr>
  @endforeach
</table>

<!-- Pagination des rôles -->
{!! $roles->links('pagination::bootstrap-5') !!}

<!-- Pied de page avec un crédit -->
<!-- Mention du projet -->
<p class="text-center text-primary"><small>Delphine Moulin DWWM</small></p>
@endsection