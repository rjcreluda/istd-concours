<?php include('layout_top.php'); ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-5 col-md-8 col-sm-4 col-xs-12">
                <h4 class="page-title"><?php echo $title; ?></h4>
            </div>
            <div class="col-lg-7 col-sm-8 col-md-4 col-xs-12">
                <a href="#" type="button" data-toggle="modal" data-target="#exampleModal"  class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm">Ajouter Candidat(e)s</a>
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
                                    <th>No.Inscription</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Sexe</th>
                                    <th>Centre d'examen</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($candidats as $c): ?>
                                <tr>
                                <td><?php echo $c->numeroInscription(); ?></td>
                                <td><?php echo $c->nom; ?></td>
                                <td><?php echo $c->prenom; ?></td>
                                <td><?php echo $c->sexe; ?></td>
                                <td><?php echo $c->centreExamen; ?></td>
                                <td>
                                    <div class="btn-group">
                                    <a href="<?php echo route('candidats/read', $c->id); ?>">
                                        <button type="button" class="btn btn-info btnVoirProfile"><i class="fa fa-eye"></i></button>
                                    </a>
                                    <a href="#">
                                        <button  type="button" class="btn btn-warning btnVoirProfile"><i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-danger btnSupprimer" candiId="<?php echo $c->id; ?>" nom="<?php echo $c->nom; ?>" photo="<?php echo $c->imageProfile; ?>">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    </div>
                                </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.Inscription</th>
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
    </div>
</div>
<!-- /#page-wrapper -->

<?php include('modals/candidat_new.php'); ?>
<?php include('partials/footer.php'); ?>

<script src="/resources/js/vue.min.js"></script>
<script>
    
</script>

<?php include('layout_bottom.php'); ?>