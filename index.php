<?php  

require 'C:\Users\Youcode\Desktop\Dev.to-Blogging-Plateform\vendor\autoload.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link href="../assets/css/tailwind.css" rel="stylesheet">
  
    <script src="assets/js/alpine.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Admin Dashboard</title>
    
</head>
<body class="antialiased bg-gray-100">
    <div class="flex relative" x-data="{navOpen: false}">
        <!-- NAV -->
        <nav class="absolute md:relative w-64 transform -translate-x-full md:translate-x-0 h-screen overflow-y-scroll bg-black transition-all duration-300" :class="{'-translate-x-full': !navOpen}">
            <div class="flex flex-col justify-between h-full">
                <div class="p-4">
                    <!-- LOGO -->
                    <a class="flex items-center text-white space-x-4" href="">
                              <svg class="w-12 h-12 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="fill: blue;">
                                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                  <path d="M96 128a128 128 0 1 0 256 0A128 128 0 1 0 96 128zm94.5 200.2l18.6 31L175.8 483.1l-36-146.9c-2-8.1-9.8-13.4-17.9-11.3C51.9 342.4 0 405.8 0 481.3c0 17 13.8 30.7 30.7 30.7l131.7 0c0 0 0 0 .1 0l5.5 0 112 0 5.5 0c0 0 0 0 .1 0l131.7 0c17 0 30.7-13.8 30.7-30.7c0-75.5-51.9-138.9-121.9-156.4c-8.1-2-15.9 3.3-17.9 11.3l-36 146.9L238.9 359.2l18.6-31c6.4-10.7-1.3-24.2-13.7-24.2L224 304l-19.7 0c-12.4 0-20.1 13.6-13.7 24.2z"/>
                              </svg> 
                        <span class="text-2xl font-bold ">Admin</span>
                    </a>

                    <!-- SEARCH BAR -->
                    <div class="border-gray-700 py-5 text-white border-b rounded">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <form action="" method="GET">
                                <input type="search" class="w-full py-2 rounded pl-10 bg-gray-800 border-none focus:outline-none focus:ring-0" placeholder="Search">
                            </form>
                        </div>
                    </div>

                    <!-- NAV LINKS -->
                    <div class="py-4 text-gray-400 space-y-1">
                        <!-- BASIC LINK -->
                        <a href="#" class="block py-2.5 px-4 flex items-center space-x-2 bg-gray-800 text-white hover:bg-gray-800 hover:text-white rounded">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>Dashboard</span>
                        </a>
                        <!-- DROPDOWN LINK -->
                        <div class="block" x-data="{open: false}">
                            <div @click="open = !open" class="flex items-center justify-between hover:bg-gray-800 hover:text-white cursor-pointer py-2.5 px-4 rounded">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    <span>All options</span>
                                </div>
                                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>    
                            </div>
                            <div x-show="open" class="text-sm border-l-2 border-gray-800 mx-6 my-2.5 px-2.5 flex flex-col gap-y-1">
                                <a href="insert.php" id="addNewPlayer" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                                    Add Player
                                </a>
                                <a href="Index.php" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                                    View Stadium
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PROFILE -->
                <div class="text-gray-200 border-gray-800 rounded flex items-center justify-between p-2">
                    <div class="flex items-center space-x-2">
                        <!-- AVATAR IMAGE BY FIRST LETTER OF NAME -->
                        <img src="https://ui-avatars.com/api/?name=Habib+Mhamadi&size=128&background=ff4433&color=fff" class="w-7 w-7 rounded-full" alt="Profile">
                        <h1>Change account</h1>
                    </div>
                    <a onclick="event.preventDefault(); document.getElementById('logoutForm').submit()" href="#" class="hover:bg-gray-800 hover:text-white p-2 rounded">
                        <form id="logoutForm" action="" method="POST"></form>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>            
                        </form>
                    </a>
                </div>

            </div>
        </nav>
        <!-- END OF NAV -->

        <!-- PAGE CONTENT -->
        <main class="flex-1 h-screen overflow-y-scroll overflow-x-hidden">
            <div class="md:hidden justify-between items-center bg-black text-white flex">
                <h1 class="text-2xl font-bold px-4">Admin</h1>
                <button @click="navOpen = !navOpen" class="btn p-4 focus:outline-none hover:bg-gray-800">
                    <svg class="w-6 h-6 fill-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
            <section class="max-w-7xl mx-auto py-4 px-5">
                <div class="flex justify-between items-center border-b border-gray-300">
                    <h1 class="text-2xl font-semibold pt-2 pb-6">Dashboard</h1>
                </div>

                <!-- STATISTICS -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 py-6">
                    <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5">
                        <div class="space-y-2">
                            <p class="text-xs text-gray-400 uppercase">Players</p>
                            <div class="flex items-center space-x-2">
                                <h1 class="text-xl font-semibold">
                                  45
                                 </h1>
                            </div>
                        </div>
                        <svg class="w-12 h-12 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M435.4 361.4l-89.7-6c-5.2-.3-10.3 1.1-14.5 4.2s-7.2 7.4-8.4 12.5l-22 87.2c-14.4 3.2-29.4 4.8-44.8 4.8s-30.3-1.7-44.8-4.8l-22-87.2c-1.3-5-4.3-9.4-8.4-12.5s-9.3-4.5-14.5-4.2l-89.7 6C61.7 335.9 51.9 307 49 276.2L125 228.3c4.4-2.8 7.6-7 9.2-11.9s1.4-10.2-.5-15L100.4 118c19.9-22.4 44.6-40.5 72.4-52.7l69.1 57.6c4 3.3 9 5.1 14.1 5.1s10.2-1.8 14.1-5.1l69.1-57.6c27.8 12.2 52.5 30.3 72.4 52.7l-33.4 83.4c-1.9 4.8-2.1 10.1-.5 15s4.9 9.1 9.2 11.9L463 276.2c-3 30.8-12.7 59.7-27.6 85.2zM256 48l.9 0-1.8 0 .9 0zM56.7 196.2c.9-3 1.9-6.1 2.9-9.1l-2.9 9.1zM132 423l3.8 2.7c-1.3-.9-2.5-1.8-3.8-2.7zm248.1-.1c-1.3 1-2.6 2-4 2.9l4-2.9zm75.2-226.7l-3-9.2c1.1 3 2.1 6.1 3 9.2zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm14.1-325.7c-8.4-6.1-19.8-6.1-28.2 0L194 221c-8.4 6.1-11.9 16.9-8.7 26.8l18.3 56.3c3.2 9.9 12.4 16.6 22.8 16.6l59.2 0c10.4 0 19.6-6.7 22.8-16.6l18.3-56.3c3.2-9.9-.3-20.7-8.7-26.8l-47.9-34.8z"/>
                        </svg>
                    </div>

                    <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5">
                        <div class="space-y-2">
                            <p class="text-xs text-gray-400 uppercase">Nationalities</p>
                            <div class="flex items-center space-x-2">
                                <h1 class="text-xl font-semibold">819</h1>
                            </div>
                        </div>   
                        <svg class="w-12 h-12 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M48 24C48 10.7 37.3 0 24 0S0 10.7 0 24L0 64 0 350.5 0 400l0 88c0 13.3 10.7 24 24 24s24-10.7 24-24l0-100 80.3-20.1c41.1-10.3 84.6-5.5 122.5 13.4c44.2 22.1 95.5 24.8 141.7 7.4l34.7-13c12.5-4.7 20.8-16.6 20.8-30l0-279.7c0-23-24.2-38-44.8-27.7l-9.6 4.8c-46.3 23.2-100.8 23.2-147.1 0c-35.1-17.6-75.4-22-113.5-12.5L48 52l0-28zm0 77.5l96.6-24.2c27-6.7 55.5-3.6 80.4 8.8c54.9 27.4 118.7 29.7 175 6.8l0 241.8-24.4 9.1c-33.7 12.6-71.2 10.7-103.4-5.4c-48.2-24.1-103.3-30.1-155.6-17.1L48 338.5l0-237z"/>
                       </svg>              
                    </div>

                    <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5">
                        <div class="space-y-2">
                            <p class="text-xs text-gray-400 uppercase">Clubs</p>
                            <div class="flex items-center space-x-2">
                                <h1 class="text-xl font-semibold">121</h1>
                            </div>
                        </div>
                        <svg class="w-12 h-12 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M72 88a56 56 0 1 1 112 0A56 56 0 1 1 72 88zM64 245.7C54 256.9 48 271.8 48 288s6 31.1 16 42.3l0-84.7zm144.4-49.3C178.7 222.7 160 261.2 160 304c0 34.3 12 65.8 32 90.5l0 21.5c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32-14.3-32-32l0-26.8C26.2 371.2 0 332.7 0 288c0-61.9 50.1-112 112-112l32 0c24 0 46.2 7.5 64.4 20.3zM448 416l0-21.5c20-24.7 32-56.2 32-90.5c0-42.8-18.7-81.3-48.4-107.7C449.8 183.5 472 176 496 176l32 0c61.9 0 112 50.1 112 112c0 44.7-26.2 83.2-64 101.2l0 26.8c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32-14.3-32-32zm8-328a56 56 0 1 1 112 0A56 56 0 1 1 456 88zM576 245.7l0 84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM320 32a64 64 0 1 1 0 128 64 64 0 1 1 0-128zM240 304c0 16.2 6 31 16 42.3l0-84.7c-10 11.3-16 26.1-16 42.3zm144-42.3l0 84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM448 304c0 44.7-26.2 83.2-64 101.2l0 42.8c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32-14.3-32-32l0-42.8c-37.8-18-64-56.5-64-101.2c0-61.9 50.1-112 112-112l32 0c61.9 0 112 50.1 112 112z"/>
                       </svg>
                    </div>

                    <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5">
                        <div class="space-y-2">
                            <p class="text-xs text-gray-400 uppercase">Goalkeepers</p>
                            <div class="flex items-center space-x-2">
                                <h1 class="text-xl font-semibold">243</h1>
                            </div>
                        </div>
                        <svg class="w-12 h-12 text-gray-300"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M352 384L64 384 5.4 178.9C1.8 166.4 0 153.4 0 140.3C0 62.8 62.8 0 140.3 0l3.4 0c66 0 123.5 44.9 139.5 108.9l31.4 125.8 17.6-20.1C344.8 200.2 362.9 192 382 192l2.8 0c34.9 0 63.3 28.3 63.3 63.3c0 15.9-6 31.2-16.8 42.9L352 384zM32 448c0-17.7 14.3-32 32-32l288 0c17.7 0 32 14.3 32 32l0 32c0 17.7-14.3 32-32 32L64 512c-17.7 0-32-14.3-32-32l0-32z"/>
                        </svg>
                    </div>
                </div>
                <!-- END OF STATISTICS -->
                
                <!-- TABLE -->
                <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">name</th>
                                <th class="py-3 px-6 text-left">photo</th>
                                <th class="py-3 px-6 text-center">nationality</th>
                                <th class="py-3 px-6 text-center">nationality flag</th>
                                <th class="py-3 px-6 text-center">position</th>
                                <th class="py-3 px-6 text-left">club</th>
                                <th class="py-3 px-6 text-left">club logo</th>
                                <th class="py-3 px-6 text-center">rating</th>
                                <th class="py-3 px-6 text-center">action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                        Messi
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                            <img class="w-6 h-6 rounded-full" src="https://cdn.sofifa.net/players/158/023/25_120.png"/>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    Argentina
                                </td>
                                <td class="py-3 px-6 text-center">
                                   <div class="flex items-center">
                                        <div class="ml-14">
                                            <img class="w-6 h-6 rounded-full" src="https://cdn.sofifa.net/flags/ar.png"/>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">RW</span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                  Inter Miami
                                </td>
                                <td class="py-3 px-6 text-center">
                                <div class="flex items-center">
                                        <div class="ml-8">
                                            <img class="w-6 h-6 rounded-full" src="https://cdn.sofifa.net/meta/team/239235/120.png"/>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                     88
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                           

                       
                        </tbody>
                    </table>
                </div>
                <!-- END OF TABLE -->

                
            </section>
            <!-- END OF PAGE CONTENT -->
        </main>
    </div>

<div
      class="hidden card rounded-lg shadow-xl p-1 mx-auto bg-gradient-to-br m-auto from-black -500 via-indigo-500 to-blue-500"
      style="position: absolute; top: 200px; left: 40%">
      <div
        class="bg-white shadow-lg rounded-lg overflow-hidden text-center w-[500px] m-auto">
        <div class="p-6">
          <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">
            Player Information
          </h2>

          <div class="mb-6">
            <p class="text-gray-700">
              <span class="font-bold">Nom:</span> John Doe
            </p>
          </div>

          <div class="mb-6">
            <p class="text-gray-700">
              <span class="font-bold">Photo:</span>
              <img
                style="margin: auto"
                src="path/to/photo.jpg"
                alt="Player Photo"
                class="w-20 h-20 rounded-full border-4 border-indigo-300 shadow-lg" />
            </p>
          </div>

          <div class="mb-6">
            <p class="text-gray-700">
              <span class="font-bold">Nationality:</span> French
            </p>
          </div>

          <div class="mb-6">
            <p class="text-gray-700">
              <span class="font-bold">Club:</span> Paris Saint-Germain
            </p>
          </div>

          <div style="display: grid; grid-template-columns: auto auto">
            <div class="mb-6">
              <p class="text-gray-700">
                <span class="font-bold">Flag:</span>
                <img
                  style="margin: auto"
                  src="path/to/flag.jpg"
                  alt="Country Flag"
                  class="w-12 h-12 rounded-full border-2 border-gray-200 shadow-lg" />
              </p>
            </div>

            <div class="mb-6">
              <p class="text-gray-700">
                <span class="font-bold">Logo:</span>
                <img
                  style="margin: auto"
                  src="path/to/logo.jpg"
                  alt="Club Logo"
                  class="w-12 h-12 rounded-full border-2 border-gray-200 shadow-lg" />
              </p>
            </div>
            <div class="mb-6">
              <p class="text-gray-700">
                <span class="font-bold">Position:</span> GK
              </p>
            </div>

            <div class="mb-6">
              <p class="text-gray-700">
                <span class="font-bold">Rating:</span> 90
              </p>
            </div>

            <div class="mb-6">
              <p class="text-gray-700">
                <span class="font-bold">Diving:</span> 95
              </p>
            </div>

            <div class="mb-6">
              <p class="text-gray-700">
                <span class="font-bold">Handling:</span> 92
              </p>
            </div>

            <div class="mb-6">
              <p class="text-gray-700">
                <span class="font-bold">Kicking:</span> 85
              </p>
            </div>

            <div class="mb-6">
              <p class="text-gray-700">
                <span class="font-bold">Reflexes:</span> 93
              </p>
            </div>

            <div class="mb-6">
              <p class="text-gray-700">
                <span class="font-bold">Speed:</span> 88
              </p>
            </div>
        </div>  
    </div>
</div>      
<style>
    #edit-player-modal .bg-white {
        overflow-y: auto; 
        max-height: 80vh; 
    }

    #edit-player-modal .bg-white::-webkit-scrollbar {
        display: none;
    }

    #edit-player-modal .bg-white {
        -ms-overflow-style: none; 
        scrollbar-width: none; 
    }
</style>



<script>

document.addEventListener('DOMContentLoaded', function () {

    let editIcons = document.querySelectorAll('.editIcon');
    editIcons.forEach(function(icon) {
        icon.addEventListener('click', function(e) {
            e.preventDefault();
            alert('hello');
        });
    });

    let viewIcons = document.querySelectorAll('.viewIcon');
    viewIcons.forEach(function(icon) {
        icon.addEventListener('click', function(e) {
            e.preventDefault();
            alert('hello');
        });
    });

    let deleteIcons = document.querySelectorAll('.deleteIcon');
    deleteIcons.forEach(function(icon) {
        icon.addEventListener('click', function(e) {
            e.preventDefault();
            alert('hello');
        });
    });

    let addNewPlayer = document.getElementById('addNewPlayer');
    let editplayermodal = document.getElementById('edit-player-modal');

    addNewPlayer.addEventListener('click', function(e) {
        e.preventDefault();
        editplayermodal.classList.remove('hidden');
    });

    function togglePositionFields() {
        const position = document.getElementById("edit-player-position").value;
        const gkFields = document.getElementById("gk-fields");
        const fieldPlayerFields = document.getElementById("field-player-fields");
        console.log(position);

        if (position === "GK") {
            gkFields.classList.remove("hidden");
            fieldPlayerFields.classList.add("hidden");
        } else {
            gkFields.classList.add("hidden");
            fieldPlayerFields.classList.remove("hidden");
        }
    }
});

</script>

</body>
</html>