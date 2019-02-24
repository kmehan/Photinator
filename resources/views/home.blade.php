@extends('layouts.app')
@php
  $isWeekend = date('w') == 0 || date('w') == 6;
@endphp
@section('content')
<div class="container-fluid justify-content-center position-ref full-height">
  <div class="content">
    @if(Auth::guest())
      @if($isWeekend)
        <div class="d-flex justify-content-center">
          <h3>Top Users this Week</h3>
        </div>
        <div class="container w-50">
          <ranking-list></ranking-list>
        </div>
      @else
        <div class="d-flex justify-content-center">
          <h3>Top Photos this Week</h3>
        </div>
        <div class="d-flex justify-content-center">
          <guest-photo></guest-photo>
        </div>
      @endif
    @elseif(Auth::check())
      <div class="d-flex justify-content-center">
        <user-photolist
        :user-id={{ Auth::user() -> id }}
        >
        </user-photolist>
      </div>
    @endif
  </div>
</div>
@endsection
