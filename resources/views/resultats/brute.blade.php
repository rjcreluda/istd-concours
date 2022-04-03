@extends('layouts.app')

@section('title', 'Resultat')

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Resultats brute'])
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="box-title d-flex flex-wrap">
                    <h5 class="pr-3">Choisir un parcours</h5>
                    @if( $parcour )
                        <select name="parcour_id" id="parcours">
                            @foreach($parcours as $p)
                            <option value="{{$p->id}}"
                            @if( $p->id == $parcour->id)
                            selected
                            @endif
                            >{{ $p->nom }}</option>
                            @endforeach
                        </select>
                    @else
                        <select name="parcour_id" id="parcours">
                            <option value="">Selectionner un parcours</option>
                        @foreach($parcours as $p)
                        <option value="{{$p->id}}">{{ $p->nom }}</option>
                        @endforeach
                    </select>
                    @endif
                </div>
                @if( $candidats )
                <h3 class="box-title m-b-0">Exporter le tableau</h3>
                <p class="text-muted m-b-30">Exporter en Copie, Excel, PDF & Impression</p>

                <div class="table-responsive">
                    <table id="tableData" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Rang</th>
                                <th>Nom</th>
                                <th>Moyenne</th>
                                <th>Centre d'examen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidats as $c)
                            <tr>
                            <td>{{ $c->rang }}</td>
                            <td>{{ $c->nom }}</td>
                            <td>{{ $c->moyenne }}</td>
                            <td>{{ $c->centreExamen }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Rang</th>
                                <th>Nom</th>
                                <th>Moyenne</th>
                                <th>Centre d'examen</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @elseif ( $parcour )
                    {{-- true expr --}}
                    Résultats Non disponible pour le parcour {{ $parcour->nom }}
                @endif
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
            let route = '{{ route('resultats.brute') }}';
            let url = route + '/' + parcour_id;
            window.location.href = url;
        });
    </script>
@endsection