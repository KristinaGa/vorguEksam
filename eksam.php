<!-- Loo lihtsustatud enampakkumise süsteem. Kasutajad saavad teha pakkumisi. Kuva parima pakkuja nime ja summat. -->

<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <title>Eksamitöö Kristina Garmatjuk</title>

    <body>
        <div>
        <form action="" method="POST">
            <table border="1">
                <tr>
                    <th id = "pais" colspan="2">Enampakkumise vorm</th>
                </tr>
                <tr>
                    <td class = "vali">
                        <label>Sinu nimi</label>
                        <input type="text" name="nimi">
                    </td>
                    <td class = "vali">
                        <label>Sinu pakkumine</label>
                        <input type="number" name="pakkumine">
                    </td>
                <tr>
                    <td id = "nupp" colspan="2">
                        <input type="submit" name="esita" value="Esita pakkumine">
                    </td>
                </tr>
                </tr>
            </table>
        </form>
        </div>

        <?php
        $host = "localhost";
        $user = "test";
        $pass = "t3st3r123";
        $db = "test";
        $connection = mysqli_connect($host, $user, $pass, $db);


        if(isset($_POST['esita'])){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['nimi']) && $_POST['nimi'] != ""){
            $nimi = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['nimi']));
        }
        if (isset($_POST['pakkumine']) && $_POST['pakkumine'] != ""){
            $pakkumised = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['pakkumine']));
        }
        }
    
        if (isset($_POST['nimi']) && $_POST['nimi'] != ""){
        $query = "INSERT INTO kgarmatj_enampakkumine (nimi, summa) VALUES('$nimi', '$pakkumised')";
        $result = mysqli_query($connection, $query) or die("$query - " . mysqli_error($connection));
        } else {
        echo "Sisesta nimi";
        }
        }
        $query2 = "SELECT nimi, summa FROM kgarmatj_enampakkumine where summa=(SELECT MAX(summa) from kgarmatj_enampakkumine)";
        $result2 = mysqli_query($connection, $query2) or die("$query2 - " . mysqli_error($connection));
        while ($pakkumised = $result2 -> fetch_assoc()){
            echo "<p>".$pakkumised['nimi']." - ".$pakkumised['summa']."</p>";
        }
        mysqli_close($connection);
        ?>

    </body>
    </head>
</html>
