@extends('layouts.app')

@section('title', 'Salles de concours')

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Liste des concours'])
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
                                <th>Année Univ</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($concours as $concour)
                            <tr>
                            <td>{{ $concour->anneeUniv }}</td>
                            <td>{{ $concour->status }}</td>
                            <td>
                                @admin
                                <a href="#" data-toggle="modal" data-target="#editData-{{ $concour->id }}">
                                        <button  type="button" class="btn btn-warning btnVoirProfile"><i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-danger btnDelete" data-id="{{$concour->id}}" nom="{{$concour->reference}}" >
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <form id="form_{{$concour->id}}" method="POST" action="{{ route('concours.destroy', ['concour' => $concour->id ] ) }}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                @endadmin
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="#" data-toggle="modal" data-target="#exampleModal"  class="btn btn-success ">Ajouter un nouveau concour</a>
                </div>
                @include('concours.add')
                @foreach( $concours as $concour )
                    @include('concours.edit', ['concour' => $concour])
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
                const concour_id = $(this).attr('data-id')
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
                        document.querySelector(`#form_${concour_id}`).submit()
                    }
                })

            });
        });
    </script>
@endsection