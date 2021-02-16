@extends('layouts.app')

@section('content')
    <detail-component id="{{ $item->id }}" :from-catalog="{{ request()->get('catalog') ? 'true' : 'false' }}"></detail-component>
@endsection
