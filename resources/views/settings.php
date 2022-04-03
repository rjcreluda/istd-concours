<?php include('layout_top.php'); ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <h4 class="page-title">Paramètres</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="white-box">
                    <h3>DELIBERATION</h3>
                    <p>{{ message }}</p>
                    <form @submit.prevent="save">
                        <div class="form-group">
                            <label for="moyenne">Nombre des candidats à retenir</label>
                            <input type="text"  v-model="settings.nombre_candidat" class="form-control"  @keypress="isNumber($event)">
                        </div>
                        <div class="form-group">
                            <label for="moyenne">Note Eliminatoire</label>
                            <input type="text" v-model="settings.note_eliminatoire" class="form-control"  @keypress="isNumber($event)" required>
                        </div>
                        <div class="form-group">
                            <label for="moyenne">Moyenne de deliberation</label>
                            <input type="text"  v-model="settings.moyenne_deliberation"  @keypress="isNumber($event)" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->

<?php include('partials/footer.php'); ?>

<!-- Script section -->
<script src="/resources/js/vue.min.js"></script>
<script src="/resources/js/axios.min.js"></script>
<script>
const postUrl = '/settings';
const vm = new Vue({
    el: '#page-wrapper',
    data: {
        settings: null,
        message: ''
    },
    methods: {
        /* Check if input value is a valid number */
        isNumber(evt) {
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
        save(){
            this.message = 'Enregistrement en cours ...'
            axios.post(postUrl, {
                settings: this.settings
            })
            .then( response => { 
                this.message = response.data.message
            } )
            .catch( error => { 
                this.message = error
                console.log('Erreur: ', error)
            } );
        },
    },
    created(){
        this.settings = <?php echo json_encode($settings); ?>
    }
});
</script>
<!-- / script section -->

</body>
</html>
