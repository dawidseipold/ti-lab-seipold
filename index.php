<?php
$firma = 'Szprycha';
$rok = date('Y');
?>
<!doctype html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Szprycha – serwis rowerowy</title>
    <link rel="stylesheet" href="style.css" />
    <script src="js/script.js" defer></script>
  </head>
  <body>
    <header class="site-header">
      <p class="logo">Szprycha</p>

      <button
        class="menu-toggle"
        type="button"
        aria-label="Menu"
        aria-expanded="false"
        aria-controls="menu"
      >
        <img class="icon-open" src="icons/menu.svg" alt="" width="28" height="28" />
        <img class="icon-close" src="icons/close.svg" alt="" width="28" height="28" />
      </button>

      <nav class="menu" id="menu">
        <a href="#uslugi">Usługi</a>
        <a href="#cennik">Cennik</a>
        <a href="#kontakt">Kontakt</a>
      </nav>
    </header>

    <main>
      <section class="hero">
        <h1>Pracownia Rowerowa Szprycha</h1>
        <p>
          Naprawiamy, serwisujemy i przygotowujemy rowery do sezonu. Bydgoszcz.
        </p>
        <img
          src="icons/rower.svg"
          alt="Rysunek roweru miejskiego"
          width="320"
          height="200"
        />
      </section>

      <section id="uslugi">
        <h2>Usługi</h2>
        <div class="cards">
          <article class="card">
            <h3>Przegląd podstawowy</h3>
            <p>
              Regulacja hamulców i przerzutek, smarowanie łańcucha, sprawdzenie
              ciśnienia.
            </p>
            <p class="card__price">od 120 zł</p>
          </article>
          <article class="card card--highlight">
            <p class="card__badge">Najczęściej wybierane</p>
            <h3>Przegląd sezonowy</h3>
            <p>
              Pełny przegląd przed sezonem: czyszczenie napędu, centrowanie kół,
              kontrola łożysk.
            </p>
            <p class="card__price">od 220 zł</p>
          </article>
          <article class="card">
            <h3>Naprawa na już</h3>
            <p>
              Wymiana dętki, opony lub linki od ręki – w większości przypadków w
              30 minut.
            </p>
            <p class="card__price">od 40 zł</p>
          </article>
        </div>
      </section>

      <section id="cennik">
        <h2>Cennik</h2>
        <table class="price-table">
          <thead>
            <tr>
              <th>Usługa</th>
              <th class="num">Cena</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Przegląd podstawowy</td>
              <td class="num">120 zł</td>
            </tr>
            <tr>
              <td>Przegląd sezonowy</td>
              <td class="num">220 zł</td>
            </tr>
            <tr>
              <td>Wymiana dętki</td>
              <td class="num">40 zł</td>
            </tr>
            <tr>
              <td>Centrowanie koła</td>
              <td class="num">60 zł</td>
            </tr>
            <tr>
              <td>Wymiana łańcucha</td>
              <td class="num">50 zł</td>
            </tr>
          </tbody>
        </table>
      </section>
    </main>

    <footer id="kontakt">
      <h2>Kontakt</h2>
      <address>
        Pracownia Rowerowa Szprycha<br />
        ul. Gdańska 10, 85-005 Bydgoszcz<br />
        Telefon: <a href="tel:+48500100200">500 100 200</a><br />
        E-mail: <a href="mailto:kontakt@szprycha.pl">kontakt@szprycha.pl</a>
      </address>
      <p>Czynne: pon.–pt. 10:00–18:00, sob. 10:00–14:00</p>
      <p>&copy; <?= $rok ?> <?= $firma ?></p>
    </footer>
  </body>
</html>
