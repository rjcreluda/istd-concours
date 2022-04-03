<?php include('layout_top.php'); ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Resultats de deliberation</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/">Acceuil</a></li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <!-- .row -->
        <div class="row">
            <?php foreach($parcours as $parcour): ?>
            <div class="col-md-3 col-sm-6">
                <div class="white-box">
                    <div class="r-icon-stats">
                        <i class="ti-user bg-megna"></i>
                        <div class="bodystate">
                            <h4>
                                <a href="/deliberation/<?php echo $parcour->code; ?>">
                                    <?php echo $parcour->code; ?>
                                </a>
                            </h4>
                            <span class="text-muted">
                                <a href="#"></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>      
</div>
<!-- /#page-wrapper -->
<?php include('partials/footer.php'); ?>

<script>
    
</script>

<?php include('layout_bottom.php'); ?>