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