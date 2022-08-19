@extends('layouts.app')

@section('title', 'Fiche de presence')

@section('style')
<style>
    .dt-buttons{
        display: none;
    }
</style>
@endsection

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Fiche de presence'])
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
                        @isset( $salle )
                        <span class="pr-3 pl-2">Salle</span>
                        <select name="salle_id" id="salles">
                            @foreach($salles as $s)
                            <option value="{{$s->id}}"
                            @if( $s->id == $salle->id)
                            selected
                            @endif
                            >{{ $s->reference }}</option>
                            @endforeach
                        </select>
                        @endisset
                    </div>
                    @isset( $salle )
                        <a href="{{ route('print.preview') }}?type=fiche-presence&centre_id={{$centre->id}}&salle_id={{$salle->id}}" class="btn btn-default">Imprimer la fiche</a>
                    @else
                        <a href="{{ route('print.preview') }}?type=fiche-presence&centre_id={{$centre->id}}" class="btn btn-default">Imprimer la fiche</a>
                    @endisset

                </div>
                {{-- <h3 class="box-title m-b-0">Exporter le tableau</h3>
                <p class="text-muted m-b-30">Exporter en Copie, Excel, PDF & Impression</p> --}}

                <div class="table-responsive">
                    <table id="tableData" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                @if( $concour_active->num_auto )
                                <th>No.Inscription</th>
                                @endif
                                <th>Nom et Prénom</th>
                                <th>Parcour</th>
                                <th>Emargement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidats as $c)
                            <tr>
                                @if( $concour_active->num_auto )
                                <td>{{ $c->numInscription }}</td>
                                @endif
                                <td>{{ $c->nom }} {{ $c->prenom }}</td>
                                <td>{{ $c->parcour->code }}</td>
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
                                <th>Parcour</th>
                                <th>Emargement</th>
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
            let url = window.location.origin + '/dashboard/candidats/fiche/presence' + '/' + centre_id;
            window.location.href = url;
        });

        $('#salles').change( function() {
            let salle_id = $(this).val();
            console.log(`Salle id: ${salle_id}`)
            let current_url = window.location.href;
            let sub_url = current_url.substring(0, current_url.lastIndexOf('/'))
            console.log(`Sub url: ${sub_url}`)
            let url = sub_url + '/' + salle_id;
            window.location.href = url;
        });
    </script>
@endsection