<?php
$mysqli = new mysqli("localhost", "root", "", "compito", 3306);

$query_artisti = "SELECT a.id_artista, a.cognome_artista, a.nome_artista, COUNT(o.id_opera) AS totale_opere, COUNT(CASE WHEN o.tipo_opera = 'Pittura' THEN 1 END) AS totale_opere_pittura, COUNT(CASE WHEN o.tipo_opera = 'Scultura' THEN 1 END) AS totale_opere_scultura FROM artista a LEFT JOIN opera o ON o.id_artista = a.id_artista GROUP BY a.id_artista ORDER BY a.cognome_artista, a.nome_artista";
$result_artisti = $mysqli->query($query_artisti);

?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Elenco artisti con totali opere</title>
</head>
<body>
  <h1>Elenco artisti con totali opere</h1>
  <table>
    <tr>
      <th>Cognome</th>
      <th>Nome</th>
      <th>Totale opere</th>
      <th>Opere di pittura</th>
      <th>Opere di scultura</th>
    </tr>
    <?php
    while ($artista = $result_artisti->fetch_assoc()) {
      echo "<tr>";
      echo "<td>{$artista['cognome_artista']}</td>";
      echo "<td>{$artista['nome_artista']}</td>";
      echo "<td>{$artista['totale_opere']}</td>";
      echo "<td>{$artista['totale_opere_pittura']}</td>";
      echo "<td>{$artista['totale_opere_scultura']}</td>";
      echo "</tr>";
    }
    ?>
  </table>
  <br>
  <a href="inserisci_opera.php"><button>INSERISCI OPERA</button></a><br>
  <br>
  <a href="index.php"><button>TORNA ALLA HOME</button></a><br>

</body>
</html>
