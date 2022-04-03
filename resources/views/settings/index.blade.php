@extends('layouts.app')

@section('title', 'Paramètres du concours')

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Paramètres'])
    <!-- /.row -->
    @include('partials.message')
    <!-- .row -->
    <div class="row">
        <div class="col-md-6">
            <div class="white-box">
                <h4>Concours</h4>
                <form method="POST" action="{{ route('settings.concours')}}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="concours_id" value="{{ $concours->id }}">
                    <div class="form-group">
                        <label for="moyenne">Nombre des candidats à retenir</label>
                        <input type="text" value="{{ $concours->nombre_candidat}}" class="form-control" name="nombre_candidat">
                    </div>
                    <div class="form-group">
                        <label for="moyenne">Note Eliminatoire</label>
                        <input type="text" value="{{ $concours->note_eliminatoire}}" class="form-control" required name="note_eliminatoire">
                    </div>
                    <div class="form-group">
                        <label for="moyenne">Moyenne de deliberation</label>
                        <input type="text"  value="{{ $concours->moyenne_deliberation}}" class="form-control" required name="moyenne_deliberation">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="white-box">
                <h4>Application</h4>
                <form action="{{ route('settings.appinfo')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="moyenne">Nom de l'application</label>
                        <input type="text" value="{{ $setting->app_name }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="moyenne">Description de l'application</label>
                        <input type="text" value="{{ $setting->app_description }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footerScript')
    @parent
    <script>
        $(document).ready( function(){
             /* Confirmation Suppression utilisateur*/
            $(document).on("click", ".btnDelete", function(){
                const nom = $(this).attr("nom");
                const user_id = $(this).attr('data-id')
                swal({
                    title: `Voulez vous vraiment supprimer cet utilisateur? ${nom}`,
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
                        document.querySelector(`#form_${user_id}`).submit()
                    }
                })

            });
        });
    </script>
@endsection