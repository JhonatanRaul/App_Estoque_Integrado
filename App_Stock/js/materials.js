'use strict'

var form_new_material = document.forms['form-new-material'];
var msg_result = document.getElementById('msg-result');
var tbody_materials = document.getElementById('tbody-materials');

form_new_material.addEventListener('submit', (e) => {
    e.preventDefault();
    
    $.ajax({
      method: "POST",
      url: "server/add-material.php",
      dataType: "JSON",
      data: { 
          id: form_new_material.elements['id'].value, 
          name: form_new_material.elements['name'].value,  
          maximum_cost: form_new_material.elements['maximum-cost'].value 
      },
      statusCode: {
        201: (row) => {
          successMsg(msg_result, 'Material "' + row.name + '" inserted successfully.');
          //newTableRow(tbody_materials, row);
        },
        400: () => {
          dangerMsg(msg_result, '400 - Could not add the material, please check the information submitted.');
        },
        404: () => {
          dangerMsg(msg_result, '404 - Could not add the material.');
        },
        409: () => {
          dangerMsg(msg_result, '409 - A material with this id already exists.');
        },
        500: (err) => {
          dangerMsg(msg_result, '500 - Could not add the material. Internal error.');
          console.log(err)
        },
        503:  (err) => {
          dangerMsg(msg_result, '503 - Could not add the material. Internal error.');
          console.log(err.responseText)
        }
      }
    })
})