@extends('layouts.app')

@section('content')
    <zoom-component id="{{ $item->id }}"
                    back-url="{{ route('detail', ['item' => $item]) }}"
    ></zoom-component>
@endsection
