$(document).ready(function () {
    var today = new Date().toISOString().substr(0, 10)
    $('#selling-date').val(today)

    var now = new Date().toTimeString()
    var nowStr = now.split(" ")
    $('#selling-time').val(nowStr[0])

    $('.btn-select').click(function () {
        var $row = $(this).closest("tr"),
            $tds = $row.find("td:nth-child(1)")

        $.each($tds, function () {
            $('#item_code').val($(this).text())
        });
    })

})