$("#example-table").tabulator({
            height:205, // set height of table, this enables the Virtual DOM and improves render speed dramatically (can be any valid css height value)
            layout:"fitColumns", //fit columns to width of table (optional)
            columns:[ //Define Table Columns
                {title:"Nom", field:"nom"},
                {title:"Prenom", field:"prenom"},
                {title:"<input id='select-all' type='checkbox'/>", 
                                    field:"sup",
                                    formatter:"tickCross",
                                    //sorter:"boolean",
                                    //editor:true,
                                    //headerSort:false,
                                    cellClick:function(e, cell){
                                              
                                              cell.setValue(!cell.getValue());
                                        return false;
                                        }
                }
            ],
            rowClick:function(e, row){ //trigger an alert message when the row is clicked
                //alert("Row " + row.getData().id + " Clicked!!!!");
            }
        });

$("#select-all").on("change", function(){
    var dataUpdate = [];
    var productData = $("#example-table").tabulator("getData");
    
    if($(this).prop( "checked" )){
     $.each(productData, function (i, item) {
                    var obj = {
                                "id":item.id,
                                "nom":item.nom,
                                "prenom":item.prenom,
                                "sup":false
                              };
                    dataUpdate.push(obj);
            });
    }
    else {
            $.each(productData, function (i, item) {
                              var obj = {
                                          "id":item.id,
                                          "nom":item.nom,
                                          "prenom":item.prenom,
                                          "sup":true
                                        };
                              dataUpdate.push(obj);
                      });
        }
    $("#example-table").tabulator("updateData", dataUpdate);
 });