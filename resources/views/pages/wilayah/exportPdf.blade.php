<!DOCTYPE html>
<html>
<head>
    <title>Export Wilayah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
    <h1>Data Wilayah</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>ID Parent</th>
                <th>Level</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wilayahs as $index => $wilayah)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $wilayah->nama }}</td>
                    <td>{{ $wilayah->id_parent }}</td>
                    <td>{{ $wilayah->level }}</td>
                </tr>
                @if ($wilayah->children->isNotEmpty())
                    @foreach ($wilayah->children as $child)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $child->nama }}</td>
                            <td>{{ $child->id_parent }}</td>
                            <td>{{ $child->level }}</td>
                        </tr>
                    @endforeach
                @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>
