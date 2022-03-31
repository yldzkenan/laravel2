<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
                        <br>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	<img src="{{ URL:: asset ('images/kocaeli-universitesi-logo.png')}}" <style height=180px weight=180px  alt="logo">
					</div>
                    <br>

                    <p style="font-size:25px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kocaeli Üniversitesi Proje Takip Sistemi </p>
					<div class="card fat">
						<div class="card-body">

							<form method="POST" class="my-login-validation" action="{{url('ekle')}}">
                                @csrf
                                @if(session('status'))
                                <h5 style="margin-left: 10px">{{session('status')}}</h5>
                              @endif
                              <div class="form-group">
                                <label >Ad</label>
                                <input  class="form-control" name="ad" value="" >

                            </div>
                            <div class="form-group">
                                <label >Soyad</label>
                                <input  class="form-control" name="soyad" value="" >

                            </div>
                            <div class="form-group">
                                <label >Numara</label>
                                <input  class="form-control" name="numara" value="" >

                            </div>
                            <div class="form-group">
                                <label >E-mail</label>
                                <input  class="form-control" name="email" value="" >

                            </div>
                            <div class="form-group">
                                <label >Sifre</label>
                                <input type="password" class="form-control" name="sifre" value="" >

                            </div>
                            <div class="form-group">
                                <label >Fakülte</label>
                                <input  class="form-control" name="fakülte" value="" >

                            </div>
                            <div class="form-group">
                                <label >Bölüm</label>
                                <input  class="form-control" name="bölüm" value="" >

                            </div>
                            <div class="form-group">
                                <label >Sınıf</label>
                                <input  class="form-control" name="sınıf" value="" >

                            </div>
                            <div class="form-group">
                                <label >Telefon</label>
                                <input  class="form-control" name="telefon" value="" >

                            </div>




								<div class="form-group m-0">

									<button type="submit" class="btn btn-primary btn-block" style="background-color:forestgreen">
										Ekle
									</button>
								</div>
<p>Not: Yönetici tarafından sisteme eklenene kadar giriş yapılamaz. Mail ile bilgilendirme yapılcaktır.</p>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>


</body>
</html>
