<?php
	$memHost = 'localhost';
	$memPort = '11211';

	$memCached = new Memcache();

	$memCached->addServer($memHost, $memPort);

	if (!$counter = $memCached->get('myCounter')) {
		$counter = 1;
		$memCached->add('myCounter', $counter, 120);
	} else {
		$counter++;
		$memCached->set('myCounter', $counter, 120);

		if ($counter >= 30) {
			$memCached->flush();
		}
	}

	echo 'Your visitor number: ' . $counter;