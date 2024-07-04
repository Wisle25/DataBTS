<!DOCTYPE html>
<html>
<head>
    <title>Export Pemilik BTS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
    <h1>Data Pemilik BTS</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemilik as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->telepon }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
