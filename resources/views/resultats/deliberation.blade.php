@extends('layouts.app')

@section('title', 'Resultat')

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Resultats après deliberation'])
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
                    <table id="tableResultat" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Rang</th>
                                <th>Nom et prénom(s)</th>
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
    $(document).ready( function(){
        $('#parcours').change( function() {
            let parcour_id = $(this).val();
            let route = '{{ route('resultats.deliberation') }}';
            let url = route + '/' + parcour_id;
            window.location.href = url;
        });
    });
</script>
<script src="{{ asset('/resources/js/vue.min.js') }}"></script>
<script>
    const vm = new Vue({
        el: '#page-wrapper',
        data: {
            candidats: null,
            parcours: null,
            count: ''
        },
        computed: {
            count(){ return this.candidats.length; },
            candidatAdmis(){
                return this.count > 30 ? this.candidats.slice(0, 30): this.candidats;
            }
        },
        created(){
            this.candidats = <?php echo json_encode($candidats); ?>;
            this.parcours = '<?php echo $parcour->nom ?? '' ?>';
            this.count = <?php echo json_encode($count); ?>
        }
    });

    let page_title = "Resultats";
    let tableColsLen = $('#tableResultat > thead > tr >').length;
    let cols = [0,1,2];
    for(let i = 0; i < tableColsLen - 1; i++){
        if( i != 1)
            cols.push(i);
    }
    let text_head = `
                <div style="text-align: center;">
                    <p>REPOBLIKAN'I MADAGASIKARA <br>
                    Fitiavana-Tanindrazana-Fandrosoana</p>
                </div>
                <p style="width: 350px; text-align: center;">
                    MINISTERE DE L'ENSEIGNEMENT SUPERIEUR <br>
                    ET DE LA RECHERCHE SCIENTIFIQUE <br>
                    ********************* <br>
                    Institut Supérieur de Technologie d'Antsiranana <br>
                    Direction Générale
                </p>
                <div style="text-align: right;">
                    <strong>DECISION N°..../2021 - MeSupReS/SG/IST A/DG</strong> <br>
                    Portant  admission au Concours de recrutement des étudiants en première <br>
                    année à l'Institut Supérieur de Technologie d'Antsiranana (IST-D) <br>
                    pour l'année Universitaire 2020/2021. <br><br>

                </div>
                <div style="text-align: center;">
                    <strong>Parcours: ${vm.parcours}</strong>
                </div>
            `;
    $('#tableResultat').DataTable({
    pageLength: 50,
    autoWidth: true,
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'copy',
            title: page_title,
            exportOptions: {
                columns: cols
            }
        },
        {
            extend: 'excel',
            title: page_title,
            exportOptions: {
                columns: cols
            }

        },
        {
            extend: 'pdf',
            title: '',
            message: text_head,
            exportOptions: {
                columns: cols
            },
            customize: function(doc) {

                doc.styles.tableHeader.fontSize = 10;
                doc.defaultStyle.fontSize =10;
                doc.pageMargins = [50,50,50,10];
                // Styling the table: create style object
                var objLayout = {};
                // Horizontal line thickness
                objLayout['hLineWidth'] = function(i) { return .9; };
                // Vertikal line thickness
                objLayout['vLineWidth'] = function(i) { return .9; };
                // Horizontal line color
                objLayout['hLineColor'] = function(i) { return '#aaa'; };
                // Vertical line color
                objLayout['vLineColor'] = function(i) { return '#aaa'; };
                // Left padding of the cell
                objLayout['paddingLeft'] = function(i) { return 4; };
                // Right padding of the cell
                objLayout['paddingRight'] = function(i) { return 4; };
                // Inject the object in the document
                doc.content[1].layout = objLayout;
            }
        },
        {
            extend: 'print',
            exportOptions: {
                columns: [0,1,3]
            },
            title: '',
            message: text_head,
            customize: function( win ){
                let top = $('#tableResultat').offset().top + $('#tableResultat').height()
                $(win.document.body).prepend(`<div style="position:absolute; top:${top}; left:0;">Arrêté la présente listeau nombre de ${vm.count} (${vm.candidats.length})</div>`)
            }

        },
    ],

    "language": {

        "sSearch": "Recherche:",
        "sInfo": "Affiche _START_ à _END_ de _TOTAL_ candidats",

        "oPaginate":{
            "sNext": "Suivant",
            "sPrevious": "Avant"
        }

    },

    "ordering": false
});
</script>
@endsection