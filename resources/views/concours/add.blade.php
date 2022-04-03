<!-- Formulaire Ajouter Candidat Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="white-box">
                <h3 class="box-title m-b-0">Nouveau concours</h3>
                <p class="text-muted m-b-30 font-13"> Veuillez remplir le formulaire </p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('concours.store') }}">
                            @csrf
                            <div class="form-group">
                                 <label for="exampleInputuname">Année Universitaire</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="exampleInputuname" name="anneeUniv" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="cold-md-12">Date du concours</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="exampleInputuname">1er cycle</label><br />
                                    <span>Début</span>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" class="form-control mydatepicker" name="date1[]" placeholder="dd/mm/yyyy">
                                    </div>
                                    <span>Fin</span>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" class="form-control mydatepicker" name="date1[]" placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputuname">2nd cycle</label><br />
                                    <span>Debut</span>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" class="form-control mydatepicker" name="date2[]" placeholder="dd/mm/yyyy">
                                    </div>

                                    <span>Fin</span>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" class="form-control mydatepicker" name="date2[]" placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Enregistrer</button>
                            <!-- <button class="btn btn-inverse waves-effect waves-light">Annuler</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>