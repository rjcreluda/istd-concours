@extends('layouts.app')

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Candidats ' . $ecole->code ])
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
        @foreach( $parcours as $parcour)
        <div class="col-md-3 col-sm-6">
            <div class="white-box">
                <div class="r-icon-stats">
                    <i class="ti-user bg-megna"></i>
                    <div class="bodystate">
                        <h4>
                            <a href="{{ route('candidats.parcours', ['ecole' => $ecole, 'parcour' => $parcour])}}">
                                {{ $parcour->code }}
                            </a>
                        </h4>
                        <span class="text-mutted small">
                            {{ $parcour->candidats_count }}
                            @if( $parcour->candidats_count > 1 )
                            candidats
                            @else
                            candidat
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

@section('footerScript')
    @parent
@endsection