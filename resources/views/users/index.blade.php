@extends('layouts.app')

@section('title', 'Utilisateurs')

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Liste des utilisateurs'])
    <!-- /.row -->
    @include('partials.message')
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="table-responsive">
                    <table id="tableData" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>login</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->login }}</td>
                            <td>{{ $user->type }}</td>
                            <td>
                                @can('edit', $user)
                                <a href="#" data-toggle="modal" data-target="#editUser-{{ $user->id }}">
                                        <button  type="button" class="btn btn-warning btnVoirProfile"><i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    @if( $user->id != auth()->user()->id )
                                    <button class="btn btn-danger btnDelete" data-id="{{$user->id}}" nom="{{$user->name}}" >
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <form id="form_{{$user->id}}" method="POST" action="{{ route('users.destroy', ['user' => $user->id ] ) }}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    @endif
                                @endcan
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="#" data-toggle="modal" data-target="#exampleModal"  class="btn btn-success ">Ajouter un utilisateur</a>
                </div>
                @include('users.add')
                @foreach( $users as $user )
                    @include('users.edit', ['user' => $user])
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('footerScript')
    @parent
    <script>
        $(document).ready( function(){
             /* Confirmation Suppression utilisateur*/
            $(document).on("click", ".btnDelete", function(){
                const nom = $(this).attr("nom");
                const user_id = $(this).attr('data-id')
                swal({
                    title: `Voulez vous vraiment supprimer cet utilisateur? ${nom}`,
                    text: "Annuler pour ne pas supprimer",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      cancelButtonText: 'Annuler',
                      confirmButtonText: 'Oui, supprimer'
                })
                .then( function(result){
                    if(result.value){
                        document.querySelector(`#form_${user_id}`).submit()
                    }
                })

            });
        });
    </script>
@endsection