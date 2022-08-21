@extends('layouts.app')

@section('title', 'Juries au concours')

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Liste des juries au concours'])
    <!-- /.row -->
    @include('partials.message')
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="table-responsive">
                    <table id="tableDataJury" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom et  prénom(s)</th>
                                <th>Candidats</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($juries as $jury)
                            <tr>
                            <td>{{ $jury->id }}</td>
                            <td>{{ $jury->nom }}</td>
                            <td>{{ $jury->candidats->count() }}</td>
                            <td>
                                @admin
                                <a href="#" data-toggle="modal" data-target="#editData-{{ $jury->id }}">
                                        <button  type="button" class="btn btn-warning btnVoirProfile"><i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-danger btnDelete" data-id="{{$jury->id}}" nom="{{$jury->nom}}" >
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <form id="form_{{$jury->id}}" method="POST" action="{{ route('jury.delete', ['jury' => $jury->id ] ) }}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                @endadmin
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="#" data-toggle="modal" data-target="#exampleModal"  class="btn btn-success ">Ajouter une jury</a>
                </div>
                @include('jury.add')
                @foreach( $juries as $jury )
                    @include('jury.edit', ['jury' => $jury])
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('footerScript')
    @parent
    <script>
        $(document).ready( function(){
            $('#tableDataJury').DataTable({
                dom: 'frtip',
                "pageLength": 30,
                "language": {
                    "sSearch": "Recherche:",
                    "sInfo": "Affiche _START_ à _END_ de _TOTAL_ entrées",
                    "oPaginate":{

                        "sNext": "Suivant",
                        "sPrevious": "Avant"

                    }
                }
            });
             /* Confirmation Suppression utilisateur*/
            $(document).on("click", ".btnDelete", function(){
                const nom = $(this).attr("nom");
                const jury_id = $(this).attr('data-id')
                swal({
                    title: `Voulez vous vraiment supprimer cet element? ${nom}`,
                    text: "Annuler pour ne pas supprimer",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      cancelButtonText: 'Annuler',
                      confirmButtonText: 'Oui, supprimer'
                })
                .then( function(result){
                    if( result.value ){
                        document.querySelector(`#form_${jury_id}`).submit()
                    }
                })

            });
        });
    </script>
@endsection