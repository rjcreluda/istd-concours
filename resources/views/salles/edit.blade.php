<!-- Formulaire Ajouter Candidat Modal -->
<div class="modal fade" id="editData-{{ $salle->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="white-box">
                <h3 class="box-title m-b-0">Ajouter une salle</h3>
                <p class="text-muted m-b-30 font-13"> Veuillez remplir le formulaire </p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('salles.update', ['salle' => $salle->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputuname">Reference</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="exampleInputuname" name="reference" value="{{ $salle->reference }}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Localisation</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-email"></i></div>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="localisation" value="{{ $salle->localisation }}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname">Capacité</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="number" class="form-control" id="exampleInputuname" min="5" name="capacite" value="{{ $salle->capacite }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Mettre à jour</button>
                            <!-- <button class="btn btn-inverse waves-effect waves-light">Annuler</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>