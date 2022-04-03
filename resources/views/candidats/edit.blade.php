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
                            {{--
                            <div class="form-group">
                                <label for="exampleInputuname">Numéro inscription</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="icon-key"></i></div>
                                    <input type="text" class="form-control" id="exampleInputuname" name="numInscription" placeholder="Numéro inscription" value="<?php echo $numInscription;?>">
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-6">
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
                                <div class="col-md-6">
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
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sexe</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                    <select name="sexe" class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                        <option value="M"
                                        @if( $candidat->sexe == 'M')
                                        selected
                                        @endif
                                        >Masculin</option>
                                        <option value="F"
                                        @if( $candidat->sexe == 'F')
                                        selected
                                        @endif
                                        >Feminin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date de naissance</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" class="form-control mydatepicker" name="dateNaissance" placeholder="dd/mm/yyyy" value="{{$candidat->dateNaissance}}">
                                </div>
                                @if( $errors->has('dateNaissance') )
                                    <span class="text-danger">Champs incorrecte: {{ $errors->first('dateNaissance')}}</span>
                                @endif
                            </div>
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
                            <div class="form-group">
                                <label for="parcour">Parcours</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                    <select id="parcour" name="parcour_id" class="form-control" data-placeholder="Choisissez un parcour">
                                        @foreach($parcours as $parcour )
                                        <option value="{{$parcour->id}}"
                                            @if( $parcour->id == $candidat->parcour_id)
                                            selected="@endif"
                                        >{{ $parcour->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-email"></i></div>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{$candidat->email}}" placeholder="Email">
                                </div>
                                @if( $errors->has('nom') )
                                    <span class="text-danger">Champs incorrecte</span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Téléphone 1</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input type="text" placeholder="Téléphone 1" name="telephone1" value="{{$candidat->telephone1}}"  class="form-control">
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
                                            <input type="text" placeholder="Téléphone 2" name="telephone2" value="{{$candidat->telephone2}}"  class="form-control">
                                        </div>
                                    </div>
                                    @if( $errors->has('telephone2') )
                                            <span class="text-danger">Champs incorrecte</span>
                                        @endif
                                </div>
                            </div><!-- end row -->


                            {{-- <input type="hidden" name="parcour_id" value="<?php echo $parcour_id;?>"> --}}
                            <div class="form-group">
                                <div class="panel">Ajouter un photo d'identité</div>

                                <input class="nouveauImage" type="file" name="imageProfile" />

                                <p class="help-block">Taille max 2Mb</p>

                                {{-- <img class="thumbnail visualiser" id="uploaded_image"  src="views/img/default/default.png" width="100px"> --}}

                            </div>
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