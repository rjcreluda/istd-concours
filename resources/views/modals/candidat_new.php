<!-- Formulaire Ajouter Candidat Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="white-box">
                <h3 class="box-title m-b-0">Ajouter un(e) candidat(e)</h3>
                <p class="text-muted m-b-30 font-13"> Veuillez remplir le formulaire </p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form role="form" method="POST" enctype="multipart/form-data" action="/candidats">
                            <input type="hidden" name="from" value="<?php echo $from_url;?>">
                            <div class="form-group">
                                <label for="exampleInputuname">Numéro inscription</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="icon-key"></i></div>
                                    <input type="text" class="form-control" id="exampleInputuname" name="numInscription" placeholder="Numéro inscription" value="<?php echo $numInscription;?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname">Nom</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="exampleInputuname" name="nom" placeholder="Nom">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname">Prénom</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="exampleInputuname" name="prenom" placeholder="Prénom">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sexe</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                    <select name="sexe" class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                        <option value="Masculin">Masculin</option>
                                        <option value="Feminin">Feminin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date de naissance</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" class="form-control mydatepicker" name="dateNaissance" placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Centre d'examen</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                    <select name="centreExamen" class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                        <option value="Antsiranana">Antsiranana</option>
                                        <option value="Samabava">Samabava</option>
                                        <option value="Majunga">Majunga</option>
                                        <option value="Antananarivo">Antananarivo</option>
                                        <option value="Toamasina">Toamasina</option>
                                        <option value="Ambositra">Ambositra</option>
                                        <option value="Fianarantsoa">Fianarantsoa</option>
                                        <option value="Toliara">Toliara</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-email"></i></div>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Téléphone 1</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input type="text" placeholder="Téléphone 1" name="telephone1"  class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Téléphone 2</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input type="text" placeholder="Téléphone 2" name="telephone2"  class="form-control">
                                </div>
                            </div>
                            <input type="hidden" name="parcour_id" value="<?php echo $parcour_id;?>">
                            <!-- <div class="form-group">
                                <div class="panel">Téléverser une image</div>

                                <input class="nouveauImage" type="file" name="imageProfile">

                                <p class="help-block">Taille max 2Mb</p>

                                <img class="thumbnail visualiser" id="uploaded_image"  src="views/img/default/default.png" width="100px">

                            </div> -->
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Ajouter</button>
                            <!-- <button class="btn btn-inverse waves-effect waves-light">Annuler</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>