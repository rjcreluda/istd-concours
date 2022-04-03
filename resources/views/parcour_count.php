<?php include('layout_top.php'); ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Les candidats inscrits</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="acceuil"><?php echo $count; ?> Inscrits</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <?php foreach($parcours as $parcour): ?>
            <div class="col-md-3 col-sm-6">
                <div class="white-box">
                    <div class="r-icon-stats">
                        <i class="ti-user bg-megna"></i>
                        <div class="bodystate">
                            <h4>
                                <a href="<?php echo route('candidats', $parcour->code); ?>">
                                    <?php echo $parcour->code; ?>
                                </a>
                            </h4>
                            <span class="text-muted">
                                <?php echo $parcour->candidat;?>
                                inscrits
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->

<?php 
include('modals/candidat_new.php');
include('layout_bottom.php');
?>