@extends('layouts.app')

@section('title', 'Salles de concours')

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Liste des salles'])
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
                                <th>Reference</th>
                                <th>Localisation</th>
                                <th>Capacité</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salles as $salle)
                            <tr>
                            <td>{{ $salle->reference }}</td>
                            <td>{{ $salle->localisation }}</td>
                            <td>{{ $salle->capacite }}</td>
                            <td>
                                @admin
                                <a href="#" data-toggle="modal" data-target="#editData-{{ $salle->id }}">
                                        <button  type="button" class="btn btn-warning btnVoirProfile"><i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-danger btnDelete" data-id="{{$salle->id}}" nom="{{$salle->reference}}" >
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <form id="form_{{$salle->id}}" method="POST" action="{{ route('salles.destroy', ['salle' => $salle->id ] ) }}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                @endadmin
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="#" data-toggle="modal" data-target="#exampleModal"  class="btn btn-success ">Ajouter une salle</a>
                </div>
                @include('salles.add')
                @foreach( $salles as $salle )
                    @include('salles.edit', ['salle' => $salle])
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
                const salle_id = $(this).attr('data-id')
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
                        document.querySelector(`#form_${salle_id}`).submit()
                    }
                })

            });
        });
    </script>
@endsection