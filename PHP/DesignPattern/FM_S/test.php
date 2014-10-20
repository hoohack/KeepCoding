<?php

	include 'SingletonFM.php';

	$PizzaStore = SinglePizzaStore::getInstance('NY');

	$pizza = $PizzaStore->getPizza();

	$cheesePizza = $pizza->orderPizza("cheese");
	
	echo $cheesePizza->getName();