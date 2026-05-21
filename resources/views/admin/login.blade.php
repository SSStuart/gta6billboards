@extends('layouts.app')

@section('title', "GTA 6 Billboards")
@section('description', "Admin - Login")

@push('styles')
    @vite(['resources/css/admin/login.css'])
@endpush

@section('content')
    <main id="main">
        <section id="loginSection">
            <h2><i class='iiicon' data-name='lock' style="font-size: 2em"></i><br>Admin Login</h2>
            <form action="{{ route('admin.authenticate') }}" method="POST">
                @csrf
                <div class="inputCont">
                    <label for="username">Username :</label>
                    <input type="text" name="username" id="username">
                </div>
                <div class="inputCont">
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password">
                </div>
                <button>Submit</button>
            </form>
        </section>
    </main>
@endsection

@push('scripts')
    @vite(['resources/js/admin/login.js'])
@endpush