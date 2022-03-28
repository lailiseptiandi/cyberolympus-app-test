@extends('layouts.dashboard')

@section('title')
    <title>Dashboard</title>
@endsection
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-12">
                    <h3> Halo Selamat Datang, {{ Auth::user()->name }}</h3>
                </div>
            </div>
        </section>
    </div>
@endsection
