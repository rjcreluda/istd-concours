@extends('layouts.app')

@section('title', 'Modifier un candidat')

@section('style')
    <!-- Date picker plugins css -->
    <link href="/resources/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

    <!-- Daterange picker plugins css -->
    <link href="/resources/plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
@endsection

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Modifier un candidat'])
    <!-- /.row -->
    @include('partials.message')
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('candidats.update', ['candidat' => $candidat->id])}}">
                            @csrf
                            @method('PUT')
                            <h4>Etat Civil</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Civilité</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-user"></i></div>
                                            <select name="civilite" id="civilite" class="form-control">
                                                <option value="monsieur"
                                                @if( $candidat->civilite == 'monsieur')
                                                selected
                                                @endif>Monsieur</option>
                                                <option value="madame" @if( $candidat->civilite == 'madame')
                                                selected
                                                @endif>Madame</option>
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
                                            <input type="text" class="form-control" id="exampleInputuname" name="nom" value="{{$candidat->nom}}" placeholder="Nom">
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
                                            <input type="text" class="form-control" id="exampleInputuname" name="prenom" placeholder="Prénom"value="{{$candidat->prenom}}">
                                        </div>
                                        @if( $errors->has('prenom') )
                                            <span class="text-danger">Champs incorrecte</span>
                                        @endif
                                    </div>
                                </div>
                            </div><!-- end row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date de naissance</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <input type="text" class="form-control mydatepicker" name="dateNaissance" value="{{$candidat->dateNaissance}}" placeholder="dd/mm/yyyy">
                                        </div>
                                        @if( $errors->has('dateNaissance') )
                                            <span class="text-danger">Champs incorrecte: {{ $errors->first('dateNaissance')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Adresse</label>
                                        <div class="input-group">
                                            <textarea name="adresse" id="adresse" cols="30" rows="10" class="form-control">
                                                {{ $candidat->adresse }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Lieu de naissance</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                            <input type="text" class="form-control" name="lieuNaissance" value="{{ $candidat->lieuNaissance }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Téléphone</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input type="text" placeholder="Téléphone" name="telephone" value="{{ $candidat->telephone }}"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Code postale</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="codePostale" value="{{ $candidat->codePostale }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4>Information BACC</h4>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="candidatBacc">Candidat</label>
                                        <select name="candidatBacc" id="candidatBacc" class="form-control">
                                            <option></option>
                                            <option value="Bachelier"
                                            @if ( $candidat->candidatBacc == 'Bachelier' )
                                                 selected
                                                @endif>Bachelier</option>
                                            <option value="Entreprise"
                                            @if ( $candidat->candidatBacc == 'Entreprise' )
                                                 selected
                                                @endif>Entreprise</option>
                                            <option value="ecole"
                                                @if ( $candidat->candidatBacc == 'ecole' )
                                                 selected
                                                @endif
                                            >Ecole</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="serieBacc">Série BACC</label>
                                        <select name="serieBacc" id="serieBacc" class="form-control">
                                            <option value="Equiv">Equiv</option>
                                            <option value="A1"
                                            @if ( $candidat->serieBacc == 'A1' )
                                                 selected
                                                @endif
                                            >A1</option>
                                            <option value="A2"
                                            @if ( $candidat->serieBacc == 'A2' )
                                                 selected
                                                @endif
                                            >A2</option>
                                            <option value="C"
                                            @if ( $candidat->serieBacc == 'C' )
                                                 selected
                                                @endif
                                            >C</option>
                                            <option value="D"
                                            @if ( $candidat->serieBacc == 'D' )
                                                 selected
                                                @endif
                                            >D</option>
                                            <option value="G1"
                                            @if ( $candidat->serieBacc == 'G1' )
                                                 selected
                                                @endif
                                            >G1</option>
                                            <option value="G2"
                                            @if ( $candidat->serieBacc == 'G2' )
                                                 selected
                                                @endif
                                            >G2</option>
                                            <option value="Tech. Ind"
                                            @if ( $candidat->serieBacc == 'Tech. Ind' )
                                                 selected
                                                @endif
                                            >Tech. Ind</option>
                                            <option value="Tech. GC"
                                            @if ( $candidat->serieBacc == 'Tech. GC' )
                                                 selected
                                                @endif
                                            >Tech. GC</option>
                                            <option value="S"
                                            @if ( $candidat->serieBacc == 'S' )
                                                 selected
                                                @endif
                                            >S</option>
                                            <option value="L"
                                            @if ( $candidat->serieBacc == 'L' )
                                                 selected
                                                @endif
                                            >L</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mentionBacc">Mention BACC</label>
                                        <select name="mentionBacc" id="mentionBacc" class="form-control">
                                            <option value=""></option>
                                            <option value="Passable"
                                            @if ( $candidat->mentionBacc == 'Passable' )
                                                 selected
                                                @endif
                                            >Passable</option>
                                            <option value="Assez bien"
                                            @if ( $candidat->mentionBacc == 'Assez bien' )
                                                 selected
                                                @endif
                                            >Assez-Bien</option>
                                            <option value="Assez"
                                            @if ( $candidat->mentionBacc == 'Assez' )
                                                 selected
                                                @endif
                                            >Assez</option>
                                            <option value="Bien"
                                            @if ( $candidat->mentionBacc == 'Bien' )
                                                 selected
                                                @endif
                                            >Bien</option>
                                            <option value="Très bien"
                                            @if ( $candidat->mentionBacc == 'Très bien' )
                                                 selected
                                                @endif
                                            >Très Bien</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="anneeBacc">Année BACC</label>
                                        <input type="number" class="form-control" name="anneeBacc" value="{{ $candidat->anneeBacc }}">
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
                                                <option value="{{$parcour->id}}"
                                                    @if( $candidat->parcour_id == $parcour->id)
                                                    selected
                                                    @endif
                                                    >{{ $parcour->code }}</option>
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
                                                <option value="{{$centre->id}}"
                                                    @if( $candidat->centre_id == $centre->id)
                                                    selected
                                                    @endif
                                                    >{{ $centre->lieu}}</option>
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
                                            <input type="text" class="form-control" name="num_arrive" value="{{ $candidat->num_arrive }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date d'envoie</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <input type="text" class="form-control mydatepicker" name="date_envoie" placeholder="dd/mm/yyyy" value="{{ $candidat->date_envoie }}">
                                        </div>
                                        @if( $errors->has('date_envoie') )
                                            <span class="text-danger">Champs incorrecte: {{ $errors->first('date_envoie')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="parcour">Dossier Incomplet</label>
                                        <select name="dossier_ok" id="dossier_ok" class="form-control">
                                            <option value="0">Non</option>
                                            <option value="1"
                                            @if( $candidat->dossier_ok == 1)
                                            selected
                                            @endif
                                            >Oui</option>
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
                                                <option value="versement"
                                                @if( $candidat->moyen_paiement == 'versement')
                                                selected
                                                @endif
                                                >Versement Bancaire</option>
                                                <option value="virement"
                                                @if( $candidat->moyen_paiement == 'virement')
                                                selected
                                                @endif
                                                >Virement Bancaire</option>
                                                <option value="postal"
                                                @if( $candidat->moyen_paiement == 'postal')
                                                selected
                                                @endif
                                                >Mandat Postal</option>
                                                <option value="aucun"
                                                @if( $candidat->moyen_paiement == 'aucun')
                                                selected
                                                @endif
                                                >Pas de paiement</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="parcour">Numero mandat</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-circle"></i></div>
                                            <input type="text" class="form-control" name="num_mandat" value="{{ $candidat->num_mandat }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date d'arrivé</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <input type="text" class="form-control mydatepicker" name="date_arrive" placeholder="dd/mm/yyyy" value="{{ $candidat->date_arrive }}">
                                        </div>
                                        @if( $errors->has('date_arrive') )
                                            <span class="text-danger">Champs incorrecte: {{ $errors->first('date_arrive')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="">Observation</label>
                                        <input type="text" class="form-control" name="observation" value="{{ $candidat->observation }}">
                                    </div>
                                </div>
                            </div>{{-- ./end row --}}

                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Mettre à jour</button>
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