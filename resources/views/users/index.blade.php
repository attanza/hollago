@extends('layouts.admin')
@section('title', 'Users')
@section('content')
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/manage">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Users</li>
    </ol>
    <user-list :can-create="{{ auth()->user()->can('create-user') }}"></user-list>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/sorttable.js') }}"></script>
@endsection
