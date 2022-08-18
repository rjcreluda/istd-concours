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
                <div class="row mb-4">
                    <div class="col-md-8 d-flex">
                        <strong class="mr-2">Parcours: </strong>
                        <select id="parcours_id" >
                            @foreach($parcours_list as $p)
                            <option value="{{$p->id}}"
                            @if( $p->id == $parcours->id)
                            selected
                            @endif
                            >{{ $p->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <strong>Statut: @{{ message }}</strong>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr class="border-top-0">
                                <!-- <th>Rang</th> -->
                                <th class="w-auto">Noms et prénoms</th>
                                <th style="width: 150px;" v-for="subject in subjects">
                                    @{{ subject.name }} <br>
                                    <span class="small">Coeff @{{ subject.coef }}</span>
                                </th>
                                <th :class="order === 1? 'descending' : 'ascending'" @click="sort">Moyenne</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(student, index) in sortedCandidats" :key="index">
                                <td>@{{ student.name }}</td>
                                <td v-for="(notes, i) in student.notes">
                                    <input
                                        v-if="student.notes[i].point == '0'"
                                        type="text"
                                        class="form-control"
                                        :class="{ 'bg-danger' : isBadNote(student.notes[i].point) }"
                                        v-model="student.notes[i].point"
                                        @input="calculMoyenne( student, index, i, $event )"
                                        @blur="save(student, notes)"
                                        @keypress="isNumber(index, i, $event)">
                                    <input
                                        v-else
                                        type="text"
                                        class="form-control"
                                        :class="{ 'bg-danger' : isBadNote(student.notes[i].point) }"
                                        v-model="student.notes[i].point"
                                        @input="calculMoyenne( student, index, i, $event )"
                                        @blur="save(student, notes)"
                                        @keypress="isNumber(index, i, $event)">
                                </td>
                                <td>@{{ student.moyenne.toLocaleString('fr-FR', { style: 'decimal', minimumFractionDigits: 2} ) }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <!-- <th>Rang</th> -->
                            <th>Noms et prénoms</th>
                            <th v-for="subject in subjects">
                                @{{ subject.name }}
                            </th>
                            <th :class="order === 1? 'descending' : 'ascending'" @click="sort">Moyenne</th>
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
    <script src="{{ asset('resources/js/vue.js')}}"></script>
    <script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
    const noteExp = /^\d{1,2},{0,1}[\d]{0,2}$/;
    const vm = new Vue({
        el: '#page-wrapper',
        data: {
            data_table: [],
            subjects: [],
            candidats: [],
            sortedCandidats: [],
            order: 1,
            submiting: false,
            spinner: false,
            error: false,
            message: "en attente",
            //mode: null,
            updateMode: true
        },
        computed: {
            sum_coef(){
                // Sum coefficient
                let sum_coef = 0;
                let coef_total = this.subjects.reduce( (accumulator, subject ) => accumulator + parseInt(subject.coef), sum_coef );
                return coef_total;
            },
            last_id(){
                return this.candidats.length
            },
        },
        methods: {
            // Convert number in french decimal to english decimal
            // Ex: 2,5 => 2.5
            numberFormat( input ){
                return Number( input.replace(',', '.') );
            },
            // Check if note is eliminated
            isBadNote( input ){
                const note = this.numberFormat( input )
                return note < 5 ? true: false
            },
            /* Check if input value is a valid number */
            // keypress callback
            isNumber(row, col, evt) {
                //console.log(this.candidats[row]);
                //console.log(this.candidats[row].notes[col]);

                evt = (evt) ? evt : window.event;

                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if( (charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46 && charCode != 44  ) {
                    evt.preventDefault();
                } else {
                    return true;
                }
            },
            /* Calcule de moyenne de note */
            moyenne( student ){

                let notes_with_coef = [];

                for (let i = 0; i < student.notes.length; i++) {
                    let matiere = this.subjects.filter( ( subject ) => {
                        return Number(subject.id) === Number(student.notes[i].matiere_id);
                    } );
                    let curr_note = student.notes[i].point;
                    if( noteExp.test(curr_note) ){
                        if( curr_note.indexOf(',') !== -1 ){
                            curr_note = Number(curr_note.replace(',', '.'));
                        }
                    }
                    else{
                        curr_note = 0;
                    }
                    notes_with_coef.push( curr_note * matiere[0].coef );
                }
                let note_total = notes_with_coef.reduce( (accumulator, value) => accumulator + value );

                let moyenne = note_total / this.sum_coef;

                //let curr = this.candidats.indexOf(student);
                console.log(`Moyenne: ${moyenne}`);
                moyenne = moyenne.toFixed(2);
                console.log(`Moyenne arrondis: ${moyenne}`);
                return moyenne;
            },
            sortCandidatsByMoyenne()
            {
                var myArray = this.candidats
                this.sortedCandidats = myArray.sort(
                    (std1, std2) => ( Number(std2.moyenne) - Number(std1.moyenne)  ) * this.order )
            },
            /* Calcul moyenne in real time, callback for input event */
            calculMoyenne( student, row, col, event ){

                let curr_note = event.target.value;

                if( noteExp.test(curr_note) ){
                    if( curr_note.indexOf(',') !== -1 ){
                        curr_note = curr_note.replace(',', '.');
                    }
                    curr_note = Number(curr_note);
                    if( 0 <= curr_note && curr_note <= 20){
                        student.moyenne = this.moyenne( student )
                    }
                    else{
                        alert('Le note doit être entre 0 à 20');
                        this.candidats[row].notes[col].point = '0';
                    }
                }
                else if( curr_note == '' ){
                    student.moyenne = this.moyenne( student );
                }
                else{
                    alert('Format incorrect, veuillez utiliser virgule pour les nombres decimaux');
                    this.candidats[row].notes[col].point = '0';
                    student.moyenne = this.moyenne( student );
                }

                // Saving to db
                //this.save()

            },
            /* Triage ordre croissant/descroissant de moyenne */
            sort(){
                this.order = this.order * -1;
                this.sortCandidatsByMoyenne();
            },
            /* Post data to back-end */
            save( student, notes ){
                const current_student = this.candidats.filter( (candidat) => candidat.id == student.id )[0];
                const curr_notes = current_student.notes.filter( (note) => note.id == notes.id )[0]
                this.message = 'enregistrement ...';
                this.submiting = true;
                //let data = [];
                let data =  curr_notes;
                /*for(let i = 0; i < this.candidats.length; i++ ){
                    data.push(...this.candidats[i].notes);
                }*/
                //console.log(data);
                let url = '{{ route('notes.update')}}';

                window.$.ajax({
                    type: 'POST',
                    url: url,
                    data: { note: data },
                    success: (data) => {
                        console.log(data);
                        this.message = 'succès'
                    },
                    error: (data) => {
                        console.log(data);
                        this.error = true;
                        this.message = `erreur ${data.status}. ${data.responseJSON.message}`;
                    }
                }).done( () => {
                    this.submiting = false;
                });

            }
        },
        created(){

            this.subjects =  <?php echo json_encode($matieres); ?>;
            this.candidats =  <?php echo json_encode($candidats); ?>;
            this.sortCandidatsByMoyenne();

        }
    });
    </script>
@endsection