@extends('layouts.app')

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Dashboard'])
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
        @foreach( $salles as $salle )
        <div class="col-md-3 col-sm-6">
            <div class="white-box">
                <a class="r-icon-stats d-block" href="{{ route('salles.show', ['salle' => $salle->id])}}">
                    <i class="ti-home bg-info"></i>
                    <div class="bodystate">
                        <span>
                            {{ $salle->reference }}
                        </span>
                        <div class="text-muted">
                            {{ $salle->localisation }}
                        </div>
                        <div class="text-muted">
                            {{ $salle->capacite }} places
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
@endsection

@section('footerScript')
    @parent
@endsection