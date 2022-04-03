<?php include('layout_top.php'); ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <h4 class="page-title">Resultat du Concours d'entrée en <?php echo $parcour->code; ?> (deliberation)</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="box-title m-b-0">Exporter le tableau</h3>
                            <p class="text-muted m-b-30">Exporter en Copie, Excel, PDF & Impression</p>
                        </div>
                        <div class="col-md-6">
                            <div class="float-right mb-sm-3">(<?php echo count($candidats); ?> Candidats après deliberation)</div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="tableResultat" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Rang</th>
                                    <th>Numéro Inscription</th>
                                    <th>Nom et Prénom</th>
                                    <th>Centre d'examen</th>
                                    <th>Moyenne</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="c in candidatAdmis">
                                    <td>{{c.rang}}</td>
                                    <td>{{c.numInscription}}</td>
                                    <td>{{c.nom}}</td>
                                    <td>{{c.centreExamen}}</td>
                                    <td>{{ Intl.NumberFormat('fr-FR').format(c.moyenne) }}</td>
                                </tr>
                                
                            </tbody>
                            <tfoot>
                                <th>Rang</th>
                                <th>Numéro Inscription</th>
                                <th>Nom et Prénom</th>
                                <th>Centre d'examen</th>
                                <th>Moyenne</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->

<?php include('partials/footer.php'); ?>

<!-- Script section -->
<script src="/resources/js/vue.min.js"></script>
<script>
    const vm = new Vue({
        el: '#page-wrapper',
        data: {
            candidats: null,
        },
        computed: {
            count(){ return this.candidats.length; },
            candidatAdmis(){
                return this.count > 30 ? this.candidats.slice(0, 30): this.candidats;
            }
        },
        created(){
            this.candidats = <?php echo json_encode($candidats); ?>
        }
    });

    let page_title = "<?php echo $title; ?>";
    let tableColsLen = $('#tableResultat > thead > tr >').length;
    let cols = [];
    for(let i = 0; i < tableColsLen - 1; i++){
        if( i != 1)
            cols.push(i);
    }
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
            title: page_title,
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
                columns: cols
            },
            title: page_title,
            
        },
    ],

    "language": {

        "sSearch": "Recherche:",
        "sInfo": "Affiche _START_ à _END_ de _TOTAL_ entrées",
        
        "oPaginate":{
            "sNext": "Suivant",
            "sPrevious": "Avant"
        }

    },

    "ordering": false
});
</script>
<!-- / script section -->

<?php include('layout_bottom.php'); ?>
