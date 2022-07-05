@extends('layouts.app')

@section('title', $title)

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => $title])
    <!-- /.row -->
    @php
        $doc_title = 'Candidats au parcours '.$parcour->code
    @endphp
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="box-title d-flex flex-wrap">
                    <h4 class="pr-3">Voir autre parcours</h4>
                    <select name="parcour_id" id="parcours">
                        @foreach($parcours as $p)
                        <option value="{{$p->id}}"
                        @if( $p->id == $parcour->id)
                        selected
                        @endif
                        >{{ $p->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <h3 class="box-title m-b-0">Exporter le tableau</h3>
                <p class="text-muted m-b-30">Exporter en Copie, Excel, PDF & Impression</p>

                <div class="table-responsive">
                    <table id="tableData" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                @if( $concour_active->num_auto )
                                <th>No.Inscription</th>
                                @endif
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Civilité</th>
                                <th>Centre d'examen</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($parcour->candidats as $c)
                            <tr>
                                @if( $concour_active->num_auto )
                                <td>{{ $c->numInscription }}</td>
                                @endif
                            <td>{{ $c->nom }}</td>
                            <td>{{ $c->prenom }}</td>
                            <td>{{ $c->civilite }}</td>
                            <td>{{ $c->centre->lieu }}</td>
                            <td>
                                <div class="btn-group">
                                <a href="{{ route('candidats.show', ['candidat' => $c])}}">
                                    <button type="button" class="btn btn-info btnVoirProfile"><i class="fa fa-eye"></i></button>
                                </a>
                                @can('edit', $c)
                                    <a href="{{ route('candidats.edit', ['candidat' => $c->id])}}">
                                        <button  type="button" class="btn btn-warning btnVoirProfile"><i class="fa fa-pencil"></i>
                                        </button>
                                    </a>

                                    <button class="btn btn-danger btnDelete" candidat_id="{{$c->id}}" nom="{{$c->nom}}  {{$c->prenom}}" photo="{{$c->imageProfile}}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <form id="form_{{$c->id}}" method="POST" action="{{ route('candidats.destroy', ['candidat' => $c->id ] ) }}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                @endcan
                                </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Sexe</th>
                                <th>Centre d'examen</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerScript')
    @parent
    <script>
        /* Selection Parcours */
        $('#parcours').change( function() {
            let parcour_id = $(this).val();
            let current_url = window.location.href;
            let url = current_url.substring(0, current_url.lastIndexOf('/')) + '/' + parcour_id;
            window.location.href = url;
        });

        /* Confirmation Suppression candidat*/
        $(document).on("click", ".btnDelete", function(){
            const nom = $(this).attr("nom");
            const candidat_id = $(this).attr('candidat_id')
            swal({
                title: `Voulez vous vraiment supprimer cet element? #${nom}`,
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
                    document.querySelector(`#form_${candidat_id}`).submit()
                }
            })

        });
    </script>
@endsection