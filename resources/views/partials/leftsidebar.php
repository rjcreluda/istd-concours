<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li> <a href="/" class="waves-effect"><i class="ti-home mr-1"></i> <span class="hide-menu"> Acceuil </span></a></li>

            <li><a href="javascript:void(0);" class="waves-effect"><i class="ti-settings mr-2" data-icon="v"></i> <span class="hide-menu">Le concours<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="/parcours">Parcours</a></li>
                    <li> <a href="/matieres">Epreuves</a></li>
                    <li> <a href="/settings">Deliberation</a></li>
                </ul>
            </li>

            <li><a href="javascript:void(0);" class="waves-effect"><i class="ti-folder mr-2" data-icon="v"></i> <span class="hide-menu">Resultats<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="/resultats_brute">Brute</a></li>
                    <li> <a href="/deliberation">Deliberation</a></li>
                    <li> <a href="/resultats_final">Final</a></li>
                </ul>
            </li>

            <li class="m-l-5 font-weight-bold">EGI</li>
            <li><a href="javascript:void(0);" class="waves-effect"><i data-icon=")" class="ti-user mr-2"></i> <span class="hide-menu">Candidat(e)s EGI<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <?php 
                    $parcours_egi = \models\Parcour::where('ecole_id', '=', 1); 
                    foreach( $parcours_egi as $parc ):
                    ?>
                    <li><a href="/candidats/<?php echo $parc->code; ?>"><?php echo $parc->code; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar p-r-10"></i> <span class="hide-menu">Notes EGI<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <?php foreach( $parcours_egi as $parc):
                    ?>
                    <li><a href="/saisit_note/<?php echo $parc->code; ?>"><?php echo $parc->code; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>

            <li class="m-l-5 font-weight-bold">EGMCS</li>
            <li><a href="javascript:void(0);" class="waves-effect"><i data-icon=")" class="ti-user mr-2"></i> <span class="hide-menu">Candidat(e)s EGMCS<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <?php 
                    $parcours_egmcs = \models\Parcour::where('ecole_id', '=', 2); 
                    foreach( $parcours_egmcs as $parc ):
                    ?>
                    <li><a href="/candidats/<?php echo $parc->code; ?>"><?php echo $parc->code; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar p-r-10"></i> <span class="hide-menu">Notes EGMCS<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <?php foreach( $parcours_egmcs as $parc):
                    ?>
                    <li><a href="/saisit_note/<?php echo $parc->code; ?>"><?php echo $parc->code; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>


            <li class="m-l-5 font-weight-bold">EGCN</li>
            <li><a href="javascript:void(0);" class="waves-effect"><i data-icon=")" class="ti-user mr-2"></i> <span class="hide-menu">Candidat(e)s EGCN<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <?php 
                    $parcours_egcn = \models\Parcour::where('ecole_id', '=', 3); 
                    foreach( $parcours_egcn as $parc ):
                    ?>
                    <li><a href="/candidats/<?php echo $parc->code; ?>"><?php echo $parc->code; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="waves-effect"><i class="ti-calendar p-r-10"></i> <span class="hide-menu">Notes EGMCS<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <?php foreach( $parcours_egcn as $parc):
                    ?>
                    <li><a href="/saisit_note/<?php echo $parc->code; ?>"><?php echo $parc->code; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            
        </ul>
    </div>
</div>
