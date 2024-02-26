<?php
$mysqli = new mysqli("localhost", "root", "", "compito", 3306);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_opera = isset($_POST['nome_opera']) ? $mysqli->real_escape_string($_POST['nome_opera']) : '';
    $tipo_opera = isset($_POST['tipo_opera']) ? $mysqli->real_escape_string($_POST['tipo_opera']) : '';
    $id_artista = isset($_POST['id_artista']) ? (int)$_POST['id_artista'] : 0;

    if (empty($nome_opera) || empty($tipo_opera) || $id_artista <= 0) {
        echo "Errore: Tutti i campi devono essere compilati.";
    } else {
        $query_inserimento = "INSERT INTO opera (nome_opera, tipo_opera, id_artista) VALUES ('$nome_opera', '$tipo_opera', $id_artista)";
        
        if ($mysqli->query($query_inserimento)) {
            echo "Opera inserita correttamente.";
        } else {
            echo "Errore nell'inserimento dell'opera: " . $mysqli->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Inserisci opera</title>
</head>
<body>
  <h1>Inserisci opera</h1>
  <form method="post">
    Nome opera: <input type="text" name="nome_opera" required><br>
    Tipo opera: <select name="tipo_opera"><option value="Pittura">Pittura</option><option value="Scultura">Scultura</option></select><br>
    Artista: 
    <select name="id_artista">
      <?php
      $query_artisti = "SELECT id_artista, cognome_artista, nome_artista FROM artista";
      $result_artisti = $mysqli->query($query_artisti);

      while ($artista = $result_artisti->fetch_assoc()) {
        echo "<option value=\"{$artista['id_artista']}\">{$artista['cognome_artista']} {$artista['nome_artista']}</option>";
      }
      ?>
    </select><br>
    <input type="submit" value="Inserisci">
  </form>
  <br>
  <a href="artisti_opere.php"><button>ARTISTI OPERE</button></a><br>
  <br>
  <a href="index.php"><button>TORNA ALLA HOME</button></a><br>
</body>
</html>
