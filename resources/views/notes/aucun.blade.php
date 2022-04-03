@extends('layouts.app')

@section('title', 'Saisit des notes')

@section('style')
    <style scoped>
        .ascending:after{ content: "\25B2"; }
        .descending:after{ content: "\25BC"; }
        .ascending, .descending{ cursor: pointer; }
    </style>
@endsection

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Saisit des notes: parcours ' . $parcours->code])
    <!-- /.row -->
    @include('partials.message')
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Parcours: </strong><br />
                        <select id="parcours_id" class="form-control">
                            @foreach($parcours_list as $p)
                            <option value="{{$p->id}}"
                            @if( $p->id == $parcours->id)
                            selected
                            @endif
                            >{{ $p->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-5 alert alert-info">
                    Aucun candidats dans le parcour {{ $parcours->code }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerScript')
    @parent
    <script>
        $(document).ready( function(){
            /* Selection Parcours */
            $('#parcours_id').change( function() {
                let parcour_id = $(this).val();
                let current_url = window.location.href;
                let url = current_url.substring(0, current_url.lastIndexOf('/')) + '/' + parcour_id;
                window.location.href = url;
            });
        });
    </script>
@endsection