@extends('layouts.app')

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Dashboard'])
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="white-box">
                <div class="r-icon-stats">
                    <i class="ti-user bg-megna"></i>
                    <div class="bodystate">
                        <h4>
                            <a href="/candidats/">
                                TIM
                            </a>
                        </h4>
                        <span class="text-muted">
                            <a href="#"></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerScript')
    @parent
@endsection