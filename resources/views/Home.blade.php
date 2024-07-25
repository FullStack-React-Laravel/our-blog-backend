<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Our Blog Api</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body class="min-h-screen flex flex-col bg-gray-800">

<main class="container mx-auto px-2.5 flex flex-wrap justify-center items-center grow gap-2 py-10">
    <div class="flex flex-wrap justify-center gap-4">
        <a href="/pulse"
           class="text-center flex flex-col items-center border-2 bg-gray-900 px-2 py-2 rounded-lg border-violet-950">
            <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M15.4566 6.75005C15.9683 6.75596 16.4047 7.09621 16.5001 7.56364L18.8747 19.2038L19.999 17.1682C20.1832 16.8347 20.5526 16.625 20.9559 16.625H31.1744C31.7684 16.625 32.25 17.0727 32.25 17.625C32.25 18.1773 31.7684 18.625 31.1744 18.625H21.6127L19.3581 22.7068C19.1483 23.0867 18.7021 23.3008 18.2475 23.2397C17.7928 23.1786 17.4301 22.8559 17.3445 22.4363L15.376 12.7868L13.1334 22.4607C13.0282 22.9146 12.6007 23.2414 12.1013 23.2498C11.6019 23.2582 11.162 22.9458 11.0393 22.4957L9.30552 16.1378L8.19223 18.0929C8.00581 18.4202 7.64002 18.625 7.2416 18.625H1.32563C0.731576 18.625 0.25 18.1773 0.25 17.625C0.25 17.0727 0.731576 16.625 1.32563 16.625H6.59398L8.71114 12.9071C8.9193 12.5415 9.34805 12.3328 9.78979 12.3821C10.2315 12.4313 10.5951 12.7283 10.7044 13.1292L11.9971 17.8695L14.3918 7.53929C14.4996 7.07421 14.9449 6.74414 15.4566 6.75005Z"
                      fill="url(#paint0_linear_4_31)"></path>
                <defs>
                    <linearGradient id="paint0_linear_4_31" x1="16.25" y1="6.74997" x2="16.25" y2="23.25"
                                    gradientUnits="userSpaceOnUse">
                        <stop stop-color="#F85A5A"></stop>
                        <stop offset="0.828125" stop-color="#7A5AF8"></stop>
                    </linearGradient>
                </defs>
            </svg>

            <span class="ml-2 text-lg sm:text-2xl text-gray-700 dark:text-gray-300 font-medium">
            Pulse
        </span>

            <p class="grow flex items-center border-t-2 mx-8 mt-2 pt-2 text-white max-w-80 px-2">
                Pulse provides quick insights into your app's performance and user behavior.
            </p>
        </a>

        <a href="/log-viewer"
           class="text-center flex flex-col items-center border-2 bg-gray-900 px-2 py-2 rounded-lg border-violet-950">
            <img src="/vendor/log-viewer/img/log-viewer-32.png" alt="log-viewer"/>

            <span class="ml-2 text-lg sm:text-2xl text-gray-700 dark:text-gray-300 font-medium">
            Log Viewer
        </span>

            <p class="grow flex items-center border-t-2 mx-8 mt-2 pt-2 text-white max-w-80 px-2">
                Log Viewer helps you quickly and clearly see individual log entries, to search, filter, and make sense
                of
                your Laravel logs fast
            </p>
        </a>
    </div>
</main>

<footer class="border-t-4 mt-auto p-4 bg-gray-900 border-violet-950">
    <div class="container mx-auto text-white flex flex-row-reverse flex-wrap gap-2">
        <span>Laravel: {{ app()->version() }}</span>
        <span>PHP: {{ PHP_VERSION  }}</span>
    </div>
</footer>
</body>
</html>
