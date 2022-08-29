@extends('layouts.app')

@section('title', $title)

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => $title])
    <!-- /.row -->

    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <div class="table-responsive">
                    <table id="tableData" class="display nowrap table table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>num Inscription</th>
                                <th>Nom et prenom(s)</th>
                                <th>Parcours</th>
                                <th>Centre</th>
                                <th>Date Saisie</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidats as $c)
                            <td>{{ $c->numInscription }}</td>
                            <td>{{ strtoupper($c->nom) }} {{ ucwords($c->prenom) }}</td>
                            <td>{{ $c->parcour }}</td>
                            <td>{{ $c->centre }}</td>
                            <td>{{ $c->date_saisie }}</td>
                            <td>
                                <div class="btn-group">
                                <a href="{{ route('convocation.preview-candidat', ['candidat' => $c->id])}}">
                                    <button type="button" class="btn btn-sm btn-outline-info btnVoirProfile"><i class="fa fa-eye"></i></button>
                                </a>
                                </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>num Inscription</th>
                                <th>Nom et prenom(s)</th>
                                <th>Parcours</th>
                                <th>Centre</th>
                                <th>Date Saisie</th>
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