@extends('layouts.app')

@section('title', 'Attribution salle et numéro')

@section('style')
    <!-- Date picker plugins css -->
    <link href="/resources/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

    <!-- Daterange picker plugins css -->
    <link href="/resources/plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
@endsection

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Attribution salle et numéro'])
    <!-- /.row -->
    @include('partials.message')
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <h4>Concours</h4>
                        <ul>
                            <li>Session active: {{ $concours->anneeUniv }}</li>
                            <li>Date du concours:
                                <ul>
                                    @foreach( $concours->infos as $info )
                                        <li>
                                            {{ $info->cycle }}: {{ $info->date_1 }}
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <h4>Attribution</h4>
                        <ul>
                            <li class="mb-2">
                                Numérotation des candidats: {{ $concours->num_generated }}
                                @if( !$concours->num_auto )
                                <a href="javascript:;" class="btn btn-default btn-sm btn-modal" data-toggle="modal" data-target="#exampleModal">Générer</a>
                                @endif
                            </li>
                            <li class="mb-2">Attribution de salle <span class="small">( cas Antsiranana )</span>: {{ $concours->salle_generated }}
                                @if( !$concours->salle_auto )
                                <a href="javascript:;" class="btn btn-default btn-sm btn-modal" data-toggle="modal" data-target="#exampleModal2">Générer</a>
                                @else
                                    {{-- <a href="javascript:;" class="btn-sm btn-modal" data-toggle="modal" data-target="#exampleModal2">Re-générer</a> --}}
                                @endif
                            </li>
                            <li class="mb-2">Attribution de jury <span class="small">( cas 2nd cycle )</span>: {{ $concours->jury_generated }}
                                @if( !$concours->jury_auto )
                                <a href="javascript:;" class="btn btn-default btn-sm btn-modal" data-toggle="modal" data-target="#exampleModal3">Générer</a>
                                @else
                                    {{-- <a href="javascript:;" class="btn-modal" data-toggle="modal" data-target="#exampleModal2">re-Générer</a> --}}
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="test-modal" class="mfp-hide white-popup-block">
        <h1>Numerotation</h1>
        <p>En cours ...</p>
        <p>{{-- <a class="popup-modal-dismiss" href="#">Dismiss</a> --}}</p>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Generation de numéro d'inscription</h5>
      </div>
      <div class="modal-body py-5">
        <span id="status-text">En cours...</span>
      </div>
    </div>
  </div>
</div>

<!-- Modal progression generation salle -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Generation répartition par salle</h5>
      </div>
      <div class="modal-body py-5">
        <span id="status-text2">En cours...</span>
      </div>
    </div>
  </div>
</div>

<!-- Modal progression generation de Jury -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Generation de répartition des candidats du 2<sup>nd</sup> cycle par jury</h5>
      </div>
      <div class="modal-body py-5">
        <span id="status-text3">En cours...</span>
      </div>
    </div>
  </div>
</div>

@endsection

@section('footerScript')
    @parent
    <script>
        $(function () {

            $('#exampleModal').on('shown.bs.modal', function (e) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('candidats.attribution.numero') }}',
                    success: function( resp ){
                        console.log( resp )
                        $('#status-text').text('Terminé!')
                        swal("Succès", "Génération terminé", "success")
                        .then( function( value ){
                            window.location.reload()
                        })

                    },
                    error: function( resp ){
                        console.log( resp )
                    }
               });
            })

            $('#exampleModal2').on('shown.bs.modal', function (e) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('candidats.attribution.salle') }}',
                    success: function( resp ){
                        console.log( resp )
                        $('#status-text2').text('Terminé!')
                        $('#exampleModal2').modal('hide')
                        swal("Succès", "Génération terminé", "success")
                        .then( function( value ){
                            window.location.reload()
                        })

                    },
                    error: function( resp ){
                        console.log( resp )
                    }
               });
            })

            $('#exampleModal3').on('shown.bs.modal', function (e) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('candidats.attribution.jury') }}',
                    success: function( resp ){
                        console.log( resp )
                        $('#status-text3').text('Terminé!')
                        $('#exampleModal3').modal('hide')
                        swal("Succès", "Génération terminé", "success")
                        .then( function( value ){
                            window.location.reload()
                        })

                    },
                    error: function( resp ){
                        console.log( resp )
                    }
               });
            })
        });

    </script>
@endsection