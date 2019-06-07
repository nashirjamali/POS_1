$(document).ready(function () {
    
    $('.btn-select').click(function () {

        var $row = $(this).closest("tr"),
            $tds = $row.find("td:nth-child(1)")

        $.each($tds, function () {
            $('#item_code').val($(this).text())
        });

        var itemCode = $('#item_code').val()
        var shopId = $('#shop').children('option:selected').val()
        var _token = $('input[name="_token"]').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $.ajax({
            url: "check-stock",
            method: "POST",
            data: {
                shopId: shopId,
                itemCode: itemCode,
                _token: _token
            },
            success: data => {
                if (data.length != 0) {
                    $('#stock').val(data[0].stock)
                }
                if (data.length == 0) {
                    $('#stock').val(0)
                    $('#detail').attr('disabled', 'disabled');
                    $('#qty').attr('disabled', 'disabled');
                    $('#btn-submit').attr('disabled', 'disabled');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        })

    })
})