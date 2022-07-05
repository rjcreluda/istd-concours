@extends('layouts.app')

@section('title', 'Nouveau candidat')

@section('style')
    <!-- Date picker plugins css -->
    <link href="/resources/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

    <!-- Daterange picker plugins css -->
    <link href="/resources/plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
@endsection

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Nouveau candidat'])
    <!-- /.row -->
    @include('partials.message')
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('candidats.store')}}">
                            @csrf
                            {{--
                            <div class="form-group">
                                <label for="exampleInputuname">Numéro inscription</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="icon-key"></i></div>
                                    <input type="text" class="form-control" id="exampleInputuname" name="numInscription" placeholder="Numéro inscription" value="<?php echo $numInscription;?>">
                                </div>
                            </div> --}}
                            <h4>Etat Civil</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Civilité</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-user"></i></div>
                                            <select name="civilite" id="civilite" class="form-control">
                                                <option value="monsieur">Monsieur</option>
                                                <option value="madame">Madame</option>
                                            </select>
                                        </div>
                                        @if( $errors->has('civilite') )
                                            <span class="text-danger">Champs incorrecte</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Nom</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-user"></i></div>
                                            <input type="text" class="form-control" id="exampleInputuname" name="nom" value="{{ old('nom')}}" placeholder="Nom">
                                        </div>
                                        @if( $errors->has('nom') )
                                            <span class="text-danger">Champs incorrecte</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Prénom</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-user"></i></div>
                                            <input type="text" class="form-control" id="exampleInputuname" name="prenom" placeholder="Prénom"value="{{ old('prenom')}}">
                                        </div>
                                        @if( $errors->has('prenom') )
                                            <span class="text-danger">Champs incorrecte</span>
                                        @endif
                                    </div>
                                </div>
                            </div><!-- end row -->
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Sexe</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                    <select name="sexe" class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                        <option value="M">Masculin</option>
                                        <option value="F">Feminin</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date de naissance</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <input type="text" class="form-control mydatepicker" name="dateNaissance" placeholder="dd/mm/yyyy">
                                        </div>
                                        @if( $errors->has('dateNaissance') )
                                            <span class="text-danger">Champs incorrecte: {{ $errors->first('dateNaissance')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Adresse</label>
                                        <div class="input-group">
                                            <textarea name="adresse" id="adresse" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Lieu de naissance</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                            <input type="text" class="form-control" name="lieuNaissance">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Téléphone</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input type="text" placeholder="Téléphone" name="telephone" value="{{ old('telephone1')}}"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code postale</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="codePostale">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4>Information BACC</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="candidatBacc">Candidat</label>
                                        <select name="candidatBacc" id="candidatBacc" class="form-control">
                                            <option value=""></option>
                                            <option value="ecole">Ecole</option>
                                            <option value="libre">Libre</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="serieBacc">Série BACC</label>
                                        <select name="serieBacc" id="serieBacc" class="form-control">
                                            <option value=""></option>
                                            <option value="A">A</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="technique">Technique</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mentionBacc">Mention BACC</label>
                                        <select name="mentionBacc" id="mentionBacc" class="form-control">
                                            <option value=""></option>
                                            <option value="passable">Passable</option>
                                            <option value="assez-bien">Assez-Bien</option>
                                            <option value="bien">Bien</option>
                                            <option value="tres-bien">Très Bien</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="anneeBacc">Année BACC</label>
                                        <input type="number" class="form-control" name="anneeBacc">
                                    </div>
                                </div>
                            </div>

                            <h4>Information Parcours</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parcour">Parcours</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                            <select id="parcour" name="parcour_id" class="form-control" data-placeholder="Choisissez un parcour">
                                                @foreach($parcours as $parcour )
                                                <option value="{{$parcour->id}}">{{ $parcour->nom}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Centre d'examen</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                            <select name="centre_id" class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                                @foreach($centres as $centre )
                                                <option value="{{$centre->id}}">{{ $centre->lieu}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>{{-- ./end row --}}

                            <h4>Information Dossier</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Numero d'arrivé</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <input type="text" class="form-control" name="num_arrive">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date d'envoie</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <input type="text" class="form-control mydatepicker" name="date_envoie" placeholder="dd/mm/yyyy">
                                        </div>
                                        @if( $errors->has('date_envoie') )
                                            <span class="text-danger">Champs incorrecte: {{ $errors->first('date_envoie')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="parcour">Dossier Incomplet</label>
                                        <select name="dossier_ok" id="dossier_ok" class="form-control">
                                            <option value="0">Non</option>
                                            <option value="1">Oui</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Payé par</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-check"></i></div>
                                            <select name="moyen_paiement" class="form-control" data-placeholder="Choisir" tabindex="1">
                                                <option value="espece">Espèce</option>
                                                <option value="versement">Versement Bancaire</option>
                                                <option value="virement">Virement Bancaire</option>
                                                <option value="postal">Mandat Postal</option>
                                                <option value="aucun">Pas de paiement</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="parcour">Numero mandat</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-circle"></i></div>
                                            <input type="text" class="form-control" name="num_mandat">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date d'arrivé</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <input type="text" class="form-control mydatepicker" name="date_arrive" placeholder="dd/mm/yyyy">
                                        </div>
                                        @if( $errors->has('date_arrive') )
                                            <span class="text-danger">Champs incorrecte: {{ $errors->first('date_arrive')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Observation</label>
                                        <input type="text" class="form-control" name="observation">
                                    </div>
                                </div>
                            </div>{{-- ./end row --}}

                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-email"></i></div>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{ old('email') }}" placeholder="Email">
                                </div>
                                @if( $errors->has('nom') )
                                    <span class="text-danger">Champs incorrecte</span>
                                @endif
                            </div> --}}
                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Téléphone 1</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input type="text" placeholder="Téléphone 1" name="telephone1" value="{{ old('telephone1')}}"  class="form-control">
                                        </div>
                                    </div>
                                    @if( $errors->has('telephone1') )
                                            <span class="text-danger">Champs incorrecte</span>
                                        @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Téléphone 2</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input type="text" placeholder="Téléphone 2" name="telephone2" value="{{ old('telephone2')}}"  class="form-control">
                                        </div>
                                    </div>
                                    @if( $errors->has('telephone2') )
                                            <span class="text-danger">Champs incorrecte</span>
                                        @endif
                                </div>
                            </div> --}}<!-- end row -->


                            {{-- <input type="hidden" name="parcour_id" value="<?php echo $parcour_id;?>"> --}}
                            {{-- <div class="form-group">
                                <div class="panel">Ajouter un photo d'identité</div>

                                <input class="nouveauImage" type="file" name="imageProfile" />

                                <p class="help-block">Taille max 2Mb</p>

                                <!--<img class="thumbnail visualiser" id="uploaded_image"  src="views/img/default/default.png" width="100px">-->

                            </div> --}}
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Enregistrer</button>
                            <!-- <button class="btn btn-inverse waves-effect waves-light">Annuler</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerScript')
    @parent
@endsection