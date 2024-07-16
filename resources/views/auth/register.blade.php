<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="row justify-center">
        <div class="g-screen max-w-screen-sm sm:max-w-full min-h-[60px] relative row sm:min-h-[300px] bg-red-500">
            <!---->
        </div>
        <div class="register-wrapper relative w-full md:min-h-0 sm:top-[-200px] sm:w-[600px] mx-auto">
        <div class="flex flex-col justify-center items-center border rounded-lg bg-slate-100 py-7">
            <div class="signUp-title text-center text-3xl font-semibold mb-10 mt-10">
                <h1>Register an Account</h1>
            </div>
            <form action="{{ route('register') }}" method="POST">
            @csrf
                <div class="name-wrapper">
                    <label for="name" class="block mb-2 text-sm font-medium text-slate-500">Name</label>
                    <input type="name" name="name" id="name" class="w-full sm:w-[500px] bg-gray-50 border-gray-400 border p-2.5 rounded-lg focus:outline-none focus:shadow-lg">
                </div>
                <div class="email-wrapper">
                    <label for="email" class="block mb-2 mt-10 text-sm font-medium text-slate-500">Email</label>
                    <input type="email" name="email" id="email" class="w-full sm:w-[500px] bg-gray-50 border-gray-400 border p-2.5 rounded-lg focus:outline-none focus:shadow-lg">
                    @if($errors->has('email'))
                        <p class="text-red-600">{{ $errors -> first('email') }}</p>
                    @endif 
                </div>
                <div class="password-wrapper">
                    <label for="password" class="block mb-2 mt-10 text-sm font-medium text-slate-500">Password</label>
                    <input type="password" name="password" id="password" class="w-full sm:w-[500px] bg-gray-50 border-gray-400 border p-2.5 rounded-lg focus:outline-none focus:shadow-lg">
                    @if($errors->has('password'))
                        <p class="text-red-600">{{ $errors -> first('password') }}</p>
                    @endif 
                </div>
                <div class="confirmPassword-wrapper">
                    <label for="password_confirmation" class="block mb-2 mt-10 text-sm font-medium text-slate-500">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full sm:w-[500px] bg-gray-50 border-gray-400 border p-2.5 rounded-lg focus:outline-none focus:shadow-lg">
                    @if($errors->has('password'))
                        <p class="text-red-600">{{ $errors -> first('password') }}</p>
                    @endif 
                </div>
                <div class="alreadyHave-wrapper">
                    <a class="text-blue-400 text-sm underline" href="{{ route('login') }}">Already have an account?</a>
                </div>
                <div class="submit-wrapper place-items-center mt-5">
                    <a href="/" class="border py-[9px] px-4  border-slate-300 bg-slate-100 rounded text-md hover:bg-slate-200 duration-300">Continue as guest</a>
                    <input type="submit" class="border py-2 px-4 rounded text-md font-semibold bg-blue-500 text-white hover:bg-blue-400 cursor-pointer duration-300" value="Register">
                </div> 
                </div>
            </form>
        </div>
    </div>

    <footer class="bg-800 text-black py-8">
    @include('components.footer')
   </footer>
</body>
</html>