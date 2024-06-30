<!DOCTYPE html>
<html>
<head>
    <title>Export Jenis BTS</title>
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
    <h1>Data Jenis BTS</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jenisBTS as $index => $jenis)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $jenis->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
