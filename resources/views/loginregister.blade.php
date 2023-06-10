<!DOCTYPE html>
<html lang="en">
<head>
    <script
        src="https://kit.fontawesome.com/64d58efce2.js"
        crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('/css/loginregister.css')}}"/>
    <title>Daftar & Masuk</title>
</head>
<body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="#" class="sign-in-form">
            <h2 class="title">Masuk</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Nama pengguna" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Kata sandi" />
            </div>
            <input type="submit" value="Gabung" class="btn solid" />
            <p class="social-text">Atau masuk dengan platform sosial</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
          <form action="#" class="sign-up-form">
            <h2 class="title">Daftar</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Nama pengguna" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Kata sandi" />
            </div>
            <input type="submit" class="btn" value="Daftar" />
            <p class="social-text">Atau daftar dengan platform sosial</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Baru disini?</h3>
            <p>
              Belum punya akun? Silahkan klik tombol dibawah ini untuk bisa bergabung bersama kami ^^
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Daftar
            </button>
          </div>
          <img src="{{ asset('img/log.svg')}}" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Salah satu dari kami?</h3>
            <p>
              Sudah punya akun? Silahkan klik tombol dibawah ini untuk bisa masuk ke akun kalian ^^
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Masuk
            </button>
          </div>
          <img src="{{ asset('img/register.svg')}}" class="image" alt="" />
        </div>
      </div>
    </div>
    <script src="{{asset ('/js/loginregister.js')}}"></script>
  </body>
</html>