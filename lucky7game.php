<html>
<head></head>
<body>
<?php
$action = $_GET['action'] ?? '';
$ob = $_GET['balance'] ?? 100;

if (strtolower($action) === 'reset') {
	$ob = 100;
}

?>
Opening Balance: <?= $ob?>
<br>
<?php 
	if ($ob <= 0) {
		echo 'Sorry you dont have balance to Play!!';
	} else {
?>
		<div>
		<a href="/test.php?bid=below&balance=<?= $ob?>">[Below 7]</a>
		<a href="/test.php?bid=lucky&balance=<?= $ob?>">[Lucky 7]</a>
		<a href="/test.php?bid=above&balance=<?= $ob?>">[Above 7]</a>
		</div>
<?php

		$bid = $_GET['bid'] ?? '';

		if (!empty($bid)) {
			function roll_dice()
			{
				return rand(1,6);
			}

			$dice1 = roll_dice();
			$dice2 = roll_dice();

			$sum = $dice1 + $dice2;
			
			$ob -= 10;
			
			$msg = 'Sorry you did not win';
			
			if (strtolower($bid) === 'below' && $sum < 7) {
				$ob += 20;
				$msg = 'You guess right';
			} else if (strtolower($bid) === 'lucky' && $sum == 7) {
				$ob += 30;
				$msg = 'You are a lucky winner';
			} else if (strtolower($bid) === 'above' && $sum > 7) {
				$ob += 20;
				$msg = 'You guess right';
			}
			
			echo '<br> Dice 1 : '. $dice1;
			echo '<br> Dice 2 : '. $dice2;
			echo '<br> Total : '. $sum;
			
			
			echo '<br>'.$msg.'<br>';
			echo '<br>Available Balance : '.$ob;
			echo '<br><div><a href="/test.php?action=continue&balance='.$ob.'">[Continue]</a>';
			echo '<a href="/test.php?action=reset">[Reset & Play]</a></div>';

		}
	}
?>
</body>
</html>
