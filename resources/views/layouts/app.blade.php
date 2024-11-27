<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-100 antialiased">
        <div class="min-h-screen bg-black">
            @include('layouts.navigation')

            <!-- Page Heading -->
                @yield('header')

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
    <footer class="bg-black pb-3">
        <div class="bg-[#2b2b2b] py-1 w-full mb-6"></div>
        <div class="flex justify-center px-5">
            <svg width="286" height="51" viewBox="0 0 286 51" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <rect width="286" height="51" fill="url(#pattern0_58_6)"/>
                <defs>
                <pattern id="pattern0_58_6" patternContentUnits="objectBoundingBox" width="1" height="1">
                <use xlink:href="#image0_58_6" transform="matrix(0.00289017 0 0 0.0162076 0 -0.00243681)"/>
                </pattern>
                <image id="image0_58_6" width="346" height="62" xlink:href="data:image/png;base64,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"/>
                </defs>
            </svg>
        </div>
        <div class="flex justify-center mt-5">
            <div class="inline-flex gap-4">
                <a
                target="_blank"
                href="https://www.instagram.com/arusta.id/"
                class="bg-neutral-500 w-9 h-9 rounded-full border border-white flex justify-center items-center"
                >
                <svg
                    width="20px"
                    height="20px"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    stroke="#ffffff"
                >
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g
                    id="SVGRepo_tracerCarrier"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    ></g>
                    <g id="SVGRepo_iconCarrier">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18ZM12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16Z"
                        fill="#ffffff"
                    ></path>
                    <path
                        d="M18 5C17.4477 5 17 5.44772 17 6C17 6.55228 17.4477 7 18 7C18.5523 7 19 6.55228 19 6C19 5.44772 18.5523 5 18 5Z"
                        fill="#ffffff"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M1.65396 4.27606C1 5.55953 1 7.23969 1 10.6V13.4C1 16.7603 1 18.4405 1.65396 19.7239C2.2292 20.8529 3.14708 21.7708 4.27606 22.346C5.55953 23 7.23969 23 10.6 23H13.4C16.7603 23 18.4405 23 19.7239 22.346C20.8529 21.7708 21.7708 20.8529 22.346 19.7239C23 18.4405 23 16.7603 23 13.4V10.6C23 7.23969 23 5.55953 22.346 4.27606C21.7708 3.14708 20.8529 2.2292 19.7239 1.65396C18.4405 1 16.7603 1 13.4 1H10.6C7.23969 1 5.55953 1 4.27606 1.65396C3.14708 2.2292 2.2292 3.14708 1.65396 4.27606ZM13.4 3H10.6C8.88684 3 7.72225 3.00156 6.82208 3.0751C5.94524 3.14674 5.49684 3.27659 5.18404 3.43597C4.43139 3.81947 3.81947 4.43139 3.43597 5.18404C3.27659 5.49684 3.14674 5.94524 3.0751 6.82208C3.00156 7.72225 3 8.88684 3 10.6V13.4C3 15.1132 3.00156 16.2777 3.0751 17.1779C3.14674 18.0548 3.27659 18.5032 3.43597 18.816C3.81947 19.5686 4.43139 20.1805 5.18404 20.564C5.49684 20.7234 5.94524 20.8533 6.82208 20.9249C7.72225 20.9984 8.88684 21 10.6 21H13.4C15.1132 21 16.2777 20.9984 17.1779 20.9249C18.0548 20.8533 18.5032 20.7234 18.816 20.564C19.5686 20.1805 20.1805 19.5686 20.564 18.816C20.7234 18.5032 20.8533 18.0548 20.9249 17.1779C20.9984 16.2777 21 15.1132 21 13.4V10.6C21 8.88684 20.9984 7.72225 20.9249 6.82208C20.8533 5.94524 20.7234 5.49684 20.564 5.18404C20.1805 4.43139 19.5686 3.81947 18.816 3.43597C18.5032 3.27659 18.0548 3.14674 17.1779 3.0751C16.2777 3.00156 15.1132 3 13.4 3Z"
                        fill="#ffffff"
                    ></path>
                    </g>
                </svg>
                </a>
                <a
                target="_blank"
                href=":https://www.facebook.com/wayanar"
                class="bg-neutral-500 w-9 h-9 rounded-full border border-white flex justify-center items-center"
                >
                <svg
                    width="20px"
                    height="20px"
                    viewBox="-5 0 20 20"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    fill="#ffffff"
                    stroke="#ffffff"
                >
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g
                    id="SVGRepo_tracerCarrier"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    ></g>
                    <g id="SVGRepo_iconCarrier">
                    <title>facebook [#ffffff]</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g
                        id="Page-1"
                        stroke="none"
                        stroke-width="1"
                        fill="none"
                        fill-rule="evenodd"
                    >
                        <g
                        id="Dribbble-Light-Preview"
                        transform="translate(-385.000000, -7399.000000)"
                        fill="#ffffff"
                        >
                        <g id="icons" transform="translate(56.000000, 160.000000)">
                            <path
                            d="M335.821282,7259 L335.821282,7250 L338.553693,7250 L339,7246 L335.821282,7246 L335.821282,7244.052 C335.821282,7243.022 335.847593,7242 337.286884,7242 L338.744689,7242 L338.744689,7239.14 C338.744689,7239.097 337.492497,7239 336.225687,7239 C333.580004,7239 331.923407,7240.657 331.923407,7243.7 L331.923407,7246 L329,7246 L329,7250 L331.923407,7250 L331.923407,7259 L335.821282,7259 Z"
                            id="facebook-[#ffffff]"
                            ></path>
                        </g>
                        </g>
                    </g>
                    </g>
                </svg>
                </a>
                <a
                target="_blank"
                href="https://www.youtube.com/user/arusta"
                class="bg-neutral-500 w-9 h-9 rounded-full border border-white flex justify-center items-center"
                >
                <svg
                    width="20px"
                    height="20px"
                    viewBox="0 -3 20 20"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    fill="#ffffff"
                    stroke="#ffffff"
                >
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g
                    id="SVGRepo_tracerCarrier"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    ></g>
                    <g id="SVGRepo_iconCarrier">
                    <title>youtube [#ffffff]</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g
                        id="Page-1"
                        stroke="none"
                        stroke-width="1"
                        fill="none"
                        fill-rule="evenodd"
                    >
                        <g
                        id="Dribbble-Light-Preview"
                        transform="translate(-300.000000, -7442.000000)"
                        fill="#ffffff"
                        >
                        <g id="icons" transform="translate(56.000000, 160.000000)">
                            <path
                            d="M251.988432,7291.58588 L251.988432,7285.97425 C253.980638,7286.91168 255.523602,7287.8172 257.348463,7288.79353 C255.843351,7289.62824 253.980638,7290.56468 251.988432,7291.58588 M263.090998,7283.18289 C262.747343,7282.73013 262.161634,7282.37809 261.538073,7282.26141 C259.705243,7281.91336 248.270974,7281.91237 246.439141,7282.26141 C245.939097,7282.35515 245.493839,7282.58153 245.111335,7282.93357 C243.49964,7284.42947 244.004664,7292.45151 244.393145,7293.75096 C244.556505,7294.31342 244.767679,7294.71931 245.033639,7294.98558 C245.376298,7295.33761 245.845463,7295.57995 246.384355,7295.68865 C247.893451,7296.0008 255.668037,7296.17532 261.506198,7295.73552 C262.044094,7295.64178 262.520231,7295.39147 262.895762,7295.02447 C264.385932,7293.53455 264.28433,7285.06174 263.090998,7283.18289"
                            id="youtube-[#ffffff]"
                            ></path>
                        </g>
                        </g>
                    </g>
                    </g>
                </svg>
                </a>
                <a
                target="_blank"
                href="https://x.com/wayanar"
                class="bg-neutral-500 w-9 h-9 rounded-full border border-white flex justify-center items-center"
                >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    fill="#ffffff"
                    class="bi bi-twitter-x"
                    viewBox="0 0 16 16"
                >
                    <path
                    d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"
                    />
                </svg>
                </a>
            </div>
        </div>
        <div class="flex flex-col text-center justify-center items-center px-4">
            <h1 class="text-white mt-5">© 2024 by ArustaID. All rights reserved</h1>
            <h1 class="text-white">Ruko Ambatur Square triangle Blok 1 no.69 Kalimantan Barat</h1>
        </div>
        <div class="bg-[#2b2b2b] py-[2px] w-full mt-6"></div>
    </footer>
</html>
