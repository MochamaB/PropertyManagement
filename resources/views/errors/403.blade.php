@extends('errors.layout')

@section('title', __('Forbidden'))
@section('code', 'Error 403!')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
