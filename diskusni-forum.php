<!DOCTYPE html>
<html lang='cs'>
  <head>
    <title>Diskusní fórum</title>
    <meta charset='utf-8'>
    <meta name='description' content='Aplikace s technologiemi PHP 7, MySQL, a JS s pokud možno objektově orientovaným kódem. Diskuzní fórum, které bude obsahovat formulář jehož vstupem bude jméno, email a text příspěvku. Zajištěná validace vstupu, všechna pole jsou povinná, email musí být ve správném tvaru. Následně pod formulářem se zobrazují všechny příspěvky, které jsou uloženy v databázi. Příspěvky musí být seřazeny chronologicky (první je nejnovější) a bude se u nich zobrazovat: jméno, email, text a datum přidání příspěvku. U každého příspěvku se také zobrazuje celkový počet příspěvků, který uživatel napsal (dle emailu).'>
    <meta name='keywords' content='Aplikace, PHP, SQL'>
    <meta name='author' content='Martin Allmer'>
    <meta name='robots' content='none'>
    <!-- <meta http-equiv='X-UA-Compatible' content='IE=edge'> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href='images/favicon.png' rel='shortcut icon' type='image/png'>
       
    <link href="https://fonts.googleapis.com/css?family=Archivo:400,500&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="css/normalize.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    
    <script src="javascript/varovani-a-blokace.js"></script>
  </head>
  <body>
    <main class="Center-global Cf">
      <h1>Diskuzní fórum</h1>
      <p>
         (Jak jste si zřejmě všimli, věnujeme se také <a href="https://tvorimekrasnestranky.cz/currently.php" rel="external" title="Chcete svůj web?" target="_blank">tvorbě webů</a>. Tohle diskusní fórum je námi naprogramovanou webovou aplikací.)
      </p> 
            
      <form name="Forum" action="index.php" method="post">
        <p>
          Jméno<br><input type="text" name="jmeno" size="25" onBlur="Jmeno_Varovani()"> 
          <br>E-mail<br><input type="email" name="email" size="25" onBlur="Email_Varovani()"> 
          <br>Zápis<br><textarea name="zprava" rows="5" cols="25" onBlur="Zprava_Varovani()"></textarea>
          <br><input type="submit" value="Odeslat zápis" title="Odeslat příspěvek" onFocus="Email_Blokace()">
        </p>  
      <form>
      
      <?php
      /* -- Připojení k databázi -- */
      $db_spojeni = mysqli_connect ('localhost', 'allmer1568903790', 'LOK4omo3TIV2a', 'allmer1568903790', 3314);
      // Zjištění, zda se pripojení zdařilo
      if ($db_spojeni)
        echo '<p class="Vporadku">Připojení se zdařilo.</p>';
      else {
        echo '<p class="Chyba">Připojení se nezdařilo!';
        echo '<br>Popis chyby: ' . mysqli_connect_error() . '</p>';
      }
      
      // Správné nastavení češtiny
      $objekt_vysledku = mysqli_query($db_spojeni, "SET NAMES 'utf8'");
      if (!$objekt_vysledku) {
        echo '<p class="Chyba">Chyba v&nbsp;příkazu SQL. Popis chyby:' . mysqli_error($db_spojeni) . '</p';
        exit();
      }
      
      // Testujeme, zda zrovna přišla data z formuláře
      if (isset($_POST['zprava'])) {
        if ($_POST['jmeno'] == '' || $_POST['email'] == '' || $_POST['zprava'] == '') {  // Testujeme, zda některá položka nezůstala prázdná
          echo '<p class="Chyba">Nastala chyba, protože žádná položka formuláře nemůže být prázdná.<br>Vyplňte prosím formulář znovu.</p>';
        }    
        else {  // Vkládáme zápis do databáze
          // 1) vytvoření (SQL příkazu typu INSERT*).
          $sql_prikaz = 
            "INSERT INTO diskuzni_forum(datum, jmeno, email, zapis) "
            ."VALUES(NOW(),'"
            .mysqli_real_escape_string($db_spojeni, $_POST['jmeno'])
            ."','"
            .mysqli_real_escape_string($db_spojeni, $_POST['email'])
            ."','"
            .mysqli_real_escape_string($db_spojeni, $_POST['zprava'])
            ."')"
            ;
        
          // 2) zaslání (SQL příkazu)* do databáze.
          $objekt_vysledku = mysqli_query($db_spojeni, $sql_prikaz);
         
          if (!$objekt_vysledku)
          {
            echo '<p class="Chyba">Poslání SQL příkazu se nepodařilo.';
            echo '<br>Popis chyby: ' . mysqli_error($db_spojeni) . '</p>';
            exit();
          }
          echo '<p class="Vporadku">Nový zápis do diskuzního fóra byl přidán.</p>';
        }
      }
      
      /* --- Vypiš všechny zápisy v návštěvní knize --- */
      
      // Zaslání příkazu SQL do databáze
      $objekt_vysledku_1 = mysqli_query($db_spojeni, 'SELECT * FROM diskuzni_forum ORDER BY datum DESC');
      if (!$objekt_vysledku_1) {
        echo '<p class="Chyba">Získání dat z&nbsp;databáze se nezdařilo <br>';
        echo 'Popis chyby: ' . mysqli_error($db_spojeni) . '</p>';
        exit();
      }
      
      // Zobrazení všech vrácených dat
      echo '<div class="Blok">';
      while ($radek = mysqli_fetch_array($objekt_vysledku_1)) {
        echo '<hr>';
        echo 'Datum a&nbsp;čas: ', $radek['datum'], '<br>';
        echo 'Napsal: ', $radek['jmeno'], ' (', $radek['email'],')<br>';
        echo 'Zápis: <span class="Zapis">', $radek['zapis'], '</span><br>'; 
        
        $AktualniEmail = $radek['email'];  /* Teď mám aktuální email v této proměnné, a do databáze ji normálně vložím, čímž předám hodnotu. */
        $objekt_vysledku_2 = mysqli_query($db_spojeni, "SELECT COUNT(*) FROM diskuzni_forum WHERE email='$AktualniEmail'");
          if (!$objekt_vysledku_2) {
          echo '<p class="Chyba">Získání dat z&nbsp;databáze se nezdařilo <br>';
          echo 'Popis chyby: ' . mysqli_error($db_spojeni) . '</p>';
          exit();
        }   /* SQL příkaz vrací kolik uživatelů ná email 'allmerovi@gmail.com' Pomocí konstrukce níže se k tomu dostanu */ 
        $radek2 = mysqli_fetch_array($objekt_vysledku_2);
        echo 'Celkový počet příspěvků tohoto uživatele: '. $radek2[0]; 
      }
      echo '</div>';
      echo '<hr>';
        
      //Uzavření objektů výsledku
      mysqli_free_result($objekt_vysledku_1);
      mysqli_free_result($objekt_vysledku_2);
      
      // Odpojení od databáze
      if ($db_spojeni)
        $succes = mysqli_close($db_spojeni);
      // Otestování zda se odpojení zdařilo
      if ($succes)
        echo '<p class="Vporadku">Databáze odpojena.</p>';
      else
        echo '<p class="Chyba">Odpojení selhalo</p>';     
      ?>   
    </main>  
  </body>
</html>
