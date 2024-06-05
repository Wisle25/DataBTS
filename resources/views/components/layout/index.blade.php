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

<body>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">

        @include('components.layout.sidebar')
        <div class="flex flex-col flex-1 overflow-hidden">

            @include('components.layout.header')
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white">
                <div class="container px-2 py-4 lg:px-6 mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>

</html>
