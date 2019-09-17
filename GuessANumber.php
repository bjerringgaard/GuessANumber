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

//HTML
<html>
<head>
<title>Guess A Number</title>
</head>

<body>

<h1>Guess a Number between 1 and 10</h1>

<?php
//if not empty guess was made
if ($guess != false)
{
    print "The number you input was $guess <br>";

// If you used more than 2+Update atttempt, giving you 3 attempts (Little error if you complete it on 3rd try)
    if ($counter > 2)
    {
        print "OUT OF ATTEMPTS <br>";
    }

//Correct guess
    if ($guess == $rand)
    {
        print "You are correct <br>";
        print "You guessed it in ".$counter." attempt(s).";
    }

// Guide to know if you need to go higher or lower
    else if ($guess != $rand && $counter < 3)
    {
        if($guess > $rand)
        {
            print "You are too high. <br>";
            print "Try again";
        }
        else if ($guess < $rand)
        {
            print "You are too low. <br>";
            print "Try again";
        }
    }
}

?>

//Form for input and looks
<?php if($guess != $rand && $counter < 3): ?>
<form action = "" method = "post">
    
        <label>Enter a number: </label>
        <input type = "text" name = "guess"><br>
        <button type = "submit">Submit</button>
    
</form>

// if you get it Correct or Fail
<?php else: ?>
<a href="GuessANumber.php">Click Here to Restart</a>
<?php endif; ?>

</body>
</html>