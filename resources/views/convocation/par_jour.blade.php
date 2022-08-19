@extends('layouts.app')

@section('title', $title)

@section('style')
<style>
    .dt-buttons{ display: none; }
</style>
@endsection

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => $title])
    <!-- /.row -->
    @php
        $doc_title = 'Convocation'
    @endphp
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                    <div class="table-responsive mt-3">
                        <table id="tableData" class="display nowrap table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Parcours</th>
                                    <th>Nombre des candidats</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parcours as $p)
                                <td>{{ $p->nom }}</td>
                                <td>{{ $p->nbr_candidats }}</td>
                                <td>
                                    <div class="btn-group">
                                    <a href="{{ route('convocation.preview', ['parcour' => $p->id])}}">
                                        <button type="button" class="btn btn-sm btn-outline-info btnVoirProfile"><i class="fa fa-eye"></i></button>
                                    </a>
                                    </div>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Parcours</th>
                                    <th>Nombre</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('footerScript')
    @parent
@endsection