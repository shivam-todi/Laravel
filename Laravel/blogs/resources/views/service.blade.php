@extends('layouts.app')

@section('content')
  @foreach ($data as $item)
            <li>
              <span>{{ $item->name}}</span>
              <span>{{ $item->email}}</span>
            </li>
  @endforeach
@endsection
