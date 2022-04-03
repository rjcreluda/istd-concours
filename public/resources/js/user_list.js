/*=================================
=            datatable            =
=================================*/
let title = 'Liste des Utilisateurs';
let column = [0, 1, 2];

$('#tableUser').DataTable({
    dom: 'Bfrtip',
    buttons: [
       
        {
            extend: 'copy',
			title: title,
            exportOptions: {
                columns: column
            }
        },
        {
            extend: 'csv',
			title: title,
            exportOptions: {
                columns: column
            }
        },
        {
            extend: 'excel',
            title: title,
            exportOptions: {
                columns: column
            }
            
        },
        {
            extend: 'pdf',
            title: title,
            exportOptions: {
                columns: column,
                
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
			title: title,
            exportOptions: {
                columns: column
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