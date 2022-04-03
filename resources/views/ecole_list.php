<?php include('layout_top.php'); ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Listes des Utilisateurs</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a href="#" type="button" data-toggle="modal" data-target="#exampleModal"  class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm">Ajouter Candidat(e)s</a>
            </div>
            
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Exporter le tableau</h3>
                    <p class="text-muted m-b-30">Exporter en Copie, CSV, Excel, PDF & Impression</p>
                    
                    <div class="table-responsive">
                        <table id="tableUser" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($ecoles as $ecole): ?>
                                    <tr>
                                    <td><?php echo $ecole->id; ?></td>
                                    <td><?php echo $ecole->nom; ?></td>
                                    <td><?php echo $ecole->code; ?></td>
                                    </tr>
                                <?php endforeach; ?>
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
</div>
<!-- /#page-wrapper -->

<?php 
include('modals/candidat_new.php');
include('layout_bottom.php');
?>