<!DOCTYPE html>
<html>
<head>
    <title>Export BTS</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Data BTS</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Wilayah</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Tinggi Tower</th>
                <th>Panjang Tanah</th>
                <th>Lebar Tanah</th>
                <th>Pemilik</th>
                <th>Jenis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $bts)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $bts->nama }}</td>
                    <td>{{ $bts->alamat }}</td>
                    <td>{{ $bts->wilayah->nama }}</td>
                    <td>{{ $bts->latitude }}</td>
                    <td>{{ $bts->longitude }}</td>
                    <td>{{ $bts->tinggi_tower }}</td>
                    <td>{{ $bts->panjang_tanah }}</td>
                    <td>{{ $bts->lebar_tanah }}</td>
                    <td>{{ $bts->pemilik->name }}</td>
                    <td>{{ $bts->jenisBTS->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
