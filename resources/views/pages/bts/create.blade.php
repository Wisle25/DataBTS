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
            @csrf
            <h1 class="text-2xl font-semibold text-center text-gray-900 mt-3 mb-3">Tambah Data BTS</h1>
            <form action='{{ url('/bts') }}' method='post'>
                <x-form.form-input id="nama" label="Nama" name="nama" />
                <x-form.form-input id="alamat" label="Alamat" name="alamat" />
                <x-form.form-input id="latitude" label="Latitude" name="latitude" type="number" step="any" />
                <x-form.form-input id="longitude" label="Longitude" name="longitude" type="number" step="any" />
                <x-form.form-input id="tinggi_tower" label="Tinggi Tower" name="tinggi_tower" type="number" step="any" />
                <x-form.form-input id="panjang_tanah" label="Panjang Tanah" name="panjang_tanah" type="number" step="any" />
                <x-form.form-input id="lebar_tanah" label="Lebar Tanah" name="lebar_tanah" type="number" step="any" />
                <!-- Menambahkan penutupan tag pada elemen berikut -->
                <x-form.form-select id="ada_genset" label="Ada Genset" name="ada_genset" :options="['yes' => 'Yes', 'no' => 'No']" />
                <x-form.form-select id="ada_tembok_batas" label="Ada Tembok Batas" name="ada_tembok_batas" :options="['yes' => 'Yes', 'no' => 'No']" />

                <button type="submit" name="submit"
                    class="w-32 bg-gradient-to-r from-cyan-400 to-cyan-700 text-white py-2 rounded-lg mx-auto block focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 mb-2">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>
