<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP First Steps</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Quicksand";
            background-color: #eaedf8;
            margin: 0px;
        }

        .footer {
            padding: 12px;
        text-align: center;
        background-color: #343434;
        color: white;
        position:absolute;
        bottom: 0;
        width: 100%;
        }

        .menubar {
            background-color: white;
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 80px;
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
        }

        .main {
            display: flex;
            margin-top: 80px;
        }

        .menu {
            /* width: 20%; */
            background-color: #746CF5;
            height: 100vh;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: white;
            padding: 8px;
            display: flex;
            align-items: center;
        }

        .menu a:hover{
            background-color: rgba(255, 255, 255, 0.1)
        }

        .menu img {
            margin-right: 8px;
        }

        .content {

        }

        .avatar {
            border-radius: 100%;
            background-color: yellowgreen;
            padding 16px;
            width: 32px;
            height: 32px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 8px;

        }

        .login {
            display: flex;
            align-items: center;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.05);
            margin-bottom: 16px;
            border-radius: 8px;
            padding: 8px;
            padding-left: 64px;
            position: relative;
        }

        .profile-picture {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 2px solid white;
            position: absolute;
            left: 8px;
        }
    </style>
</head>
<body>
    <div class="menubar">
        <h1>Contact Book</h1>
        <div class="login">
                <div class="avatar">TS</div>Thomas Schulz
        </div>
    </div>
    <div class="main">
        <div class="menu">
            <a href="index.php?page=start"><img src="img/home.svg"/>Start</a>
            <a href="index.php?page=contacts"><img src="img/book.svg"/>Kontakte</a>
            <a href="index.php?page=add_contact"><img src="img/add.svg"/>Kontakt hinzufügen</a>
            <a href="index.php?page=legal"><img src="img/legal.svg"/>Impressum</a>
        </div>

        <div class="content">
            <?php
                $headline = 'Herzlich willkommen!';
                $fileName = 'contacts.txt';
                $contacts = [];
                $debugOut = false;

                if (file_exists($fileName)){
                    $contactsFromFile = file_get_contents($fileName, true);
                    $contacts = json_decode($contactsFromFile, true);
                }

                if (isset($_POST['name']) && isset($_POST['phone'])){
                    if ($debugOut == true){
                        echo 'Contact <b>' . $_POST['name'] . '</b> was sent...';
                    }

                    $newContact = [
                        'name' => $_POST['name'],
                        'phone' => $_POST['phone']
                    ];
                    array_push($contacts, $newContact);
                    file_put_contents($fileName, json_encode($contacts, JSON_PRETTY_PRINT));
                    if ($debugOut == true){
                        echo 'Contact <b>' . $_POST['name'] . '</b> was stored...';
                    }
                }

                echo '<h1>' . $headline . '</h1>';
                if (isset($_GET['page'])) {
                    if ($_GET['page'] == 'start'){
                        echo "<p>You are on the starting page.</p>";
                    }
                    else if ($_GET['page'] == 'contacts'){
                        echo "
                        <p>Here you have an overview about your contacts.</p>
                        ";

                        // echo '<table><tr><th>Name</th><th>Phone</th></tr>';

                        foreach ($contacts as $contact){
                            $name = $contact['name'];
                            $phone = $contact['phone'];
                        //     echo '<tr><td>'. $name .'</td><td>' . $phone . '</td></tr>';
                        // echo '</table>';
                            echo "
                            <div class='card'>
                                <img class='profile-picture' src='img/profile-picture.svg' />
                                <b>$name</b></br><a href='tel:$phone'><img src='img/call.svg' />$phone</a>
                            </div>";
                        }
                    }
                    else if ($_GET['page'] == 'add_contact'){
                        echo "
                        <p>Here you can add another contact.</p>
                        <form action='?page=contacts' method='POST'>
                            <input placeholder='Enter name' name='name'/></br>
                            <input placeholder='Enter phone number' name='phone'/></br>
                            <button type='submit'>Absenden</button>
                        </form>
                        ";
                    }

                }
            ?>
        </div>
    </div>

    <div class="footer">
        <?php echo '(C) ' . date("Y") . " | Thomas Schulz" ?>
    </div>
</body>
</html>