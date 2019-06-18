'use strict'

var form_new_supplier = document.forms['form-new-supplier'];
var msg_result = document.getElementById('msg-result');
var tbody_suppliers = document.getElementById('tbody-suppliers');

form_new_supplier.addEventListener('submit', function(e) {
    e.preventDefault();
    
    $.ajax({
      method: "POST",
      url: "server/AddSupplier.php",
      dataType: "JSON",
      data: { 
          id: form_new_supplier.elements['id'].value, 
          name: form_new_supplier.elements['name'].value 
      },
      statusCode: {
        201: function(row) {
          successMsg(msg_result, 'Supplier "' + row.name + '" inserted successfully.');
          //newTableRow(tbody_suppliers, row);
        },
        400: function() {
          dangerMsg(msg_result, '400 - Could not add the supplier, please check the information submitted.');
        },
        404: function() {
          dangerMsg(msg_result, '404 - Could not add the supplier.');
        },
        409: function() {
          dangerMsg(msg_result, '409 - A supplier with this id already exists.');
        },
        500: function(err) {
          dangerMsg(msg_result, '500 - Could not add the supplier. Internal error.');
          console.log(err)
        },
        503: function(err) {
          dangerMsg(msg_result, '503 - Could not add the supplier. Internal error.');
          console.log(err.responseText)
        }
      }
    })
})