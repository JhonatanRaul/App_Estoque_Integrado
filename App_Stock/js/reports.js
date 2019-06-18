var newParams = '';

$(function () {
    // Scripts iniciais para renderização padrão
    var dateFormat = "mm-dd-yy",
        dtMin = $("#_dtMin")
        .datepicker({
            dateFormat: "dd/mm/yy",
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1
        })
        .on("change", function () {
            dtMax.datepicker("option", "minDate", getDate(this));
        }),
        dtMax = $("#_dtMax").datepicker({
            dateFormat: "dd/mm/yy",
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1
        })
        .on("change", function () {
            dtMin.datepicker("option", "maxDate", getDate(this));
        });

    function getDate(element) {
        var date;
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }

        return date;
    }
    
    setTimeout(function(){
        document.getElementById('accordion').classList.remove('d-none');
        $("#accordion").accordion({
            active: false,
            collapsible: true
        });
    }, 0)
    // Fim dos scripts iniciais para renderização padrão
    
    // Scripts para ajuste do filtro
    var form_reports_filter = document.forms['form-reports-filter'];
    var msg_result = document.getElementById('msg-result');
    var tbody_reports = document.getElementById('tbody-reports');
    
    var url_string = window.location.href;
    var url = new URL(url_string);
    
    function assertNewParams(e, newParams, param){
        var latest = newParams.charAt(newParams.length-1);
        if(latest != '?')
            newParams += '&' + e + '=' + param;
        else
            newParams = '?' + e + '=' + param;
                
        return newParams;
    }
    
    function newFormValue(e, v){
        form_reports_filter.elements[e].value = v;
    }
    
    function assertParams(url, i){
        if(i){
            var params = {
                material: url.searchParams.get("material"),
                supplier: url.searchParams.get("supplier"),
                _dtMin: url.searchParams.get("_dtMin"),
                _dtMax: url.searchParams.get("_dtMax"),
                _avgUcMin: url.searchParams.get("_avgUcMin"),
                _avgUcMax: url.searchParams.get("_avgUcMax")
            }
        } else {
            var params = url;
            params._dtMin = getDateInFormat($( "#_dtMin" ).datepicker( "getDate" ));
            params._dtMax = getDateInFormat($( "#_dtMax" ).datepicker( "getDate" ));
        }
        
        if((params.material != null && params.material != '') || (params.supplier != null && params.supplier != '') || (params._dtMin != null && params._dtMin != '') || (params._dtMax != null && params._dtMax != '') || (params._avgUcMin != null && params._avgUcMin != '') || (params._avgUcMax != null && params._avgUcMax != '')){
            // Tem pelo menos 1 parâmetro
            newParams = '?';
                        
            if(params.material != null && params.material != ''){
                newParams = assertNewParams("material", newParams, params.material);
                if(i)
                    newFormValue("material", params.material);
            }

            if(params.supplier != null && params.supplier != ''){
                newParams = assertNewParams("supplier", newParams, params.supplier);
                if(i)
                    newFormValue("supplier", params.supplier);
            }

            if(params._dtMin != null && params._dtMin != ''){
                if(i) {
                    newParams = assertNewParams("_dtMin", newParams, params._dtMin);
                    $( "#_dtMin" ).datepicker( "setDate", getDateInFormatBR(new Date(params._dtMin)) );
                } else {
                    newParams = assertNewParams("_dtMin", newParams, params._dtMin);
                }
                    
            }

            if(params._dtMax != null && params._dtMax != ''){
                newParams = assertNewParams("_dtMax", newParams, params._dtMax);
                if(i)
                    $( "#_dtMax" ).datepicker( "setDate", getDateInFormatBR(new Date(params._dtMax)) );
            }

            if(params._avgUcMin != null && params._avgUcMin != ''){
                newParams = assertNewParams("_avgUcMin", newParams, params._avgUcMin);
                if(i)
                    newFormValue("_avgUcMin", params._avgUcMin);
            }

            if(params._avgUcMax != null && params._avgUcMax != ''){
                newParams = assertNewParams("_avgUcMax", newParams, params._avgUcMax);
                if(i)
                    newFormValue("_avgUcMax", params._avgUcMax);
            }
            
            return newParams;
        } else {
            return;
        }
    }
    
    assertParams(url, true);
    
    $.ajax({
      method: "GET",
      url: "server/Reports.php" + newParams,
      statusCode: {
        200: function(data) {
          successMsg(msg_result, 'The report was successfully generated.');
          data.forEach(function(e, i, array) {
            delete data[i].ID_SUPPLIER;
            delete data[i].SUPPLIER;
            data[i].btn = '<button>DETAILS</button>';
            data[i].AVG_UNIT_COST = '$ ' + data[i].AVG_UNIT_COST;
            newTableRow(tbody_reports, data[i]);
          });
        },
        500: function(err) {
          dangerMsg(msg_result, '500 - Could not perform query. Internal error.');
          console.log(err)
        },
        503: function(err) {
          dangerMsg(msg_result, '503 - Could not perform query. Internal error.');
          console.log(err.responseText)
        }
      }
    })
    // Fim dos scripts para ajuste do filtro
    
    // Send form
    form_reports_filter.addEventListener('submit', function(e) {
        e.preventDefault();
        
        var data = {
            material: this.elements['material'].value,
            supplier: this.elements['supplier'].value,
            _dtMin: this.elements['_dtMin'].value,
            _dtMax: this.elements['_dtMax'].value,
            _avgUcMin: this.elements['_avgUcMin'].value,
            _avgUcMax: this.elements['_avgUcMax'].value,
        }
        
        newParams = '';
        assertParams(data, false);
        
        $.ajax({
          method: "GET",
          url: "server/Reports.php" + newParams,
          statusCode: {
            200: function(data) {
              successMsg(msg_result, 'The report was successfully generated.');
              tbody_reports.innerHTML = '';
              data.forEach(function(e, i, array) {
                delete data[i].ID_SUPPLIER;
                delete data[i].SUPPLIER;
                data[i].btn = '<button>DETAILS</button>';
                data[i].AVG_UNIT_COST = '$ ' + data[i].AVG_UNIT_COST;
                newTableRow(tbody_reports, data[i]);
              });
            },
            500: function(err) {
              dangerMsg(msg_result, '500 - Could not perform query. Internal error.');
              console.log(err)
            },
            503: function(err) {
              dangerMsg(msg_result, '503 - Could not perform query. Internal error.');
              console.log(err.responseText)
            }
          }
        });
    });
});


setTimeout(function (){
    var curDate = $('#_dtMin').datepicker( "getDate" );
    getDateInFormat(curDate);
}, 2000)

