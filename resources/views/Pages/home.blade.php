@extends('Layouts.layout')
@section('content')
  <style>
    #content {
      position: relative;
     width: 100vw;
     height: 85vh;
     padding: 0;
    }
  </style>
  <div id="content">
    <iframe style="width:100vw; height:100vh" src="https://satudata.bantenprov.go.id/portal/apps/opsdashboard/index.html#/f9b9984dddea4a429643a2725a07a8ef" title="APLIKASI SATPOL PP"></iframe>
  </div>
<!-- <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{config('app.url')}}/public/img/po3.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{config('app.url')}}/public/img/po2.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{config('app.url')}}/public/img/po1.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{config('app.url')}}/public/img/po5.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{config('app.url')}}/public/img/po6.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{config('app.url')}}/public/img/po7.jpeg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div> -->

@endsection