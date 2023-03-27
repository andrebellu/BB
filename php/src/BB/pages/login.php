<?php
if ($_COOKIE['admin'] == true) {
    header("Location: ../php/admin.php");
} elseif ($_COOKIE['id'] != null) {
    header("Location: ../php/protected.php");
}
?>


<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Philosopher&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<style>
    body,
    html {
        height: 100%;
        background: #ffff;
        color: black;
    }

    .title {
        font-family: 'Philosopher', sans-serif;
        font-weight: 700;
    }
</style>

<script>
    function check_empty() {
        console.log("check_empty");
        if (document.getElementById('username').value == "" || document.getElementById('password').value == "") {
            document.getElementById('submit').disabled = true;
        } else {
            document.getElementById('submit').disabled = false;
        }
    }
</script>

<body>
    <div class="absolute p-6">
        <h1 class="text-5xl text-left title">Swan</h1>
        <h2 class="text-2xl text-left">Bed and breakfast</h2>
    </div>

    <div class="logincontainer flex w-full h-full">
        <form class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 w-1/2" method="post"
            action="../php/loginscript.php">
            <div class=" w-full max-w-md space-y-8">
                <div>
                    <h1 class="text-left text-4xl">Welcome back!</h1>
                    <h2 class="text-left text-xl">Sign in to your account</h2>
                </div>
                <div class="mt-8 space-y-6 container">
                    <input type="hidden" name="remember" value="true" />
                    <div class="-space-y-px">
                        <div>
                            <label for="email-address" class="sr-only">Username</label>
                            <input id="username" name="username" type="username" autocomplete="username" required class="relative block w-full appearance-none rounded-none 
                        rounded-t-md border border-neutral px-3 py-2 text-black
                        placeholder focus:z-10 focus:outline-none 
                        focus:ring-secondary bg-transparent" placeholder="Username" oninput="check_empty()" />
                        </div>
                        <div class="flex flex-row">
                            <label for="password" class="sr-only">Password</label>
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                required class="relative block w-full appearance-none rounded-none 
                        rounded-b-md border border-neutral px-3 py-2 text-black
                        placeholder focus:z-10 focus:outline-none 
                        focus:ring-secondary sm:text-sm bg-transparent" placeholder="Password"
                                oninput="check_empty()" />
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn w-full text-black hover:text-white" id="submit"
                            disabled="true">
                            Sign in
                        </button>

                        <p class="text-center p-4 text-sm text-slate-500">Don't have an account? <a
                                class="underline text-slate-600" href="./signup.html">SignUp!</a></p>
                    </div>
                </div>
            </div>
        </form>

        <div class="image w-1/2">
            <img src="https://images.unsplash.com/photo-1618351785053-420dc39a3f54?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=987&q=80"
                alt="login image" class="cover w-full h-full object-cover" />
        </div>

    </div>

</body>

</html>