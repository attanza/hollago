@extends('layouts.admin')
@section('title', 'Profile')
@section('content')
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/admin">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>

    <profile-detail></profile-detail>

</div>
@endsection
