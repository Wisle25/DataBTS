<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

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
            <h1 class="text-2xl font-semibold text-center text-gray-900 mt-3 mb-3">Edit Role Pengguna</h1>
            @include('components.allert.danger')
            <form action='{{ route("pengguna.update", $pengguna->id) }}' method="POST">
                @csrf
                @method("PUT")
                <x-form.form-select id="peran" label="Peran" name="peran" :options="['User' => 'User', 'Administrator' => 'Administrator', 'PIC' => 'PIC', 'Surveyor' => 'Surveyor']" value="{{ $errors->has('peran') ? '' : old('peran') }}"/>
                <button type="submit" class="w-32 bg-gradient-to-r from-cyan-400 to-cyan-700 text-white py-2 rounded-lg mx-auto block focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 mb-2">
                    Simpan
                </button>
            </form>            
        </div>
    </div>
</body>

</html>
