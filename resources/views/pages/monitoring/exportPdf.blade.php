<!DOCTYPE html>
<html>
<head>
    <title>Export Monitoring</title>
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
    <h1>Data Monitoring</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>ID BTS</th>
                <th>Tanggal Generate</th>
                <th>Tanggal Kunjungan</th>
                <th>Kondisi BTS</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Created By</th>
                <th>Edited By</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($monitorings as $index => $monitoring)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $monitoring->tahun }}</td>
                    <td>{{ $monitoring->bts->nama }}</td>
                    <td>{{ $monitoring->tgl_generate }}</td>
                    <td>{{ $monitoring->tgl_kunjungan }}</td>
                    <td>{{ $monitoring->kondisi_bts->nama }}</td>
                    <td>{{ $monitoring->created_at }}</td>
                    <td>{{ $monitoring->updated_at }}</td>
                    <td>{{ $monitoring->created_by }}</td>
                    <td>{{ $monitoring->edited_by ? $monitoring->edited_by : 'Tidak ada' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
