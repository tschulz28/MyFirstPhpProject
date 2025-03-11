<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello World!</h1>
    <p>Hi, this is a paragraph.</p>
    <p>This will be my first php project.</p>
    <?php
        $name = get_current_user(); //'Thomas';
        echo '<p>Hallo ' . $name . '!</p>';

        $zahl1 = rand(0, 10);
        $zahl2 = rand(0, 10);

        echo '<p>A small calculation with randomized variables:</br>'. $zahl1 . ' * ' . $zahl2 .' = ' . $zahl1 * $zahl2 . '</p>';
    ?>
    
    <button onclick="goBack()">Zurück</button>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>