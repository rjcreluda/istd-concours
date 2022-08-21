@extends('layouts.app')

@section('title', 'Liste des juris')

@section('style')
<style>
    .dt-buttons{
        display: none;
    }
</style>
@endsection

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Liste des juris'])
    <!-- /.row -->
    @php
        $doc_title = 'Candidats au centres '.$centre->code
    @endphp
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="box-title d-flex flex-wrap">
                    <h4 class="pr-3">Centre</h4>
                    <select name="centre_id" id="centres">
                        @foreach($centres as $p)
                        <option value="{{$p->id}}"
                        @if( $p->id == $centre->id)
                        selected
                        @endif
                        >{{ $p->lieu }}</option>
                        @endforeach
                    </select>
                </div>
                <h3 class="box-title m-b-0">Liste des jury</h3>
                {{-- <p class="text-muted m-b-30">Exporter en Copie, Excel, PDF & Impression</p> --}}

                <div class="table-responsive">
                    <table id="tableData" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom et prénom(s)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jury as $j)
                            <tr>
                            <td>{{ $j->id }}</td>
                            <td>{{ $j->nom }}</td>
                            <td>
                                <div class="btn-group">
                                <a href="{{ route('fiche.jury', ['centre' => $centre, 'jury' => $j])}}" title="voir">
                                    <button type="button" class="btn btn-info btnVoirProfile"><i class="fa fa-eye"></i></button>
                                </a>
                                </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nom et prénom(s)</th>
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
    <script>
        /* Selection centre */
        $('#centres').change( function() {
            let centre_id = $(this).val();
            let current_url = window.location.href;
            let url = current_url.substring(0, current_url.lastIndexOf('/')) + '/' + centre_id;
            const cycle = '{{ $cycle }}';
            url = url + '?cycle=' + cycle;
            window.location.href = url;
        });



        /* Confirmation Suppression candidat*/
        $(document).on("click", ".btnDelete", function(){
            const nom = $(this).attr("nom");
            const candidat_id = $(this).attr('candidat_id')
            swal({
                title: `Voulez vous vraiment supprimer cet element? #${nom}`,
                text: "Annuler pour ne pas supprimer",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Annuler',
                  confirmButtonText: 'Oui, supprimer'
            })
            .then( function(result){
                if(result.value){
                    document.querySelector(`#form_${candidat_id}`).submit()
                }
            })

        });
    </script>
@endsection