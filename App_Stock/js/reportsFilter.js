$(function () {
    var dateFormat = "yy-mm-dd",
        dtMin = $("#_dtMin")
        .datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1
        })
        .on("change", function () {
            dtMax.datepicker("option", "minDate", getDate(this));
        }),
        dtMax = $("#_dtMax").datepicker({
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
});