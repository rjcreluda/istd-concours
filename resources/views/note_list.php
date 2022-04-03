<?php include('layout_top.php'); ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?php echo $title.' en '.$parcour->code; ?></h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a href="#" type="button" data-toggle="modal" data-target="#exampleModal"  class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm">Saisir les notes</a>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if($notes): ?>
                <div class="white-box">
                    <h3 class="box-title m-b-0">Exporter le tableau</h3>
                    <p class="text-muted m-b-30">Exporter en Copie, CSV, Excel, PDF & Impression</p>
                    
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
                                <?php //foreach($matieres as $c): ?>
                                <tr v-for="matiere in data_table">
                                    <td>{{ matiere.id }}</td>
                                    <td>{{ matiere.nom }}</td>
                                    <td>{{ matiere.coefficient }}</td>
                                    <td>{{ matiere.ecole.code }}</td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="#">
                                            <button  type="button" class="btn btn-warning btnVoirProfile"><i class="fa fa-pencil"></i>
                                            </button>
                                        </a>
                                        <button class="btn btn-danger btnSupprimer" :id="matiere.id" :nom="matiere.nom">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        </div>
                                    </td>
                                <!-- <td><?php //echo $c->id; ?></td>
                                <td><?php //echo $c->nom; ?></td>
                                <td><?php //echo $c->coefficient; ?></td>
                                <td><?php //echo $c->code; ?></td>
                                <td>
                                    <div class="btn-group">
                                    <a href="#">
                                        <button  type="button" class="btn btn-warning btnVoirProfile"><i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-danger btnSupprimer" id="<?php //echo $c->id; ?>" nom="<?php //echo $c->nom; ?>">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    </div>
                                </td> -->
                                </tr>
                                <?php //endforeach; ?>
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
                <?php else: ?>
                    Aucun données, veuillez <a href="/saisit_note/<?php echo $parcour->code; ?>">saisir les notes</a>.
                <?php endif; ?>
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
            toggleModal(){ $(this.$refs.modal).modal('toggle') }
        },
        created(){
            this.data_table = <?php echo json_encode($notes); ?>
        }
    });
</script>

<?php include('layout_bottom.php'); ?>