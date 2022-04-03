<?php include('layout_top.php'); ?>
<style scoped>
    .ascending:after{ content: "\25B2"; }
    .descending:after{ content: "\25BC"; }
    .ascending, .descending{ cursor: pointer; }
</style>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h4 class="page-title">
                    <?php echo $title.' - Parcours '.$parcour->code; ?>
                    <span class="spinner-border spinner-border-sm"></span>  
                </h4>
            </div>
            <!-- <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" @click="save">Enregistrer les modifications</button>
                </div>
            </div> -->
            <div class="col-lg-4 col-sm-12 col-md-4 col-xs-12">
                <div class="d-flex justify-content-md-end">
                    <button class="btn btn-primary" @click="save">Enregistrer les modifications</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php if($candidats): ?>
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-8">
                            <div v-show="submiting">{{ message }}</div>
                            <div v-show="error">{{ message }}</div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-sm" cellspacing="0" width="100%">
                            <thead>
                                <tr class="border-top-0">
                                    <!-- <th>Rang</th> -->
                                    <th class="w-auto">Noms et prénoms</th>
                                    <th style="width: 150px;" v-for="subject in subjects">
                                        {{ subject.name }}
                                    </th>
                                    <th :class="order === 1? 'descending' : 'ascending'" @click="sort">Moyenne</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(student, index) in sortedCandidats" :key="index">
                                    <!-- <td>{{ index + 1 }}</td> -->
                                    <td>{{ student.name }}</td>
                                    <td v-for="(notes, i) in student.notes">
                                        <input v-if="student.notes[i].point == '0'" type="text" class="form-control text-danger" v-model="student.notes[i].point" @input="calculMoyenne( student, index, i, $event )" @blur="save" @keypress="isNumber(index, i, $event)">
                                        <input v-else type="text" class="form-control" v-model="student.notes[i].point" @input="calculMoyenne( student, index, i, $event )" @blur="save" @keypress="isNumber(index, i, $event)">
                                    </td>
                                    <td>{{ Intl.NumberFormat('fr-FR').format(student.moyenne) }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <!-- <th>Rang</th> -->
                                <th>Noms et prénoms</th>
                                <th v-for="subject in subjects">
                                    {{ subject.name }}
                                </th>
                                <th :class="order === 1? 'descending' : 'ascending'" @click="sort">Moyenne</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <?php else: ?>
                    Page introuvable
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>
<!-- /#page-wrapper -->

<?php include('partials/footer.php'); ?>

<script src="/resources/js/vue.min.js"></script>
<script src="/resources/js/axios.min.js"></script>
<script>
    const postUrl = '/notes';
    const postUpdateUrl = '/notes/update';
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
            message: "Enregistrement en cours ...",
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
            /* Check if input value is a valid number */
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
                return moyenne.toFixed(2);
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
                        this.candidats[row].notes[col].point = '';
                    }
                }
                else if( curr_note == '' ){
                    student.moyenne = this.moyenne( student );
                }
                else{
                    alert('Format incorrect');
                    this.candidats[row].notes[col].point = '';
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
            save(){
                this.message = 'Enregistrement en cours ...';
                this.submiting = true;
                let data = [];
                for(let i = 0; i < this.candidats.length; i++ ){
                    data.push(...this.candidats[i].notes);
                }
                //console.log(data);
                let url = postUpdateUrl;

                axios.post(url, {
                    notes: data
                })
                .then( response => { 
                    this.message = response.data
                } )
                .catch( error => { 
                    this.submiting = false;
                    this.error = true;
                    this.message = error;
                } );
            
            }
        },
        created(){
            
            this.subjects =  <?php echo json_encode($matieres); ?>;
            this.candidats =  <?php echo json_encode($candidats); ?>;
            this.sortCandidatsByMoyenne();

        }
    });
</script>

<?php include('layout_bottom.php'); ?>