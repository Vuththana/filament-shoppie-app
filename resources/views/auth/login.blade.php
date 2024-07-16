<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @vite('resources/css/app.css')
</head>
<body>
<div class="login-wrapper">
        <div class="g-screen max-w-screen-sm sm:max-w-full min-h-[60px] relative row sm:min-h-[300px] bg-blue-800">
            <!---->
        </div>
    <div class="relative w-full md:min-h-0 sm:top-[-200px] sm:w-[600px] mx-auto">
        <div class="flex flex-col justify-center items-center border rounded-lg bg-slate-100 py-7">
            <div class="signIn-title text-center text-3xl font-semibold mb-10 mt-10">
                <h1>Sign In</h1>
            </div>
            <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="email-wrapper">
                    <label for="email" class="block mb-2 text-sm font-medium text-slate-500">Email</label>
                    <input type="email" name="email" id="email" class="w-full sm:w-[500px] bg-gray-50 border-gray-400 border p-2.5 rounded-lg focus:outline-none focus:shadow-lg">
                </div>
                <div class="password-wrapper">
                    <label for="password" class="block mb-2 mt-3 text-sm font-medium text-slate-500">Password</label>
                    <input type="password" name="password" id="password" class="w-full sm:w-[500px] bg-gray-50 border-gray-400 border p-2.5 rounded-lg focus:outline-none focus:shadow-lg">
                </div>
                <div class="register-wrapper">
                    <a class="text-blue-400 text-sm underline" href="{{ route('register') }}">Create an account?</a>
                </div>
                <div class="submit-wrapper place-items-center mt-5">
                    <a href="/" class="border py-[9px] px-4  border-slate-300 bg-slate-100 rounded text-md hover:bg-slate-200 duration-300">Continue as guest</a>
                    <input type="submit" class="border py-2 px-4 rounded text-md font-semibold bg-blue-500 text-white hover:bg-blue-400 cursor-pointer duration-300" value="Login">
                </div>

            </form>
        </div>
    </div>

    <footer class="bg-800 text-black py-8">
    @include('components.footer')
   </footer>
</body>
</html>