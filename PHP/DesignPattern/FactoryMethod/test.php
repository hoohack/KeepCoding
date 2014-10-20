<?php

	include 'NYPizzaStore.php';

	$nyPizzaStore = new NYPizzaStore();

	$pizza = $nyPizzaStore->orderPizza("cheese");
	
	echo $pizza->getName();