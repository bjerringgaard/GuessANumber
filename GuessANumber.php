<?php
// Start Seesion to keep number remembered
session_start();

if(!isset($_SESSION['number']))
{
    $_SESSION['number'] = rand(1, 10);
}

if(!isset($_SESSION['counter']))
{
    $_SESSION['counter'] = 0;
}
else
{
    $_SESSION['counter']++;
}

$rand = $_SESSION['number'];
$counter = $_SESSION['counter'];
$guess = isset($_POST['guess']) ? (int) $_POST['guess'] : false;

// Restart on refresh after correct or failed Attempt
if($guess == $rand)
{
    unset($_SESSION['number']);
    unset($_SESSION['counter']);
}
else if($counter > 2)
{
    unset($_SESSION['number']);
    unset($_SESSION['counter']);
}
?>


<html>
<head>
<title>Guess A Number</title>
</head>

<body>

<h1>Guess a Number between 1 and 10</h1>

<?php

if ($guess != false)
{
    print "The number you input was $guess <br />";

    if ($counter > 2)
    {
        print "OUT OF ATTEMPTS <br>";
    }

    if ($guess == $rand)
    {
        print "You are correct <br />";
        print "You guessed it in ".$counter." attempt(s).";
    }
    else if ($guess != $rand && $counter < 3)
    {
        if($guess > $rand)
        {
            print "You are too high. <br />";
            print "Try again";
        }
        else if ($guess < $rand)
        {
            print "You are too low. <br />";
            print "Try again";
        }
    }
}

?>

<?php if($guess != $rand && $counter < 3): ?>
<form action = "" method = "post">
    
        <label>Enter a number: </label>
        <input type = "text" name = "guess" /><br />
        <button type = "submit">Submit</button>
    
</form>

<?php else: ?>
<a href="GuessANumber.php">Press Here to Restart</a>
<?php endif; ?>

</body>
</html>