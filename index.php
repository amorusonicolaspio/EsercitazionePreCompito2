<?php
    // inizializzo
    $a = 0;
    $b = 0;
    $operazioni = "";
    $options = [];
    $risultato = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // controllo input
        if (isset($_POST['a'])) {
            $a = $_POST['a'];
        } else {
            $a = 0;
        }

        if (isset($_POST['b'])) {
            $b = $_POST['b'];
        } else {
            $b = 0;
        }

        if (isset($_POST['operazioni'])) {
            $operazioni = $_POST['operazioni'];

            if ($operazioni == "somma") {
                $risultato = $a + $b;
            } elseif ($operazioni == "differenza") {
                $risultato = $a - $b;
            } elseif ($operazioni == "prodotto") {
                $risultato = $a * $b;
            } elseif ($operazioni == "quoziente") {
                if ($b != 0) {
                    $risultato = $a / $b;
                } else {
                    $risultato = "Errore: divisione per zero";
                }
            } else {
                $risultato = "";
            }
        } else {
            $operazioni = "";
        }

        if ($risultato !== "" && $risultato !== "Errore: divisione per zero") {
            if (isset($_POST['options'])) {
                $options = $_POST['options'];
                if (in_array("assoluto", $options)) {
                    $risultato = abs($risultato);
                }
                if (in_array("quadrato", $options)) {
                    $risultato = pow($risultato, 2);
                }
                if (in_array("arrotonda", $options)) {
                    $risultato = round($risultato, 2);
                }
            } else {
                $options = [];
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    fieldset {
        width: 200px;
    }
</style>
<body>
    <h1>Calcolatrice</h1>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'GET'): ?>
    <form action="" method="post">
        <div>            
            <label for="a">a:</label>
            <input type="number" id="a" name="a" value="<?php echo $a; ?>" required>
        </div>
        <div>
            <label for="b">b:</label>
            <input type="number" id="b" name="b" value="<?php echo $b; ?>" required>
        </div>

        <br>

        <fieldset>
            <legend>Operazione</legend>
            <div>
                <input type="radio" id="somma" name="operazioni" value="somma" required>
                <label for="somma">somma</label>
            </div>
            <div>
                <input type="radio" id="differenza" name="operazioni" value="differenza" required>
                <label for="differenza">differenza</label>
            </div>
            <div>
                <input type="radio" id="prodotto" name="operazioni" value="prodotto" required>
                <label for="prodotto">prodotto</label>
            </div>
            <div>
                <input type="radio" id="quoziente" name="operazioni" value="quoziente" required>
                <label for="quoziente">quoziente</label>
            </div>
        </fieldset>

        <br>

        <fieldset>
            <legend>Opzioni</legend>
            <div>
                <input type="checkbox" id="assoluto" name="options[]" value="assoluto">
                <label for="assoluto">valore assoluto</label>
            </div>
            <div>
                <input type="checkbox" id="quadrato" name="options[]" value="quadrato">
                <label for="quadrato">quadrato</label>
            </div>
            <div>
                <input type="checkbox" id="arrotonda" name="options[]" value="arrotonda">
                <label for="arrotonda">arrotonda a 2 decimali</label>
            </div>
        </fieldset>

        <br>

        <input type="submit" value="Calcola">
    </form>
    <?php endif; ?>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && $risultato !== ""): ?>
        <p>Risultato: <?php echo $risultato; ?></p>
    <?php endif; ?>

</body>
</html>
