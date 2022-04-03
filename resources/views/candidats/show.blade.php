@extends('layouts.app')

@section('title', 'Information candidat')

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
        <div class="col-md-4 col-xs-12">
            <div class="white-box">
                <div class="user-bg">
                    <img class="thumbnail visualiser" src="{{ asset($candidat->photo) }}" width="100%" alt="img">
                </div>
                <div class="user-btm-box">
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r">
                            <strong>Nom</strong>
                            <p>
                                {{ $candidat->nom }}
                            </p>
                        </div>
                        <div class="col-md-6"><strong>Prenom</strong>
                            <p>
                                {{ $candidat->prenom }}
                            </p>
                        </div>
                    </div>
                    <hr>

                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong>Numéro Matricule</strong>
                            <p>{{ $candidat->id }}</p>
                        </div>
                        <div class="col-md-6"><strong>Sexe</strong>
                            <p>{{ $candidat->sexe }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong>Phone</strong>
                            <p>{{ $candidat->telephone1 }}
                                <br/> {{ $candidat->telephone2 }}</p>
                        </div>
                        <div class="col-md-6"><strong>Centre d'Examen</strong>
                            <p>{{ $candidat->centre->lieu }}
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="white-box">
            <div class="row">
                <div class="col-md-4 col-xs-6 b-r"> <strong>Date de Naissance</strong>
                    <br>
                    <p class="text-muted">12/12/21</p>
                </div>
                <div class="col-md-4 col-xs-6 b-r"> <strong>Téléphone</strong>
                    <br>
                    <p class="text-muted"><?php echo $candidat->telephone1; ?><br><?php echo $candidat->telephone2; ?></p>
                </div>
                <div class="col-md-4 col-xs-6 b-r"> <strong>Email</strong>
                    <br>
                    <p class="text-muted"><?php echo $candidat->email; ?></p>
                </div>
            </div>

            <h4 class="m-t-30">Notes</h4>
            <hr>
            @foreach( $candidat->notes as $note)
                <h5>{{ $note->matiere->nom }} <span class="pull-right">@format_note($note->point)</span></h5>
                <div class="progress">
                   <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:'.$largeurPregressBarFr.'%;"> </div>
                </div>
            @endforeach

                <h4 class="m-t-30">Résultat</h4>
                <hr>
                <div class="stats-row">
                    <div class="stat-item">
                        <h6>Moyenne</h6> <b> @format_note($moyenne) </b></div>
                    {{-- <div class="stat-item">
                        <h6>Admission</h6> <b>en attente</b></div> --}}
                </div>
                <div>
                    <div id="placeholder" class="demo-placeholder"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerScript')
    @parent
@endsection