/* globals Chart:false, feather:false */

(function () {
    'use strict'

    feather.replace()

}())

function successMsg(e, text) {
    e.innerHTML = text;

    e.classList.remove('d-none');
    e.classList.remove('alert-success');
    e.classList.remove('alert-danger');

    e.classList.add('alert-success');
}

function dangerMsg(e, text) {
    e.innerHTML = text;

    e.classList.remove('d-none');
    e.classList.remove('alert-success');
    e.classList.remove('alert-danger');

    e.classList.add('alert-danger');
}

function newTableRow(tbody, row) {
    var tr = document.createElement('tr');
    tbody.appendChild(tr);

    for (var col in row) {
        var td = document.createElement('td');
        tr.appendChild(td);
        td.innerHTML = row[col];
    }
}

function getDateInFormat(date){
    if(date != '' && date != null && date != undefined && date != NaN){
        var element = new Date(date);
        var dd = element.getDate();
        var mm = element.getMonth() + 1; //January is 0!

        var yyyy = element.getFullYear();
        if (dd < 10) {
          dd = '0' + dd;
        } 
        if (mm < 10) {
          mm = '0' + mm;
        } 
        var newDate = yyyy + '-' + mm + '-' + dd;
        return newDate;
    } else {
        return;
    }
}

function getDateInFormatBR(date){
    if(date != '' && date != null && date != undefined && date != NaN){
        var element = new Date(date);
        var dd = element.getDate() + 1;
        var mm = element.getMonth() + 1; //January is 0!

        var yyyy = element.getFullYear();
        if (dd < 10) {
          dd = '0' + dd;
        } 
        if (mm < 10) {
          mm = '0' + mm;
        } 
        var newDate = dd + '/' + mm + '/' + yyyy
        return newDate;
    } else {
        return;
    }
}