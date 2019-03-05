@extends('layouts.admin')
@section('title', 'Users')
@section('content')
<div class="container-fluid">
    <user-list :can-create="{{ auth()->user()->can('create-user') }}"></user-list>
</div>
@endsection
