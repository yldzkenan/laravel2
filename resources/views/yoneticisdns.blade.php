<!DOCTYPE html>
<html lang="en">
  <head>
    <link href="{{ URL::asset('vendors/mdi/css/özelss.css') }}"" rel="stylesheet" media="all" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KOÜ Proje Takip Sistemi</title>

    <link rel="stylesheet" href="{{ URL::asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset ('vendors/css/vendor.bundle.base.css')}}">

    <link rel="stylesheet" href="{{ URL::asset('vendors/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{ URL::asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">

    <link rel="stylesheet" href="{{ URL::asset('css/style.css')}}">

    <link rel="shortcut icon" href="{{URL::asset('images/kocaeli-universitesi-logo.png')}}" />
  </head>
  <body>
    <div class="container-scroller">

      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a><img src="{{ URL:: asset ('images/kocaeli-universitesi-logo.png')}}" alt="logo" <style height=40px weight=40px > </a>

        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <div class="search-field d-none d-xl-block">
            <br>

            <p>KOCAELİ ÜNİVERSİTESİ PROJE TAKİP SİSTEMİ</p>
          </div>
          <ul class="navbar-nav navbar-nav-right">


            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">

                <div class="nav-profile-text">
                    @forelse ($numara  as $key => $item)
                    <br>

                                        <p class="mb-1 text-black">{{$item->ad}} {{$item->soyad}}</p>



                                        <br>


                                        @empty

                                        @endforelse
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">

                <div class="p-2">

                    @forelse ($numara  as $key => $item)

                    <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href={{url('profilyonetici/'.$item->numara)}}>
                      <span>Profil</span>

                    </a>
                    @empty

                    @endforelse


                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href={{url('cıkısyap')}}>
                    <span>Çıkış Yap</span>
                    <i class="mdi mdi-logout ml-1"></i>
                  </a>
                </div>
              </div>
            </li>


          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>

      <div class="container-fluid page-body-wrapper">

        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-category">Kocaeli Üniversitesi</li>
            <li class="nav-item">

                @forelse ($numara  as $key => $item)
                <a class="nav-link" href={{url('anaekranüc/'.$item->numara)}} >
                  @empty

                  @endforelse
                <span class="icon-bg"><i class="mdi mdi-home" style="color:aliceblue"></i></span>
                <span class="menu-title">Anasayfa</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="icon-bg"><i class="mdi mdi-ticket-account" style="color:aliceblue"></i></span>
                <span class="menu-title">Kullanıcılar</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    @forelse ($numara  as $key => $item)
                  <li class="nav-item"> <a class="nav-link" href={{url('yonetıcısdanısmanlar/'.$item->numara)}}>Danışman Öğretmenler</a></li>
                  <li class="nav-item"> <a class="nav-link" href={{url('yonetıcısogrenciler/'.$item->numara)}}>Öğrenciler</a></li>
                  <li class="nav-item"> <a class="nav-link" href={{url('yonetıcısyonetıcıs/'.$item->numara)}}>Sistem Yöneticileri</a></li>
                  @empty

                  @endforelse
                </ul>
              </div>
            </li>
            <li class="nav-item">
                @forelse ($numara  as $key => $item)
              <a class="nav-link" href={{url('projeilerlemesiüc/'.$item->numara)}}>
                <span class="icon-bg"><i class="mdi mdi-folder-open" style="color:aliceblue"></i></span>
                @empty

                @endforelse
                <span class="menu-title">Proje İlerlemeleri</span>
              </a>
            </li>
            <li class="nav-item">
                @forelse ($numara  as $key => $item)
              <a class="nav-link"  href={{url('ogrencianekle/'.$item->numara)}}>
                <span class="icon-bg"><i class="mdi mdi-account-multiple-plus" style="color:aliceblue"></i></span>

                <span class="menu-title" >Öğrenci Eklenmesi</span>
                @empty

                @endforelse
              </a>
            </li>
            <li class="nav-item">
                @forelse ($numara  as $key => $item)
                <a class="nav-link" href={{url('danısmanekle/'.$item->numara)}} >
                  @empty

                  @endforelse
                  <span class="icon-bg"><i class="mdi mdi-account-plus" style="color:aliceblue"></i></span>
                  <span class="menu-title">Danışman Ekle</span>
              </a>
            </li>
            <li class="nav-item">
                @forelse ($numara  as $key => $item)
              <a class="nav-link"  href={{url('donemproje/'.$item->numara)}}>
                @empty

                @endforelse
                <span class="icon-bg"><i class="mdi mdi-content-paste menu-icon"  style="color:aliceblue"></i></span>
                <span class="menu-title">Dönem Proje İşleml..</span>
              </a>
            </li>

            <li class="nav-item sidebar-user-actions">
              <div class="user-details">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <div class="d-flex align-items-center">

                      <div class="sidebar-profile-text">
                        @forelse ($numara  as $key => $item)


         <p class="mb-1 text-black" style="color: white">{{$item->ad}} {{$item->soyad}}</p>






                                            @empty

                                            @endforelse
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </li>

            <li class="nav-item sidebar-user-actions">
              <div class="sidebar-user-menu">
                <a href={{url('cıkısyap')}} class="nav-link"><i class="mdi mdi-logout menu-icon"></i>
                  <span class="menu-title">Çıkış Yap</span></a>
              </div>
            </li>
          </ul>
        </nav>

        <div class="main-panel">
          <div class="content-wrapper">

            <div class="d-xl-flex justify-content-between align-items-start">
              <h2 class="text-dark font-weight-bold mb-2"> Danışmanlar </h2>


            </div>
            <div class="row">
              <div class="col-md-12">

                <table class="styled-table">

                    <thead>
                        <tr>
                         <td>Danısman Numarası</td>
                            <td>Adı</td>
                                <td>Soyad</td>
                                    <td>Mail Adresi</td>
                                        <td>Ünvan</td>





                     </tr>
                    </thead>

                    @foreach($datas as $data)
                    <tbody>
                        <tr class="active-row">
                        <td>{{$data->numara}}</td>
                        <td>{{$data->ad}}</td>
                        <td>{{$data->soyad}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->ünvan}}</td>


                    </tr>
                        </tbody>





                    @endforeach

                    </table>

              </div>
            </div>
          </div>

        </div>

      </div>

    </div>

    <script src="{{URL::asset('vendors/js/vendor.bundle.base.js')}}"></script>

    <script src="{{URL::asset('vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{URL::asset('vendors/jquery-circle-progress/js/circle-progress.min.js')}}"></script>

    <script src="{{URL::asset('js/off-canvas.js')}}"></script>
    <script src="{{URL::asset('js/hoverable-collapse.js')}}"></script>
    <script src="{{URL::asset('js/misc.js')}}"></script>

    <script src="{{URL::asset('js/dashboard.js')}}"></script>

  </body>
</html>
