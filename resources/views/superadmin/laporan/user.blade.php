<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <table border=0 width="100%">
        <tr>
            <td width="15%" style="text-align: right">
                <img src="/logo/kandangan.png" width="60%">
            </td>
            <td style="text-align: center">
                <b>PENGAJUAN BANTUAN BIBIT PERKEBUNAN PADA DINAS PERTANIAN<br/>
                    KABUPATEN HULU SUNGAI SELATAN<br/>
                KALIMANTAN SELATAN<br/></b>
                Alamat: Jl. Singakarsa No.38, Kandangan Bar., Kec. Kandangan, Kabupaten Hulu Sungai Selatan, Kalimantan Selatan 71213
                

            </td>
            <td width="15%" style="text-align: right">
                
            </td>
        </tr>
        <tr>
            <td colspan=3 style="text-align:center"><br/><strong><u>LAPORAN USER</u></strong></td>
        </tr>
    </table>
    <br/>
    <table border=1 cellspacing="0" cellpadding="3" width="100%">
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Username</th>
        </tr>
        @php
            $no =1;
        @endphp
        @foreach ($data as $key => $item)
            <tr>
                <td style="text-align: center">{{$no++}}</td>
                <td style="text-align: center">{{$item->name}}</td>
                <td style="text-align: center">{{$item->username}}</td>
                
            </tr>
        @endforeach
    </table>
    <br/>
    <table width="100%">
        <tr>
            <td width="60%"></td>
            <td>
                Kandangan, {{\Carbon\Carbon::today()->translatedFormat('d F Y')}}, <br/>
                Dinas Pertanian<br/>
                Kepala,
                <br/><br/><br/><br/><br/>


                <b><u>Riyadi Bayu</u></b><br/>
                NIP. 19278979274981273

            </td>
        </tr>
    </table>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>

$(document).ready(function(){
    window.print();
});
</script>
</html>