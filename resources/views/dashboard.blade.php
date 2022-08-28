@extends('layouts.app')

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Dashboard'])
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="white-box">
                <h5>Candidats par centre</h5>
                <ul class="list-group list-group-flush">
                    @foreach( $stat->centres as $stat )
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="ti ti-location-pin"></i> {{ $stat->centre }}</span>
                            <span>{{ $stat->candidats }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            <div class="white-box">

                    <h5>Ecole</h5>
                    <hr>
                    <div class="d-flex justify-content-between">
                        @foreach( $stat_ecole as $stat )
                            <div>
                                <div class="r-icon-stats">
                                    <i class="ti-folder bg-megna"></i>
                                    <div class="bodystate">
                                        <h4>
                                            {{ $stat->ecole }}
                                        </h4>
                                        <span class="text-mutted small">
                                            {{ $stat->candidats }}
                                            @if( $stat->candidats > 1 )
                                            candidats
                                            @else
                                            candidat
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('footerScript')
    @parent
@endsection