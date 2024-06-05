<!DOCTYPE html>
<html lang="en" class="h-full bg-violet-100">

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

<body class="flex justify-center items-center h-screen text-center">
    <div class="form-auth w-4/5 md:w-2/3 lg:w-1/3  bg-white rounded-lg shadow-md h-2/3"> 
        <div class="mb-4 text-center 2xl:mt-12">
            <h3 class="text-3xl font-bold mt-2  py-6 2xl:text-4xl">Register</h3> 
        </div>
        <div class="">
            <form action="" method="post">
                <div class="mb-4 mx-10 text-sm sm:text-base 2xl:mt-10">
                    <input type="name" placeholder="Enter Name:" name="name"
                        class="w-full mb-3 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500">
                    <input type="email" placeholder="Enter Email:" name="email"
                        class="w-full mb-3 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500">
                    <input type="password" placeholder="Enter Password:" name="password"
                        class="w-full mb-3 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500">
                    <input type="password" placeholder="Enter Confirm Password:" name="confirm-password"
                        class="w-full mb-5 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-violet-500">
                        <button class="text-center p-2 bg-violet-600 w-full rounded-lg text-white font-semibold hover:bg-violet-700">Register</button> 
                    </div>
            </form>
            <div class="mt-5 text-center text-sm md:text-base">
                <p>Already Registered? <a href="/login" class="text-violet-700 hover:underline md:font-medium">Login Here!</a>
                </p>
            </div>
        </div>
    </div>
    
</body>

</html>
