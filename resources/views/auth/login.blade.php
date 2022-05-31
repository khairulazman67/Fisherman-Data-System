<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Login</title>
</head>
<body class="bg-blue-50">
    <div class="container mx-auto">
        <!-- tulisan atas -->
        <div class="mt-20">
            <div class="flex justify-center text-secondary-900 font-bold text-4xl bg-primary-800 rounded-3xl mx-28 mb-10 py-4">
                SISTEM PENDATAAN NELAYAN
            </div>
        </div>
        <div class="flex mx-44 relative">
            <div class="mt-20 text-secondary-900">
                <h1 class="text-[40px] font-bold mb-5">Login</h1>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                        <div>
                            <div class="text-xl">
                                <label for="fname" class="font-semibold  text-xl">Email :</label><br>
                                <input type="email" :value="old('email')" id="email" name="email" class="border-2 rounded-lg border-primary-800 hover:border-primary-900 h-10 w-96 p-5"><br>
                            </div>
                            <div class="mt-4  text-xl">
                                <label for="fname" class="font-semibold ">Password :</label><br>
                                <input type="password" id="password" name="password" class="border-2 rounded-lg border-primary-800 hover:border-primary-900 h-10 w-96 p-5" required autocomplete="current-password"><br>
                            </div>
                            <button class="bg-primary-700 rounded-xl py-3 mt-4 px-11 text-white font-bold hover:bg-primary-900"  type="submit" >
                                {{ __('Log in') }}
                            </button>
                        </div>
                        
                        <div class="absolute inset-y-0 -right-5">
                            <img src="{{asset('img/ILUS.png') }}" alt="" class="mt-11 ml-8 w-[550px]">
                        </div>  
                </form>
            </div>
            
        </div>
    </div>
</body>
</html>