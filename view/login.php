<!DOCTYPE html><html lang="en">
    <head>
        <meta name="application-name" content="Binusmaya Practicum"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="default"/>
        <meta name="apple-mobile-web-app-title" content="Binusmaya Practicum"/>
        <meta name="theme-color" content="#ffffff"/>
        <link rel="apple-touch-icon" href="/prk//prk/assets/logo-binus.png"/>
        <link rel="manifest" href="/prk/manifest.json"/>
        <link rel="shortcut icon" href="/prk/static/favicon.ico"/>
        <meta charSet="UTF-8"/><meta name="author" content="GB18-2 Jonathan Gobiel, LT20-1 Lukas Tanto Kurniawan, DX20-1 Adrian, CV20-1 Calvin Arihta"/>
        <meta name="viewport" content="width=device-width"/>
        <meta charSet="utf-8"/>
        <title>Login</title>
        <meta name="description" content="Login to Binusmaya Practicum"/>
        <meta name="next-head-count" content="4"/>
        <link rel="preload" href="../assets/login/files/e32c7914c4f4ca10.css" as="style"/>
        <link rel="stylesheet" href="../assets/login/files/e32c7914c4f4ca10.css" data-n-g=""/>
        <link rel="preload" href="../assets/login/files/2a30f54440cbdc1f.css" as="style"/>
        <link rel="stylesheet" href="../assets/login/files/2a30f54440cbdc1f.css" data-n-p=""/>
        <noscript data-n-css=""></noscript>
        <script defer="" nomodule="" src="../assets/login/files/polyfills-5cd94c89d3acac5f.js"></script>
        <script src="../assets/login/files/webpack-9ccb70cc6ca8dc70.js" defer=""></script>
        <script src="../assets/login/files/framework-dc33c0b5493501f0.js" defer=""></script>
        <script src="../assets/login/files/main-49a929add637ce78.js" defer=""></script>
        <script src="../assets/login/files/_app-b30aab0c324c49d8.js" defer=""></script>
        <script src="../assets/login/files/201-427fc7678903b451.js" defer=""></script>
        <script src="../assets/login/files/login-c5432f134a550b5f.js" defer=""></script>
        <script src="../assets/login/files/_buildManifest.js" defer=""></script>
        <script src="../assets/login/files/_ssgManifest.js" defer=""></script>
        <script src="../assets/login/files/_middlewareManifest.js" defer=""></script>
    </head>
    <body>
        <div id="__next">
            <main>
                <div class="Login_itemCenter__9j8nI">
                    <div class="z-10">
                        <form name="formLogin" class="rounded-lg lg:bg-grey-700 Login_formLogin__j5vR8" id="form-login" autoComplete="off" action="../controller/route.php?aksi=login" method="POST">
                            <i class="Login_CIbanner__mdkqr"></i>
                            <span class="Login_logoBinus__sQIUQ"></span>
                            <div class="Login_loginInputContainer__H2EA_">
                                <div class="rounded-md bg-red-100 p-2.5 Login_inputControl__3NAY1" hidden="">
                                    <div class="flex"><div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="h-5 w-5 text-red-500">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-red-900"><?php echo isset($_GET['pesan']);?></p>
                                    </div>
                                    <div class="ml-auto pl-3">
                                        <div class="-mx-1.5 -my-1.5">
                                            <button type="button" class="inline-flex bg-red-100 rounded-md p-1.5 text-red-500 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-red-50 focus:ring-red-600">
                                                <span class="sr-only">Dismiss</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="h-5 w-5">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="rounded-md Login_inputControl__3NAY1">
                                <input name="email" id="email" placeholder="Binusian Email" required="" autofocus="" class="rounded-md Login_inputComponent__4VPQu"/>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="Login_fa__Vga5Z h-5 w-5">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="rounded-md Login_inputControl__3NAY1">
                                <input type="password" id="password" name="password" placeholder="Password" required="" class="rounded-md Login_inputComponent__4VPQu"/>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="Login_fa__Vga5Z h-5 w-5">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <button type="submit" class="rounded-md inline-flex items-center justify-center transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-binus-blue Login_loginBtn__ajHG3">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <footer class="hidden sm:block Login_textCenter__m5Sf9">
                <div class="Login_desktopFooter__pyfbd">Copyright © 2022 - Binus Malang Sustainable Campus</div>
            </footer>
            <div class="Login_particlesJS__m712S" id="tsparticles">
                <canvas style="width:100%;height:100%"></canvas>
            </div>
        </main>
        </div>
    </body>
</html>