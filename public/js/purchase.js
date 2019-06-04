$(document).ready(function () {


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
        $('.total-invoice').val(total)
        $('.total-invoice').html(total)
    })


    // Purchase
    var today = new Date().toISOString().substr(0, 10)
    $('#purchase-date').val(today)

    var now = new Date().toTimeString()
    var nowStr = now.split(" ")
    $('#purchase-time').val(nowStr[0])
    console.log(nowStr[0])


    // Insert To Table Purchase
    $('#btn-submit').click(function () {
        var purchaseCode = $('#purchase-code').text()
        var purchaseDate = $('#purchase-date').val()
        var purchaseTime = $('#purchase-time').val()
        var supplierId = $('#supplier :selected').val()
        var shopId = $('#shop :selected').val()
        var grandTotal = sum
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
                purchaseCode: purchaseCode,
                purchaseDate: purchaseDate,
                purchaseTime: purchaseTime,
                supplierId: supplierId,
                shopId: shopId,
                grandTotal: grandTotal,
                note: note,
                _token: _token
            },
            success: data => {
                data
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        })
    })
    
})