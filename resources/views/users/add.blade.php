<!-- Formulaire Ajouter Candidat Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="white-box">
                <h3 class="box-title m-b-0">Ajouter un utilisateur</h3>
                <p class="text-muted m-b-30 font-13"> Veuillez remplir le formulaire </p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('users.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputuname">Nom</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="exampleInputuname" name="name" placeholder="Nom">
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
                                <label for="exampleInputuname">Login</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="exampleInputuname" name="login" placeholder="login">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Mot de passe</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input type="password" placeholder="******" name="password"  class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Type d'utilisateur</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                    <select name="type" class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                        <option value="os">Opérateur de saisie</option>
                                        <option value="controlleur">Contrôlleur</option>
                                        <option value="admin">Administrateur</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Ajouter</button>
                            <!-- <button class="btn btn-inverse waves-effect waves-light">Annuler</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>