<?php
$firma = 'Szprycha';
$rok = date('Y');

$cennik = [
    ['nazwa' => 'Przegląd podstawowy', 'cena' => 120],
    ['nazwa' => 'Przegląd sezonowy', 'cena' => 220],
    ['nazwa' => 'Wymiana dętki', 'cena' => 40],
    ['nazwa' => 'Centrowanie koła', 'cena' => 60],
    ['nazwa' => 'Wymiana łańcucha', 'cena' => 50],
];

// Bonus 1: powitanie z adresu, np. index.php?imie=Ola
$imie = $_GET['imie'] ?? 'Gościu';

// Bonus 2: wymiary wykresu SVG
$maxCena = max(array_column($cennik, 'cena'));
$pasek = 28;       // wysokość jednego paska
$odstep = 12;      // odstęp między paskami
$lewo = 180;       // miejsce na nazwy usług
$dlugosc = 380;    // długość najdłuższego paska
$wysokoscWykresu = count($cennik) * ($pasek + $odstep);
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
      <a class="logo" href="#">
        <svg
          viewBox="0 0 120 64"
          width="72"
          height="38"
          role="img"
          aria-labelledby="logo-tytul"
        >
          <title id="logo-tytul">Szprycha</title>
          <g
            fill="none"
            stroke="currentColor"
            stroke-width="5"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <circle cx="28" cy="42" r="18" />
            <circle cx="92" cy="42" r="18" />
            <polyline points="28,42 48,14 80,14 92,42" />
            <polyline points="48,14 60,42 80,14" />
          </g>
        </svg>
        <span>Szprycha</span>
      </a>

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
        <p class="powitanie">Cześć, <?= htmlspecialchars($imie) ?>!</p>
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
            <?php foreach ($cennik as $usluga): ?>
              <tr>
                <td><?= htmlspecialchars($usluga['nazwa']) ?></td>
                <td class="num"><?= $usluga['cena'] ?> zł</td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <figure class="wykres">
          <svg
            viewBox="0 0 640 <?= $wysokoscWykresu ?>"
            role="img"
            aria-labelledby="wykres-tytul"
          >
            <title id="wykres-tytul">Wykres cen usług w złotych</title>
            <?php foreach ($cennik as $i => $usluga): ?>
              <?php
              $y = $i * ($pasek + $odstep);
              $szerokosc = round($usluga['cena'] / $maxCena * $dlugosc);
              ?>
              <text x="<?= $lewo - 10 ?>" y="<?= $y + 19 ?>" text-anchor="end"><?= htmlspecialchars($usluga['nazwa']) ?></text>
              <rect x="<?= $lewo ?>" y="<?= $y ?>" width="<?= $szerokosc ?>" height="<?= $pasek ?>" rx="4" />
              <text x="<?= $lewo + $szerokosc + 8 ?>" y="<?= $y + 19 ?>"><?= $usluga['cena'] ?> zł</text>
            <?php endforeach; ?>
          </svg>
          <figcaption>Ceny usług – wykres rysowany pętlą PHP z tablicy $cennik</figcaption>
        </figure>
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
