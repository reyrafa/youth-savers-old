<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('includes.extempt')
    <link rel="shortcut icon" href="/img/YSC Logo.jpg" type="image/x-icon">
     <!--font awesome-->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
     <script src="https://kit.fontawesome.com/42503fd6c6.js" crossorigin="anonymous"></script>
     
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!--css-->
    <link rel="stylesheet" href="/css/style.css">

    <!--font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <!--jquery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>Youth Savers Club Laboratory Cooperative Online Membership</title>
</head>
<style>
    body{
        background: url(/img/image1.jpg);
        background-size: cover;
    }
    #email:focus, #password:focus{
        outline: none;
        box-shadow: 0 0 0 0;
    }

    #login{
    display: inline-block;
    
    border: 2px solid #faac1c;
    color: white;
   
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    text-decoration: none;
   
    box-sizing: border-box;
    
    border-radius: 10px;
    background-color: #faac1c;
    outline: none;
    transition: all ease 0.5s;
  }
  .icon{
    margin-left: 5px;
    display: none;
  }
  #login.loading{
    background-color: #faac1c;
    color:white;
  }

  #login.loading #login.icon{
    display: inline-block;
    color: #eee;
    animation: spin 2s linear infinite;
  }

  @keyframes spin{
        0%{
            transform: rotate(0deg);
        }
        100%{
            transform: rotate(360deg);
        }
    }


  /*  #login:hover{
        background-color: yellow !important;
        border: none !important;
    }*/
    
  /* #login.active{
        font-size: 0;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: transparent;
        border-left-color: transparent;
       
        animation: rotate 1.4s ease 0.5s infinite;
    }

    @keyframes rotate{
        0%{
            transform: rotate(360deg);
        }
    }
  
  #login{
    display: inline-block;
    
    border: 2px solid #faac1c;
    color: white;
   
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    text-decoration: none;
   
    box-sizing: border-box;
    
    border-radius: 50px;
    background-color: #faac1c;
    outline: none;
    transition: all ease 0.5s;
  }

  #login.success{
    position: relative;
    background-color:transparent;
    animation: bounce .3s ease-in;
  }

  @keyframes bounce{
        0%{
            transform: scale(0.9);
        }
    }

    #login.success::before{
        content: "";
        position: absolute;
        background: url(check-solid.svg) no-repeat;
        left: 0;
        right: 0;
        margin: 0 auto;
        z-index: 1;
        
    }*/
</style>

<body>
    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "102114862506454");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v15.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    
<x-jet-authentication-card>
        <!--<x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>-->
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline hidden">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline hidden">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        <x-slot name="logo" >
           <span class="logo-membership" style="font-size: 4em; font-family: 'Poppins', san-serif; ">Youth Saver's Club Membership</span> 
           
        </x-slot>
       
        <x-jet-validation-errors class="mb-4"/>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label style="color:black; letter-spacing:5px" for="email" value="{{ __('Email') }}" />
                <input id="email" style="border: 2px solid #faac1c; border-radius:10px; background:white;" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label style="color:black; letter-spacing:5px" for="password" value="{{ __('Password') }}" />
                <input style="border: 2px solid #faac1c; border-radius:10px; background:white;" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4 hidden">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm" style="color:black" >{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="mt-4">
                <a href="{{ route('register') }}" class="ml-4 text-sm underline" style="color: black; letter-spacing:2px">No Account? Register now!</a>
            </div>
            
            <div class="flex items-center mt-2" > <!--justify-end-->
                @if (Route::has('password.request'))
                    <a class="underline ml-4 text-sm hover:text-gray-900" style="color: black; letter-spacing: 2px" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                @endif
               
                
            </div>
            <div style="text-align: center;">
            <button class="mt-3 form-control login"  id="login"> <!--style="background: #faac1c; border-radius: 25px; border: 1px solid #f95307;"-->
                    {{ __('LOG IN') }}
                </button>
            </div>
        </form>

        <script>
            $(document).ready(function(){
                $("#login").click(function(){
                   /* $(this).addClass("active");

                    setTimeout(function(){
                        $("#login").addClass("success");
                    }, 3700)*/

                    $(this).addClass("loading")
                    $('#login').innerHTML = "<span class='icon'>&#8635</span> Loggin In.... "
                })
            })
        </script>
   
    </x-jet-authentication-card>
   
    <!--bootstrap bundle-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
     
    <!--Popper and Bootstrap JS --> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
   

</body>
</html>
<x-guest-layout>
    <x-jet-authentication-card>
        <!--<x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>-->
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        <x-slot name="logo" >
           <span id="logo-membership">YSC membership</span> 
        </x-slot>
        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>