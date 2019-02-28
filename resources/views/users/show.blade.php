@extends('layouts.admin')
@section('title', 'Users')
@section('content')
<div class="container-fluid">

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/manage/users">Users</a>
        </li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
    <user-detail :user="{{ $user }}" :can-update="{{ auth()->user()->can('update-user') }}"></user-detail>
</div>
@endsection
