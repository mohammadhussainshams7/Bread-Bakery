<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" dir="rtl">
    <head>
        @include('partials.head')
    </head>
    <body>
         <livewire:navbar />
         <main>
        {{ $slot }}
         </main>
        @fluxScripts
    </body>
</html>
