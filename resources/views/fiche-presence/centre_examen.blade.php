@extends('layouts.app')

@section('title', 'Selectionner un centre d\'examen')

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Selectionner un centre d\'examen'])
    <!-- /.row -->
    @php
        $doc_title = 'Centre d\'examens';
    @endphp
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="box-title d-flex flex-wrap">
                    <h4 class="pr-3">Centre</h4>
                </div>
                <h3 class="box-title m-b-0">Exporter le tableau</h3>
                <p class="text-muted m-b-30">Exporter en Copie, Excel, PDF & Impression</p>

                <div class="table-responsive">
                    <table id="tableData" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Centre d'examen</th>
                                <th>Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($centres as $c)
                            <td>{{ $c->lieu }}</td>
                            <td>{{ $c->code }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('fiche.centre', ['centre' => $c->id])}}?cycle={{$cycle}}">
                                        <button type="button" class="btn btn-info btnVoirProfile"><i class="fa fa-eye"></i></button>
                                    </a>
                                </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Centre d'examen</th>
                                <th>Code</th>
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
        /* Selection Parcours */
        $('#parcours').change( function() {
            let parcour_id = $(this).val();
            let current_url = window.location.href;
            let url = current_url.substring(0, current_url.lastIndexOf('/')) + '/' + parcour_id;
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