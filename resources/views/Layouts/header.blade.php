<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<div class="container-fluid text-center">
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="main_nav">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active"> <a class="nav-link" href="{{config('app.url')}}/">DASHBOARD </a> </li>
    <li class="nav-item"><a class="nav-link" href="{{config('app.url')}}/tentang_aplikasi"> TENTANG APLIKASI </a></li>
    <li class="nav-item dropdown" id="myDropdown">
      <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">  MANAGEMENT DATA  </a>
      <ul class="dropdown-menu">
        <li> <a class="dropdown-item" href="#"> PROFIL KELEMBAGAAN </a></li>
        <li> <a class="dropdown-item" href="#"> PENYELENGGARA LINMAS &raquo; </a>
        <ul class="submenu dropdown-menu">
          <li><a class="dropdown-item" href="{{config('app.url')}}/datalinmas">DATA ANGGOTA LINMAS</a></li>
          <li><a class="dropdown-item" href="{{config('app.url')}}/linmas_tibum">MEMBANTU TIBUM & TRANMAS</a></li>
          <li><a class="dropdown-item" href="{{config('app.url')}}/bencana_kebakaran">MEMBANTU BENCANA DAN KEBAKARAN</a></li>
          <li><a class="dropdown-item" href="{{config('app.url')}}/pengamanan">MEMBANTU PENYELENGGARA PEMILIHAN UMUM</a></li>
          <li><a class="dropdown-item" href="{{config('app.url')}}/kegiatan_lainnya">MEMBANTU KEGIATAN LAINNYA</a></li>
        </ul>
      </li>
      <li> <a class="dropdown-item" href="#"> PENEGAKAN &raquo; </a>
      <ul class="submenu dropdown-menu">
        <li><a class="dropdown-item" href="{{config('app.url')}}/penegakan_perka">PENEGAKAN PERKA</a></li>
        <li><a class="dropdown-item" href="{{config('app.url')}}/penegakan_perda">PENEGAKAN PERDA</a></li>
        
      </ul>
    </li>
  </ul>
  <!-- <li class="nav-item"><a class="nav-link" href="{{config('app.url')}}/register"> REGISTER </a></li> -->
</li>
</ul>
<ul class="navbar-nav navar-right">
  <li class="nav-item"><a class="nav-link" href="{{config('app.url')}}/login">LOGIN </a></li> 
  <li class="nav-item"><a class="nav-link" href="{{config('app.url')}}/logout">LOGOUT</a></li> 
  </ul>
</div>
<!-- navbar-collapse.// -->
</div>
<!-- container-fluid.// -->
</nav>