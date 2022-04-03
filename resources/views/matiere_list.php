<?php include('layout_top.php'); ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-5 col-md-8 col-sm-4 col-xs-12">
                <h4 class="page-title"><?php echo $title; ?></h4>
            </div>
            <div class="col-lg-7 col-sm-8 col-md-4 col-xs-12">
                <a href="#" type="button" data-toggle="modal" data-target="#exampleModal"  class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm">Ajouter</a>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Exporter le tableau</h3>
                    <p class="text-muted m-b-30">Exporter en Copie, Excel, PDF & Impression</p>
                    
                    <div class="table-responsive">
                        <table id="tableData" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Coefficient</th>
                                    <th>Ecole</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="matiere in data_table">
                                    <td>{{ matiere.id }}</td>
                                    <td>{{ matiere.nom }}</td>
                                    <td>{{ matiere.coefficient }}</td>
                                    <td>{{ matiere.ecole.code }}</td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="#">
                                            <button  type="button" class="btn btn-warning btnEdit"><i class="fa fa-pencil"></i>
                                            </button>
                                        </a>
                                        <button class="btn btn-danger btnDelete" :id="'data-'+matiere.id" :data="matiere.id">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Coefficient</th>
                                <th>Ecole</th>
                                <th>Action</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('modals/matiere_new.php'); ?>
</div>
<!-- /#page-wrapper -->

<?php include('partials/footer.php'); ?>

<script src="/resources/js/vue.min.js"></script>
<script src="/resources/js/axios.min.js"></script>
<script>
const postUrl = '/matieres';
const vm = new Vue({
    el: '#page-wrapper',
    data: {
        data_table: [],
        form: {
            nom: '',
            coefficient: '',
            ecole_id: undefined,
            message: 'Erreur',
            error: false
        }
    },
    methods: {
        submit(){
            axios.post(postUrl, {
                nom: this.form.nom,
                coefficient: this.form.coefficient,
                ecole_id: this.form.ecole_id
            })
            .then( response => { 
                this.form.error = false
                //console.log(response)
                this.data_table.push(response.data);
                this.toggleModal()
            } )
            .catch( error => { 
                this.form.message = error
                this.form.error = true
                console.log('Erreur: ', error)
            } );
        },
        delete( matiere ){
            console.log('Deleting Matiere: #',matiere)
            axios.post('/matieres/delete', {
                id: matiere
            })
            .then( response => { 
                //this.form.error = false
                console.log(response)
                alert('Success')
            } )
            .catch( error => { 
                this.form.message = error
                this.form.error = true
                console.log('Erreur: ', error)
            } );
        },
        toggleModal(){ $(this.$refs.modal).modal('toggle') }
    },
    created(){
        this.data_table = <?php echo json_encode($matieres); ?>
    }
});
/*=============================================
SUPPRESSION D'UN ELEMENT
=============================================*/
$(document).on("click", ".btnDelete", function(){

    const data = $(this).attr("data");

    swal({
        title: `Voulez vous vraiment supprimer cet element? #${data}`,
        text: "Annuler pour ne pas supprimer",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Annuler',
          confirmButtonText: 'Oui, supprimer'
        }).then(function(result){
            if(result.value){
                vm.delete(data)
            }
    })

});
</script>

<?php include('layout_bottom.php'); ?>