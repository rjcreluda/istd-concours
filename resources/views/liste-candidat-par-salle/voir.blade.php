@extends('layouts.app')

@section('title', 'Liste des candidats pour affichage')

@section('style')
<style>
    .dt-buttons{
        display: none;
    }
</style>
@endsection

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Liste des candidats pour affichage'])
    <!-- /.row -->
    @php
        $doc_title = 'Candidats au centres '.$centre->lieu
    @endphp
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <span class="pr-3">Choisir un centre d'examen</span>
                        <select name="centre_id" id="centres">
                            @foreach($centres as $p)
                            <option value="{{$p->id}}"
                            @if( $p->id == $centre->id)
                            selected
                            @endif
                            >{{ $p->lieu }}</option>
                            @endforeach
                        </select>
                        @isset( $parcour )
                        <span class="pr-3 pl-2">Parcours</span>
                        <select name="parcour_id" id="parcours">
                            @foreach($parcours as $p)
                            <option value="{{$p->id}}"
                            @if( $p->id == $parcour->id)
                            selected
                            @endif
                            >{{ $p->code }}</option>
                            @endforeach
                        </select>
                        @endisset
                    </div>
                    @if( isset($parcour) )
                        <a href="{{ route('print.preview') }}?type=liste-candidat&centre_id={{$centre->id}}&parcour_id={{$parcour->id}}&niveau={{ $parcour->niveau }}" class="btn btn-default">Imprimer la fiche</a>
                    @endif

                </div>
                {{-- <h3 class="box-title m-b-0">Exporter le tableau</h3>
                <p class="text-muted m-b-30">Exporter en Copie, Excel, PDF & Impression</p> --}}
                <p>Total: {{ count( $candidats) }} candidats</p>
                <div class="table-responsive">
                    <table id="tableData" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                @if( $concour_active->num_auto )
                                <th>No.Inscription</th>
                                @endif
                                <th>Nom et Prénom</th>
                                <th>Salle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidats as $c)
                            <tr>
                                @if( $concour_active->num_auto )
                                <td>{{ $c->numInscription }}</td>
                                @endif
                                <td>{{ $c->nomComplet }}</td>
                                <td>
                                    @if( $c->salle )
                                        {{ $c->salle->reference }}
                                    @endif
                                </td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                @if( $concour_active->num_auto )
                                <th>No.Inscription</th>
                                @endif
                                <th>Nom et Prénom</th>
                                <th>Salle</th>
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
        /* Selection Centre */
        $('#centres').change( function() {
            let centre_id = $(this).val();
            let current_url = window.location.href;

            let url = window.location.origin + '/dashboard/liste-candidats/voir' + '/' + centre_id;// + '?cycle=' + cycle;
            window.location.href = url;
        });

        $('#parcours').change( function() {
            let parcour_id = $(this).val();
            console.log(`Parcour id: ${parcour_id}`)
            let current_url = window.location.href;
            let sub_url = current_url.substring(0, current_url.lastIndexOf('/'))
            console.log(`Sub url: ${sub_url}`)
            let url = sub_url + '/' + parcour_id;
            window.location.href = url;
        });
    </script>
@endsection