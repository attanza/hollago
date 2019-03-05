@extends('layouts.admin')
@section('title', 'Profile')
@section('content')
<div class="container-fluid">
    <profile-detail :user="{{ Auth::user() }}"></profile-detail>
</div>
@endsection
