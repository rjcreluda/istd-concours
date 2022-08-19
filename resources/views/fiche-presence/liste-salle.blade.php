@extends('layouts.app')

@section('title', 'Liste')

@section('style')
<style>
    .dt-buttons{
        display: none;
    }
</style>
@endsection

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Salles d\'examen'])
    <!-- /.row -->
    @php
        $doc_title = 'Candidats au centres '.$centre->code
    @endphp
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="box-title d-flex flex-wrap">
                    <h4 class="pr-3">Centre</h4>
                    <select name="centre_id" id="centres">
                        @foreach($centres as $p)
                        <option value="{{$p->id}}"
                        @if( $p->id == $centre->id)
                        selected
                        @endif
                        >{{ $p->lieu }}</option>
                        @endforeach
                    </select>
                </div>
                <h3 class="box-title m-b-0">Liste des salles</h3>
                {{-- <p class="text-muted m-b-30">Exporter en Copie, Excel, PDF & Impression</p> --}}

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
                            @foreach($salles as $c)
                            <tr>
                            <td>{{ $c->reference }}</td>
                            <td>{{ $c->localisation }}</td>
                            <td>{{ $c->capacite }}</td>
                            <td>
                                <div class="btn-group">
                                <a href="{{ route('fiche.centre', ['centre' => $centre, 'salle' => $c])}}" title="voir">
                                    <button type="button" class="btn btn-info btnVoirProfile"><i class="fa fa-eye"></i></button>
                                </a>
                                </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Reference</th>
                                <th>Localisation</th>
                                <th>Capacité</th>
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
        /* Selection centre */
        $('#centres').change( function() {
            let centre_id = $(this).val();
            let current_url = window.location.href;
            let url = current_url.substring(0, current_url.lastIndexOf('/')) + '/' + centre_id;
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