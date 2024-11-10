<!-- resources/views/errors/404.blade.php -->
@php
    header('Location: ' . route('dashboard'), true, 302);
    exit();
@endphp
