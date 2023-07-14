 {{-- Gestiamo il blocco dashboard per la creazione del ristorante e lo facciamo apparire solo se l'utente non ha ancora creato un ristorante  --}}
 @php
     use App\Models\Restaurant;
     
     $restaurant = Restaurant::where('user_id', Auth::user()->id)->get();
     //    dd($restaurant);
     
 @endphp


 <!doctype html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="icon" href="{{ Vite::asset('resources/img/favicon.jpg') }}" type="image/x-icon">

     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>{{ config('app.name') }}</title>

     <!-- Fontawesome 6 cdn -->
     <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
         integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
         crossorigin='anonymous' referrerpolicy='no-referrer' />

     <!-- Fonts -->
     <link rel="dns-prefetch" href="//fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

     <!-- Usando Vite -->
     @vite(['resources/js/app.js'])
 </head>

 <body>
     <div id="app">

         <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-5 shadow">
             <div class="row justify-content-end justify-content-md-between">
                 <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">
                     <img src="{{ Vite::asset('resources/img/Ristoria.png') }}" alt="">
                 </a>
                 <button class="navbar-toggler position-absolute d-md-none collapsed" type="button"
                     data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
                     aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                 </button>
             </div>
             <div class="navbar-nav">
                 <div class="nav-item text-nowrap ms-2">
                     <p id="boss" class="d-md-inline-block d-none text-decoration-underline fs-4 mx-4">
                         {{ Auth::user()->name }}</p>
                     <a class="nav-link d-inline-block" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">{{ __('Esci') }}</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
                 </div>
             </div>
         </header>

         <div class="container-dashboard">
             <div class="d-flex ">
                 <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark navbar-dark sidebar collapse">
                     <div class="pt-3">
                         <ul class="nav flex-column">
                             <li class="nav-item">
                                 <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-secondary' : '' }}"
                                     href="{{ route('admin.dashboard') }}">
                                     <i class="fa-solid fa-tachometer-alt fa-lg fa-fw mx-2 "
                                         style="color: rgb(45, 243, 0);"></i> DASHBOARD
                                 </a>
                             </li>

                             @if (count($restaurant) != 0)
                                 <li class="nav-item text-white">
                                     <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.restaurants.index' ? 'bg-secondary' : '' }}"
                                         href="{{ route('admin.restaurants.index') }}">
                                         <i class="fa-regular fa-folder-open mx-2"
                                             style="color: rgb(151, 71, 255);"></i>
                                         IL TUO RISTORANTE
                                     </a>
                                 </li>
                                 <li class="nav-item text-white">
                                     <a class="nav-link text-white" href="{{ route('admin.dishes.index') }}">
                                         <i class="fa-regular fa-folder-open mx-2" style="color: rgb(255, 71, 71);"></i>
                                         IL TUO MENU
                                     </a>
                                    
                                 </li>
                                 <li class="nav-item text-white">
                                     <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.orders.create' ? 'bg-secondary' : '' }}"
                                     href="{{ route('admin.orders.index') }}">
                                     <i class="fa-regular fa-folder-open mx-2" style="color: rgb(240, 150, 5);"></i> I TUOI
                                     ORDINI
                                     
                                    </a>
                                </li>
                                {{-- <li class="nav-item text-white">
                                    <a class="nav-link text-white {{ Route::currentRouteName() == 'admin.categories.create' ? 'bg-secondary' : '' }}"
                                        href="{{ route('admin.categories.index') }}">
                                        <i class="fa-regular fa-folder-open mx-2" style="color: rgb(5, 225, 240);"></i>
                                        CATEGORIE

                                    </a>
                                </li> --}}
                             @elseif (count($restaurant) == 0)
                                 <li class="nav-item text-white">
                                     {{-- <a href="{{ route('admin.restaurants.create') }}"> CREA NUOVO RISTORANTE </a> --}}
                                     <a class="nav-link text-white" href="{{ route('admin.restaurants.create') }}">
                                         <i class="fa-regular fa-folder-open mx-2"
                                             style="color: rgb(255, 230, 71);"></i>
                                         CREA UN NUOVO RISTORANTE
                                     </a>
                                 </li>
                             @endif

                         </ul>

                     </div>
                 </nav>

                 <main class="content-main index-main col-md-9 ms-sm-auto col-lg-10 px-md-4">
                     @yield('content')
                 </main>
             </div>
         </div>

     </div>

     @yield('script')

 </body>

 </html>
