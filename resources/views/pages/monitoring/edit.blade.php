<!DOCTYPE html>
<html lang="en">

<head class="h-full">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master Data BTS</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 py-10">
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-1/2 p-6 bg-white rounded-lg shadow-lg">
            <h1 class="text-2xl font-semibold text-center text-gray-900 mt-3 mb-3">Edit Data Monitoring</h1>
            @include('components.allert.danger')
            <form action='{{ route("monitoring.update", $monitoring->id) }}' method='POST'>
                @csrf
                @method('PUT')
                <x-form.form-input id="tahun" label="Pilih Tahun" name="tahun" type="number" step="any" value="{{ old('tahun', $monitoring->tahun) }}" />
                <x-form.form-input id="id_bts" label="ID BTS" name="id_bts" type="number" value="{{ old('id_bts', $monitoring->id_bts) }}" />
                    <x-form.form-input id="tgl_kunjungan" label="Tanggal Kunjungan" name="tgl_kunjungan" type="date" value="{{ old('tgl_kunjungan', $monitoring->tgl_kunjungan) }}" />
                    <x-form.form-input id="tgl_generate" label="Tanggal Generate" name="tgl_generate" type="date" value="{{ old('tgl_generate', $monitoring->tgl_generate) }}" />
                <x-form.form-select id="id_kondisi_bts" label="Kondisi BTS" name="id_kondisi_bts" :options="[1 => 'Normal', 2 => 'Fault', 3 => 'Maintance', 4 => 'Offline']" value="{{ $errors->has('id_kondisi_bts') ? '' : old('id_kondisi_bts') }}"/>
                <button type="submit" name="submit" class="w-32 bg-gradient-to-r from-cyan-400 to-cyan-700 text-white py-2 rounded-lg mx-auto block focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 mb-2">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>
