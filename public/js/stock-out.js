$(document).ready(function () {
    $('#btn-search').click(function (p) {
        var shopId = $('#shop').children('option:selected').val()
        alert(shopId)
    })
})