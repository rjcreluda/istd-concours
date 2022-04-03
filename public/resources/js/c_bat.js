/*=============================================
TELEVERSEMENT D'UN IMAGE
=============================================*/

$(".nouveauImage").change(function(){

	var monImage = this.files[0];

	/*===============================================
	=            valider le format  image           =
	===============================================*/
	
	if (monImage["type"] != "image/jpeg" && monImage["type"] != "image/png"){

		$(".nouveauImage").val("");

		swal({
			type: "error",
			title: "Erreur de format d'image",
			text: "Image doit etre en format PNG ou JPEG",
			showConfirmButton: true,
			confirmButtonText: "Fermer"
		});

	}else if(monImage["size"] > 2000000){

		$(".nouveauImage").val("");

		swal({
			type: "error",
			title: "Erreur de la taille d'image",
			text: "La taille de l'image ne doit pas depasser 2Mb!",
			showConfirmButton: true,
			confirmButtonText: "Fermer"
		});

	}else{

		var imgData = new FileReader;
		imgData.readAsDataURL(monImage);

		$(imgData).on("load", function(event){
			
			var routeImg = event.target.result;

			$(".visualiser").attr("src", routeImg);

		});

	}
		
	/*=====  Fin valider le format image  ======*/
	
})
/*=============================================
SUPPRESSION D'UN CANDIDAT
=============================================*/

$(document).on("click", ".btnSupprimer", function(){

	var candiId = $(this).attr("candiId");
	var nom = $(this).attr("nom");
	var photo = $(this).attr("photo");

	swal({
		title: `Voulez vous vraiment supprimer ${nom}`,
		text: "Annuler pour ne pas supprimer",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Annuler',
		  confirmButtonText: 'Oui, supprimer'
		}).then(function(result){

		if(result.value){
            // Ajax call for deletion
		}

	})

});


/*=================================
=            datatable            =
=================================*/
$('#tableBat').DataTable({
    dom: 'Bfrtip',
    buttons: [
       
        {
            extend: 'copy',
			title: 'LISTES CANDIDAT BAT',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5 ]
            }
        },
        {
            extend: 'csv',
			title: 'LISTES CANDIDAT BAT',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5 ]
            }
        },
        {
            extend: 'excel',
            title: 'LISTES CANDIDAT BAT',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5 ]
            }
            
        },
        {
            extend: 'pdf',
            title: 'LISTES CANDIDAT BAT',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5 ],
                
            },
            customize: function(doc) {
                
                doc.styles.tableHeader.fontSize = 8;
                doc.defaultStyle.fontSize =8;
                doc.pageMargins = [50,50,50,10];
                // Styling the table: create style object
                var objLayout = {};
                // Horizontal line thickness
                objLayout['hLineWidth'] = function(i) { return .5; };
                // Vertikal line thickness
                objLayout['vLineWidth'] = function(i) { return .5; };
                // Horizontal line color
                objLayout['hLineColor'] = function(i) { return '#aaa'; };
                // Vertical line color
                objLayout['vLineColor'] = function(i) { return '#aaa'; };
                // Left padding of the cell
                objLayout['paddingLeft'] = function(i) { return 7; };
                // Right padding of the cell
                objLayout['paddingRight'] = function(i) { return 7; };
                // Inject the object in the document
                doc.content[1].layout = objLayout;
            } 
        },
        {
            extend: 'print',
			title: 'LISTES CANDIDAT BAT',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5 ]
            },
            
        },
        
    ],

    


    "language": {

        "sSearch": "Recherche:",
        "sInfo": "Affiche _START_ à _END_ de _TOTAL_ entrées",
        
        "oPaginate":{
            
            "sNext": "Suivant",
            "sPrevious": "Avant"

        }

    }
});

/*=================================
=            datatable            =
=================================*/
$('#tableNBat').DataTable({
    dom: 'Bfrtip',
    buttons: [
       
        {
            extend: 'copy',
			title: 'NOTES DES CANDIDATS BAT',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
            }
        },
        {
            extend: 'csv',
			title: 'NOTES DES CANDIDATS BAT',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
            }
        },
        {
            extend: 'excel',
            title: 'NOTES DES CANDIDATS BAT',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
            }
            
        },
        {
            extend: 'pdf',
            title: 'NOTES DES CANDIDATS BAT',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ],
                
            },
            customize: function(doc) {
                
                doc.styles.tableHeader.fontSize = 8;
                doc.defaultStyle.fontSize =8;
                doc.pageMargins = [50,50,50,10];
                // Styling the table: create style object
                var objLayout = {};
                // Horizontal line thickness
                objLayout['hLineWidth'] = function(i) { return .5; };
                // Vertikal line thickness
                objLayout['vLineWidth'] = function(i) { return .5; };
                // Horizontal line color
                objLayout['hLineColor'] = function(i) { return '#aaa'; };
                // Vertical line color
                objLayout['vLineColor'] = function(i) { return '#aaa'; };
                // Left padding of the cell
                objLayout['paddingLeft'] = function(i) { return 7; };
                // Right padding of the cell
                objLayout['paddingRight'] = function(i) { return 7; };
                // Inject the object in the document
                doc.content[1].layout = objLayout;
            } 
        },
        {
            extend: 'print',
			title: 'NOTES DES CANDIDATS BAT',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
            },
            
        },
        
    ],

    


    "language": {

        "sSearch": "Recherche:",
        "sInfo": "Affiche _START_ à _END_ de _TOTAL_ entrées",
        
        "oPaginate":{
            
            "sNext": "Suivant",
            "sPrevious": "Avant"

        }

    }
});

/*============================================
=            datatable Résultat Concours    =
============================================*/
var date = new Date();
var jour = date.getDate();
var mois = date.getMonth()+1;
var annee = date.getFullYear();

// var moisLettre = Array('Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre', 'Decembre');

// for(var i = 1; i<=12;i++){
// 	if(i == moisLettre[i]){
// 		moisAffiher = moisLettre[i];
// 	}
// }

var dateAfficher = jour+"/"+mois+"/"+annee

console.log(dateAfficher);

$('#tableResultat').DataTable({
	
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'copy',
			title: 'RESULTAT CONCOUR BAT LE '+dateAfficher,
			exportOptions: {
                columns: [ 0, 1, 2, 3]
            }
        },
        {
            extend: 'csv',
			title: 'RESULTAT CONCOUR BAT LE '+dateAfficher,
			exportOptions: {
                columns: [ 0, 1, 2, 3]
            }
        },
        {
            extend: 'excel',
			title: 'RESULTAT CONCOUR BAT LE '+dateAfficher,
			exportOptions: {
                columns: [ 0, 1, 2, 3]
            }
            
        },
        {
            extend: 'pdf',
            title: 'RESULTAT CONCOUR BAT LE '+dateAfficher,
			exportOptions: {
                columns: [ 0, 1, 2, 3]
            },
            customize: function(doc) {
           
                doc.styles.tableHeader.fontSize = 10;
                doc.defaultStyle.fontSize =10;
                doc.pageMargins = [50,50,50,10];
                // Styling the table: create style object
                var objLayout = {};
                // Horizontal line thickness
                objLayout['hLineWidth'] = function(i) { return .9; };
                // Vertikal line thickness
                objLayout['vLineWidth'] = function(i) { return .9; };
                // Horizontal line color
                objLayout['hLineColor'] = function(i) { return '#aaa'; };
                // Vertical line color
                objLayout['vLineColor'] = function(i) { return '#aaa'; };
                // Left padding of the cell
                objLayout['paddingLeft'] = function(i) { return 4; };
                // Right padding of the cell
                objLayout['paddingRight'] = function(i) { return 4; };
                // Inject the object in the document
                doc.content[1].layout = objLayout;
            } 
        },
        {
            extend: 'print',
			exportOptions: {
                columns: [ 0, 1, 2, 3]
            },
			title: 'RESULTAT CONCOUR BAT LE '+dateAfficher,
            
        },
    ],

    "language": {

        "sSearch": "Recherche:",
        "sInfo": "Affiche _START_ à _END_ de _TOTAL_ entrées",
        
        "oPaginate":{
            
            "sNext": "Suivant",
            "sPrevious": "Avant"

        }

    },

    "ordering": false
});
