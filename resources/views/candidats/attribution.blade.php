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
                            <li>Date:
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
                            <li>
                                Numérotation des candidats: {{ $concours->num_generated }}
                                @if( !$concours->num_auto )
                                <a href="javascript:;" class="btn btn-info btn-modal" data-toggle="modal" data-target="#exampleModal">Générer</a>
                                @endif
                            </li>
                            <li>Attribution de salle: </li>
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
        <h5 class="modal-title" id="exampleModalLabel">Generation</h5>
      </div>
      <div class="modal-body py-5">
        <span id="status-text">En cours...</span>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footerScript')
    @parent
    <script>
        $(function () {
            /*$('.popup-modal').magnificPopup({
                type: 'inline',
                preloader: false,
                focus: '#username',
                modal: true
            });
            $(document).on('click', '.popup-modal-dismiss', function (e) {
                e.preventDefault();
                $.magnificPopup.close();
            });*/

            $('#exampleModal').on('shown.bs.modal', function (e) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('candidats.attribution.numero') }}',
                    success: function( resp ){
                        console.log( resp )
                        $('#status-text').text('Terminé!')
                        window.location.reload()
                    },
                    error: function( resp ){
                        console.log( resp )
                    }
               });
            })
        });

    </script>
@endsection