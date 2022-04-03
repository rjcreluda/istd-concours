<!-- Formulaire Ajouter Candidat Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" ref="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="white-box">
                <h3 class="box-title m-b-0">Ajouter un epreuve</h3>
                <p class="text-muted m-b-30 font-13">Veuillez remplir le formulaire </p>
                <span class="text-danger" v-show="form.error">{{ form.message }}</span>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form role="form" @submit.prevent="submit"  method="POST" action="/matieres">
                            <div class="form-group">
                                <label for="exampleInputuname">Epreuve</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="exampleInputuname" name="nom" placeholder="Nom" v-model="form.nom">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname">Coefficient</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="number" class="form-control" id="exampleInputuname" name="coefficient" placeholder="Coefficient" v-model="form.coefficient">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ecole</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                    <select v-model="form.ecole_id" name="ecole_id" class="form-control" data-placeholder="Choisir l'ecole" tabindex="1">
                                        <option value="1">EGI</option>
                                        <option value="2">EGMCS</option>
                                        <option value="3">EGCN</option>
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