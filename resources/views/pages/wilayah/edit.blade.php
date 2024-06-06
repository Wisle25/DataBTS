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
            @method('PUT')
            <h1 class="text-2xl font-semibold text-center text-gray-900 mt-3 mb-3">Edit Data Wilayah</h1>
            {{-- <form action='{{ url('bts/'.$data->id) }}' method='post'> --}}
            <form action='{{ url('/wilayah/edit') }}' method='post'>
                <x-form.form-input id="nama" label="Nama" name="tahun"  type="text" value="{{ old('tahun') }}" />
                <x-form.form-input id="id_parent" label="ID Parent" name="id_parent"  type="number" step="any" value="{{ old('id_parent') }}" />
                <x-form.form-input id="level" label="Level" name=""  type="number" step="any" value="{{ old('level') }}" />

                <button type="submit" name="submit"
                    class="w-32 bg-gradient-to-r from-cyan-400 to-cyan-700 text-white py-2 rounded-lg mx-auto block focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 mb-2">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>
