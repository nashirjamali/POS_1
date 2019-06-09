<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @foreach($sellings as $key)
    {{ $key->code }} <br>
    {{ $key->date }} <br>
    {{ $key->time }}
    @endforeach
    <br><br>
    <table border="0">
        <thead>
            <tr>
                <th align="left">Item</th>
                <th align="right">Qty</th>
                <th align="right">Disc</th>
                <th align="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($selling_details as $key)
            <tr>
                <td align="left">{{ $key->name }}</td>
                <td align="right">{{ $key->qty }}</td>
                <td align="right">{{ $key->discount }} %</td>
                <td align="right">{{ $key->total }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">================================</td>
            </tr>
            @foreach($sellings as $key)
            <tr>
                <td align="right" colspan="2">Sub Total</td>
                <td align="right" colspan="2">Rp {{ $key->sub_total }}</td>
            </tr>
            <tr>
                <td align="right" colspan="2">Disc</td>
                <td align="right" colspan="2">{{ $key->discount }} %</td>
            </tr>
            <tr>
                <td align="right" colspan="2">Total</td>
                <td align="right" colspan="2">Rp {{ $key->grand_total }}</td>
            </tr>
            <tr>
                <td colspan="4"><br></td>
            </tr>
            <tr>
                <td align="right" colspan="2">Cash</td>
                <td align="right" colspan="2">Rp {{ $key->cash }}</td>
            </tr>
            <tr>
                <td align="right" colspan="2">Change</td>
                <td align="right" colspan="2">Rp {{ $key->change }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
    <br><br>
    <hr>
    <center>Terima Kasih :)</center>

</body>

</html>