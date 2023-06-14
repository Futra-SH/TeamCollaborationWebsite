<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Page</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/landingpage.css')}}"/>
  </head>
  <body>
    <main>
      <div class="big-wrapper light">
        <header>
          <div class="container">
            <div class="logo">
              <img src="{{ asset('/assets/images/logo_cy.jpeg') }}" alt="Logo" />
              <h3>CollabYuk | Kolaborasi Tim</h3>
            </div>

            <div class="links">
              <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Tentang</a></li>
                <li><a href="#">Kontak</a></li>
                <li><a href="{{ route('login')}}" class="btn">Daftar</a></li>
              </ul>
            </div>

            <div class="overlay"></div>

            <div class="hamburger-menu">
              <div class="bar"></div>
            </div>
          </div>
        </header>

        <div class="showcase-area">
          <div class="container">
            <div class="left">
              <div class="big-title">
                <h1>Masa depan disini,</h1>
                <h1>mulai projekmu sekarang!</h1>
              </div>
              <p class="text">
                Dengan CollabYuk kalian bisa bekerjasama dengan tim seperti berdiskusi, monitoring, dan berbagi tugas untuk menyelesaikan suatu projek tanpa harus bertemu secara langsung.
              </p>
              <h4>Kontak Kami: 085246929540</h4>
              <div class="cta">
                <a href="{{ route('login')}}" class="btn">Mulai</a>
              </div>
            </div>

            <div class="right">
              <img src="{{ asset('/assets/images/team.svg') }}" alt="Team Image" class="team" />
            </div>
          </div>
        </div>

        <div class="bottom-area">
          <div class="container">
            <button class="toggle-btn">
              <i class="far fa-moon"></i>
              <i class="far fa-sun"></i>
            </button>
          </div>
        </div>
      </div>
    </main>

    <!-- JavaScript Files -->

    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script src="{{ asset('/assets/js/landingpage.js') }}"></script>
  </body>
</html>