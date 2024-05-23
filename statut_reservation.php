<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: connexion.php");
    exit;
}

// Vérifie si l'utilisateur est un administrateur
if ($_SESSION["user_type"] !== "Admin") {
    // Redirige vers une page d'erreur si l'utilisateur n'est pas un administrateur
    header("location: erreur_acces.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<header>
        <h1>Statut des réservations</h1>
        <nav>
            <ul>
                <li><a href="index.html #header">Accueil</a></li>
                <li><a href="index.html #contact">Contact</a></li>
                <li><a href="index.html #flotte">Flotte</a></li>
                <li><a href="index.html #services">Services</a></li>
                <li><a href="reservation.php">Réserver un taxi</a></li>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="gestion_utilisateur.php">Gérer un utilisateur</a></li>
                <li><a href="statut_reservation.php">Statut des réservations</a></li>
            </ul>
        </nav>
    </header>
    <?php
include 'base.php'; // Assurez-vous que ce fichier contient vos informations de connexion

$sql = "SELECT ID_TAXI, ID_UTILISATEUR, ID_TYPE_TARIF, LIEU_DE_DEPART, LIEU_D_ARRIVE, DATE_DEPART, HEURE_DEPART FROM reservation ORDER BY ID_UTILISATEUR ASC"; // Modifié selon la partie de la base de base de données
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID_TAXI</th>
                <th>ID_UTILISATEUR</th>
                <th>ID_TYPE_TARIF</th>
                <th>LIEU_DE_DEPART</th>
                <th>LIEU_D_ARRIVE</th>
                <th>DATE_DEPART</th>
                <th>HEURE_DEPART</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["ID_TAXI"]."</td>
                <td>".$row["ID_UTILISATEUR"]."</td>
                <td>".$row["ID_TYPE_TARIF"]."</td>
                <td>".$row["LIEU_DE_DEPART"]."</td>
                <td>".$row["LIEU_D_ARRIVE"]."</td>
                <td>".$row["DATE_DEPART"]."</td>
                <td>".$row["HEURE_DEPART"]."</td>
                <td>
                </tr>";
        }
        echo "</table>";
        } else {
        echo "0 résultats";
        }

$conn->close();
?>
</body>
</html>

