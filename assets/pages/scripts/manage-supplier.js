var TableDatatables = function(){
    var handleSupplierTable = function(){
        var SupplierTable = $("#supplier_list");
        
        var oTable = SupplierTable.dataTable({
           "processing":true,
            "serverSide":true,
            "ajax":{
                url:
                "http://localhost/erp/pages/scripts/supplier/manage.php",
                type: "POST",
            },
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 25, "All"]
            ],
            "pageLength": 15,//set the default length
            "order":[
                [0,"desc"]
            ],
            "columnsDefs":[{
                'orderable':false,
                'targets':[-1,-2]
            }]
        });
        SupplierTable.on('click', '.edit', function (e) {
            $id = $(this).attr('id');
            $("#edit_supplier_id").val($id);
            
            //fetching all the other values from database using ajax and loading them onto their respective edit fields!
            $.ajax({
                url: "http://localhost/erp/pages/scripts/supplier/fetch.php",
                method: "POST",
                data: {supplier_id: $id},
                dataType: "json",
                success: function(data){
                    $("#supplier_name").val(data.supplier_name);
                    $("#supplier_address").val(data.supplier_address);
                    $("#supplier_email").val(data.supplier_email);
                    $("#supplier_contact").val(data.supplier_contact);
                    $("#gst_no").val(data.gst_no);
                    
                    $("#editModal").modal('show');
                    
                },
            });

        });
        SupplierTable.on('click', '.delete', function (e) {
            $id = $(this).attr('id');
            $("#recordID").val($id);
        });
    }
    return{
        //Main func in javascript to handle all he intialisation part
        init: function(){
            handleSupplierTable();
        }
    };
}();
jQuery(document).ready(function(){
    TableDatatables.init();
});