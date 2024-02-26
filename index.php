<?php
$mysqli = new mysqli("localhost", "root", "", "compito", 3306);

$nome = isset($_POST['nome_artista']) ? $_POST['nome_artista'] : '';
$cognome = isset($_POST['cognome_artista']) ? $_POST['cognome_artista'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query_artista = "SELECT id_artista FROM artista WHERE nome_artista = '$nome' AND cognome_artista = '$cognome'";
    $result_artista = $mysqli->query($query_artista);

    if ($result_artista && $result_artista->num_rows > 0) {
        $id_artista = $result_artista->fetch_assoc()['id_artista'];

        $query_opere = "SELECT * FROM opera WHERE id_artista = $id_artista";
        $result_opere = $mysqli->query($query_opere);

        echo "<h2>Opere di $nome $cognome</h2>";
        echo "<ul>";
        while ($opera = $result_opere->fetch_assoc()) {
            echo "<li>{$opera['nome_opera']} ({$opera['tipo_opera']})</li>";
        }
        echo "</ul>";
    } else {
        echo "Errore: Artista non trovato.";
    }
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Ricerca opere d'arte</title>
</head>
<body>
  <h1>Ricerca opere per artista</h1>
  <form method="post" action="">
    Nome: <input type="text" name="nome_artista" required><br>
    Cognome: <input type="text" name="cognome_artista" required><br>
    <input type="submit" value="Ricerca">
  </form>
  <a href="artisti_opere.php"><button>ARTISTI OPERE</button></a><br>
  <br>
  <a href="inserisci_opera.php"><button>INSERISCI OPERA</button></a>
</body>
</html>
