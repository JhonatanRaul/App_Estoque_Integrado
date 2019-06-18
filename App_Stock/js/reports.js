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
    
    $("#accordion").accordion({
        collapsible: true
    });
    // Fim dos scripts iniciais para renderização padrão
    
    // Scripts para ajuste do filtro
    var form_reports_filter = document.forms['form-reports-filter'];
    var msg_result = document.getElementById('msg-result');
    var tbody_reports = document.getElementById('tbody-reports');
    
    var url_string = window.location.href;
    var url = new URL(url_string);
    var newParams = '';
    
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
    
    function assertParams(url){
        var params = {
            material: url.searchParams.get("material"),
            supplier: url.searchParams.get("supplier"),
            _dtMin: url.searchParams.get("_dtMin"),
            _dtMax: url.searchParams.get("_dtMax"),
            _avgUcMin: url.searchParams.get("_avgUcMin"),
            _avgUcMax: url.searchParams.get("_avgUcMax")
        }
        
        if((params.material != null && params.material != '') || (params.supplier != null && params.supplier != '') || (params._dtMin != null && params._dtMin != '') || (params._dtMax != null && params._dtMax != '') || (params._avgUcMin != null && params._avgUcMin != '') || (params._avgUcMax != null && params._avgUcMax != '')){
            // Tem pelo menos 1 parâmetro
            newParams = '?';
                        
            if(params.material != null && params.material != ''){
                newParams = assertNewParams("material", newParams, params.material);
                newFormValue("material", params.material);
            }

            if(params.supplier != null && params.supplier != ''){
                newParams = assertNewParams("supplier", newParams, params.supplier);
                newFormValue("supplier", params.supplier);
            }

            if(params._dtMin != null && params._dtMin != ''){
                newParams = assertNewParams("_dtMin", newParams, params._dtMin);
                $( "#_dtMin" ).datepicker( "setDate", getDateInFormatBR(new Date(params._dtMin)) );
            }

            if(params._dtMax != null && params._dtMax != ''){
                newParams = assertNewParams("_dtMax", newParams, params._dtMax);
                $( "#_dtMax" ).datepicker( "setDate", getDateInFormatBR(new Date(params._dtMax)) );
            }

            if(params._avgUcMin != null && params._avgUcMin != ''){
                newParams = assertNewParams("_avgUcMin", newParams, params._avgUcMin);
                newFormValue("_avgUcMin", params._avgUcMin);
            }

            if(params._avgUcMax != null && params._avgUcMax != ''){
                newParams = assertNewParams("_avgUcMax", newParams, params._avgUcMax);
                newFormValue("_avgUcMax", params._avgUcMax);
            }
        } else {
            return;
        }
    }
    
    assertParams(url);
    
    $.ajax({
      method: "GET",
      url: "server/Reports.php" + newParams,
      statusCode: {
        200: (data) => {
          successMsg(msg_result, 'The report was successfully generated.');
            // Se tiver supplier adicionar ele no thead
          data.forEach((e, i, array) => {
            data[i].btn = '<button>DETAILS</button>';
            data[i].AVG_UNIT_COST = '$ ' + data[i].AVG_UNIT_COST;
            newTableRow(tbody_reports, data[i]);
          });
        },
        500: (err) => {
          dangerMsg(msg_result, '500 - Could not perform query. Internal error.');
          console.log(err)
        },
        503:  (err) => {
          dangerMsg(msg_result, '503 - Could not perform query. Internal error.');
          console.log(err.responseText)
        }
      }
    })
    // Fim dos scripts para ajuste do filtro
});


setTimeout(() => {
    var curDate = $('#_dtMin').datepicker( "getDate" );
    getDateInFormat(curDate);
}, 2000)

