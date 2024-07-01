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
            <h1 class="text-2xl font-semibold text-center text-gray-900 mt-3 mb-3">Tambah Data BTS</h1>
            @include('components.allert.danger')
            <form action='{{ route('bts.store') }}' method='post' enctype="multipart/form-data">
                @csrf
                <x-form.form-input id="nama" label="Nama" name="nama" value="{{ $errors->has('nama') ? '' : old('nama') }}" />
                <x-form.form-input id="alamat" label="Alamat" name="alamat" value="{{ $errors->has('alamat') ? '' : old('alamat') }}" />
                <x-form.form-input id="latitude" label="Latitude" name="latitude" type="number" step="any" value="{{ $errors->has('latitude') ? '' : old('latitude') }}" />
                <x-form.form-input id="longitude" label="Longitude" name="longitude" type="number" step="any" value="{{ $errors->has('longitude') ? '' : old('longitude') }}" />
                <x-form.form-input id="tinggi_tower" label="Tinggi Tower" name="tinggi_tower" type="number" step="any" value="{{ $errors->has('tinggi_tower') ? '' : old('tinggi_tower') }}" />
                <x-form.form-input id="panjang_tanah" label="Panjang Tanah" name="panjang_tanah" type="number" step="any" value="{{ $errors->has('panjang_tanah') ? '' : old('panjang_tanah') }}" />
                <x-form.form-input id="lebar_tanah" label="Lebar Tanah" name="lebar_tanah" type="number" step="any" value="{{ $errors->has('lebar_tanah') ? '' : old('lebar_tanah') }}" />
                <x-form.form-select id="ada_genset" label="Ada Genset" name="ada_genset" :options="[1 => 'Yes', 0 => 'No']" selected="{{ $errors->has('ada_genset') ? '' : old('ada_genset') }}" />
                <x-form.form-select id="ada_tembok_batas" label="Ada Tembok Batas" name="ada_tembok_batas" :options="[1 => 'Yes', 0 => 'No']" selected="{{ $errors->has('ada_tembok_batas') ? '' : old('ada_tembok_batas') }}" />
                    <x-form.form-input id="path_foto" label="Foto" name="path_foto" type="file" />
                <x-form.form-input id="id_jenis_bts" label="ID Jenis BTS" name="id_jenis_bts" type="number" step="any" value="{{ $errors->has('id_jenis_bts') ? '' : old('id_jenis_bts') }}" />
                <x-form.form-input id="id_pemilik" label="ID Pemilik" name="id_pemilik" type="number" step="any" value="{{ $errors->has('id_pemilik') ? '' : old('id_pemilik') }}" />
                <x-form.form-input id="id_wilayah" label="ID Wilayah" name="id_wilayah" type="number" step="any"  value="{{ $errors->has('id_wilayah') ? '' : old('id_wilayah') }}" />

                <button type="submit" name="submit"
                    class="w-32 bg-gradient-to-r from-cyan-400 to-cyan-700 text-white py-2 rounded-lg mx-auto block focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 mb-2">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>
