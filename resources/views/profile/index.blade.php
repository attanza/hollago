@extends('layouts.admin')
@section('title', 'Profile')
@section('content')
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/manage">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>
    <profile-detail :user="{{ Auth::user() }}"></profile-detail>

</div>
@endsection
