<!-- Formulaire Ajouter Candidat Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="white-box">
                <h3 class="box-title m-b-0">Ajouter un jury</h3>
                <p class="text-muted m-b-30 font-13"> Veuillez remplir le formulaire </p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('jury.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputuname">Nom et prénom(s)</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-user"></i></div>
                                    <input type="text" class="form-control" id="exampleInputuname" name="nom" >
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