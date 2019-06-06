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

    var sum = 0

    $('.sub-total').each(function () {
        var value = $(this).text();
        sum += parseInt(value)
        total = sum.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        $('#total').val(total)
        $('.grand-total').val(total)
        $('.grand-total').html(total)
    })

    $('#discount').keyup(function () {
        var grandTotal = sum - (sum * $(this).val() / 100)
        grandTotal = grandTotal.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
        $('.grand-total').val(grandTotal)
        $('.grand-total').html(grandTotal)
    })

    $('#cash').keyup(function () {
        
    })

    $('#btn-submit').click(function () {
        var sellingCode = $('#selling-code').text()
        var sellingDate = $('#selling-date').val()
        var sellingTime = $('#selling-time').val()
        var customerId = $('#customer :selected').val()
        var cashierId = $('#cashier').val()
        var discount = $('#discount').val()
        var note = $('#note').val()
        var _token = $('input[name="_token"]').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "insert",
            method: "POST",
            data: {
                sellingCode: sellingCode,
                sellingDate: sellingDate,
                sellingTime: sellingTime,
                customerId: customerId,
                cashierId: cashierId,
                discount: discount,
                note: note,
                _token: _token
            },
            success: data => {
                if (data == 1) {
                    window.location.href = "/transaction/selling";
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        })


    })

})