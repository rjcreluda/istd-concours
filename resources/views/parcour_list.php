<?php include('layout_top.php'); ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Listes des Parcours</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a href="#" type="button" data-toggle="modal" data-target="#exampleModal"  class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm" @click="alert('click')">Ajouter Parcours</a>
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
                                    <th>Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <tr v-for="parcour in data_table">
                                    <td>{{ parcour.id }}</td>
                                    <td>{{ parcour.nom }}</td>
                                    <td>{{ parcour.code }}</td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="#">
                                            <button  type="button" class="btn btn-warning btnEdit" @click="edit(parcour)" data-toggle="modal" data-target="#exampleModal"  class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm"><i class="fa fa-pencil"></i>
                                            </button>
                                        </a>
                                        <button class="btn btn-danger btnDelete" :id="'data-'+parcour.id" :data="parcour.id">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        </div>
                                    </td>
                                    </tr>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Code</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('modals/parcours_new.php'); ?>
</div>
<!-- /#page-wrapper -->
<?php include('partials/footer.php'); ?>

<script src="/resources/js/vue.min.js"></script>
<script src="/resources/js/axios.min.js"></script>
<script>

const vm = new Vue({
    el: '#page-wrapper',
    data: {
        data_table: [],
        form: {
            id: 0,
            nom: '',
            ecole_id: undefined,
            code: '',
            message: '',
            error: false,
            buttonText: 'Ajouter'
        }
    },
    methods: {
        edit(parcour){
            this.form.id = parcour.id;
            this.form.nom = parcour.nom;
            this.form.ecole_id = parcour.ecole_id;
            this.form.code = parcour.code;
            this.form.buttonText = 'Mettre à jour'
        },
        submit(){
            alert('submit')
            let postUrl, data;
            if( this.form.id != 0 ){
                postUrl = '/parcours/update';
                data = {
                    id: this.form.id,
                    nom: this.form.nom,
                    code: this.form.code,
                    ecole_id: this.form.ecole_id
                }
            }
            else{
                postUrl = '/parcours';
                data = {
                    nom: this.form.nom,
                    code: this.form.code,
                    ecole_id: this.form.ecole_id
                }
            }
            axios.post(postUrl, data)
            .then( response => { 
                //this.form.error = false
                this.form.message = response
                console.log(response.data)
                if( this.form.id != 0 ){
                    this.form.id = 0
                }
                else{
                    this.data_table.push(response.data);
                }
                
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
            axios.post('/parcours/delete', {
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
        this.data_table = <?php echo json_encode($parcours); ?>
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