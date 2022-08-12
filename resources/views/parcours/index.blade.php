@extends('layouts.app')

@section('title', 'Listes des Parcours')

@section('style')
    <style type="text/css">
        .ascendent::after{
            content: " \25B2";
            cursor: pointer;
        }
        .descendent::after{
            content: " \25BC";
            cursor: pointer;
        }
    </style>
@endsection

<!-- Page Content -->
@section('content')
    @include('partials.page_title', ['title' => 'Listes des Parcours'])
    <!-- /.row -->
    @include('partials.message')
    <!-- .row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="d-flex justify-content-end">
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="text" v-model="searchText" class="form-control" placeholder="Rechercher">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="tableDataList" class="table table-sm display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th v-bind:class="order == 1 ? 'ascendent' : 'descendent'" @click.prevent="sortByNom">Nom</th>
                                    <th>Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                    <tr v-for="parcour in filteredItems" v-bind:key="parcour.id">
                                    <td class="mt-5">@{{ parcour.id }}</td>
                                    <td>@{{ parcour.nom }}</td>
                                    <td>@{{ parcour.code }}</td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="#">
                                            <button  type="button" class="btn btn-warning btnEdit" @click="edit(parcour)" data-toggle="modal" data-target="#exampleModal"  class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm"><i class="fa fa-pencil"></i>
                                            </button>
                                        </a>
                                        <button class="btn btn-danger btnDelete" :id="'data-'+parcour.id" :data="parcour.id">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        </div>
                                    </td>
                                    </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th v-bind:class="order == 1 ? 'ascendent' : 'descendent'" @click="sortByNom">Nom</th>
                                    <th>Code</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    <a href="#" data-toggle="modal" data-target="#exampleModal"  class="btn btn-success ">Ajouter un parcours</a>
                </div>
                @include('modals.parcours_new')
                {{-- @foreach( $salles as $salle )
                    @include('salles.edit', ['salle' => $salle])
                @endforeach --}}
            </div>
        </div>
    </div>
@endsection

@section('footerScript')
    @parent
    <script src="{{ asset('resources/js/vue.js') }}"></script>
    <script src="{{ asset('resources/js/axios.min.js') }}"></script>
    <script>

const vm = new Vue({
    el: '#page-wrapper',
    data: {
        data_table: [],
        form: {
            id: 0,
            nom: '',
            ecole_id: undefined,
            code: '',
            message: '',
            error: false,
            buttonText: 'Ajouter'
        },
        searchText: '',
        order: 1
    },
    computed: {
        filteredItems() {
            let data = this.data_table
            if( this.searchText.length > 2 ){
                data = this.data_table.filter( (item) => {
                    return item.nom.toLowerCase().includes(this.searchText.toLowerCase());
                });
            }
            data = data.sort( (a, b) => {
                let fa = a.nom.toLowerCase(),
                    fb = b.nom.toLowerCase();

                if (fa < fb) {
                    return this.order * -1;
                }
                if (fa > fb) {
                    return this.order * 1;
                }
                return 0;
            });
            return data
        },
    },
    created(){
        this.data_table = <?php echo json_encode($parcours); ?>
    },
    methods: {
        sortByNom(){
            return this.order *= -1
        },
        edit(parcour){
            this.form.id = parcour.id;
            this.form.nom = parcour.nom;
            this.form.ecole_id = parcour.ecole_id;
            this.form.code = parcour.code;
            this.form.buttonText = 'Mettre à jour'
        },
        submit(){
            //alert('submit')
            let postUrl, data;
            if( this.form.id != 0 ){ // Update mode
                postUrl = '{{ route('parcours.update') }}';
                data = {
                    id: this.form.id,
                    nom: this.form.nom,
                    code: this.form.code,
                    ecole_id: this.form.ecole_id
                }
            }
            else{
                postUrl = '{{ route('parcours.store')}}';
                data = {
                    nom: this.form.nom,
                    code: this.form.code,
                    ecole_id: this.form.ecole_id
                }
            }
            axios.post(postUrl, data)
            .then( response => {
                //this.form.error = false
                this.form.message = response
                console.log(response.data)
                if( this.form.id != 0 ){
                    this.form.id = 0
                    window.location.reload();
                }
                else{
                    this.data_table.push(response.data);
                }

                this.toggleModal()

            } )
            .catch( error => {
                this.form.message = error
                this.form.error = true
                console.log('Erreur: ', error)
            } );
        },
        delete( matiere ){
            console.log('Deleting parcours: #',matiere)
            axios.post('{{ route('parcours.delete') }}', {
                id: matiere
            })
            .then( response => {
                //this.form.error = false
                console.log(response)
                alert('Parcours Supprimé')
                window.location.reload()
            } )
            .catch( error => {
                this.form.message = error
                this.form.error = true
                console.log('Erreur: ', error)
            } );
        },
        toggleModal(){ $(this.$refs.modal).modal('toggle') }
    }
});
/*=============================================
SUPPRESSION D'UN ELEMENT
=============================================*/
$(document).on("click", ".btnDelete", function(){

    const data = $(this).attr("data");

    swal({
        title: `Voulez vous vraiment supprimer cet element? #${data}`,
        text: "Annuler pour ne pas supprimer",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Annuler',
          confirmButtonText: 'Oui, supprimer'
        }).then(function(result){

        if(result.value){
            vm.delete(data)
        }

    })

});
</script>
@endsection