<?php
$start = microtime(true);
$username = 'payhack';
$password = 'payhack';
$DB = new PDO('mysql:host=php_mysql;dbname=payhack',
        $username, $password,
        array(PDO::ATTR_PERSISTENT => true)
        );

if(isset($_POST['restore']))
    setBalance(10000);

if(isset($_GET['wd']))
    withdraw($_GET['wd']);

echo "Current balance: " . getBalance();

function withdraw($amount)
{
    $balance = getBalance();
    if($amount <= $balance)
    {
        $balance = $balance - $amount;
        echo "You have withdrawn: $amount <br />";
        setBalance($balance);
    }
    else
    {
        echo "Insufficient funds.";
    }
}

/*
 * Use this to experiment with adding extra processing time to the withdraw
 * process.
 */
function doWork()
{
    for($i = 0; $i < 1000; $i++)
        $x *= $x;
}

function setBalance($x)
{
    global $DB;
    $q = $DB->prepare("UPDATE `moneyz` SET balance=:x WHERE 1=1");
    $q->bindParam(':x', $x);
    $q->execute();
}

function getBalance()
{
    global $DB;
    $q = $DB->prepare("SELECT balance FROM `moneyz` WHERE 1=1");
    $q->execute();
    return (int)$q->fetchColumn();
}
?>

<form action="poc.php" method="post">
    <input type="submit" name="restore" value="Reset Balance" />
</form>
add ?wd=x to withdraw $x
<br /><br />

<?php
$end = microtime(true);

$t = $end - $start;
echo "Execution time: $t seconds";
?>
