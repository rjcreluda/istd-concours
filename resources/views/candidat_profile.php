<?php include('layout_top.php'); ?>

<!-- Page Content -->
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Informations</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="<?php echo $back_url; ?>" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Retour</a>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <?php if($candidat): ?>
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg">
                                <img class="thumbnail visualiser" src="/resources/img/default/default.png" width="100%" alt="img">
                            </div>
                            <div class="user-btm-box">
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r">
                                        <strong>Nom</strong>
                                        <p>
                                            <?php echo $candidat->nom; ?>
                                        </p>
                                    </div>
                                    <div class="col-md-6"><strong>Prenom</strong>
                                        <p>
                                            <?php echo $candidat->prenom; ?>
                                        </p>
                                    </div>
                                </div>
                                <hr>
               
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r"><strong>Numéro Matricule</strong>
                                        <p><?php echo $candidat->numeroInscription(); ?></p>
                                    </div>
                                    <div class="col-md-6"><strong>Sexe</strong>
                                        <p><?php echo $candidat->sexe; ?></p>
                                    </div>
                                </div>
                                       
                                <hr>
                                      
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r"><strong>Phone</strong>
                                        <p><?php echo $candidat->telephone1; ?>
                                            <br/> Madagascar</p>
                                    </div>
                                    <div class="col-md-6"><strong>Centre d'Examen</strong>
                                        <p><?php echo $candidat->centreExamen; ?>
                                    </div>
                                </div>
                                <hr>     
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                        <div class="row">
                            <div class="col-md-4 col-xs-6 b-r"> <strong>Date de Naissance</strong>
                                <br>
                                <p class="text-muted">12/12/21</p>
                            </div>
                            <div class="col-md-4 col-xs-6 b-r"> <strong>Téléphone</strong>
                                <br>
                                <p class="text-muted"><?php echo $candidat->telephone1; ?><br><?php echo $candidat->telephone2; ?></p>
                            </div>
                            <div class="col-md-4 col-xs-6 b-r"> <strong>Email</strong>
                                <br>
                                <p class="text-muted"><?php echo $candidat->email; ?></p>
                            </div>
                        </div>
                                
                        <h4 class="m-t-30">Notes</h4>
                        <hr>
                        <h5>Français <span class="pull-right">Aucon note</span></h5>
                        <div class="progress">
                           <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:'.$largeurPregressBarFr.'%;"> </div>
                        </div>
                        
                        <h5>Mathematique <span class="pull-right">Aucun note</span></h5>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:0%;"> </div>
                        </div>
                            
                           <!-- <h5>Mathematique <span class="pull-right">'.$mathematique.'/20</span></h5>
                           <div class="progress">
                               <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:'.$largeurPregressBarMath.'%;"> </div>
                           </div> -->

                            <h5>Dessin-Techno <span class="pull-right">Aucun note</span></h5>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:0%;"> </div>
                            </div>
                               
                           <!-- <h5>Dessin-Techno <span class="pull-right">'.$dessintechno.'/20</span></h5>
                           <div class="progress">
                               <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:'.$largeurPregressBarDeTech.'%;"> </div>
                           </div> -->

                            <h5>Physique <span class="pull-right">Aucun note</span></h5>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:0%;"> </div>
                            </div>
                            
                           <!-- <h5>Physique <span class="pull-right">'.$physique.'/20</span></h5>
                           <div class="progress">
                               <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:'.$largeurPregressBarPhy.'%;"> </div>
                           </div> -->
                                    
                            <h5>Test Psycho <span class="pull-right">Aucun note</span></h5>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:0%;"> </div>
                            </div>
                            <!-- <h5>Test Psycho <span class="pull-right">'.$testpsycho.'/20</span></h5>
                           <div class="progress">
                               <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:'.$largeurPregressTestPsy.'%;"> </div>
                           </div> -->
                               
                            <h4 class="m-t-30">Résultat</h4>
                            <hr>
                            <div class="stats-row">
                                <div class="stat-item">
                                    <h6>Moyenne</h6> <b>XX/20</b></div>
                                <div class="stat-item">
                                    <h6>Admission</h6> <b>en attente</b></div>
                            </div>
                            <div>
                                <div id="placeholder" class="demo-placeholder"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                    Introuvable
                <?php endif; ?>
            </div>      
</div>
<!-- /#page-wrapper -->
<?php include('partials/footer.php'); ?>

<script src="/resources/js/vue.min.js"></script>
<script>
    
</script>

<?php include('layout_bottom.php'); ?>