<?php 
$route = new Route();

$route->add('/', function() {
	echo 'HOME';
});

$route->add('/name', function() {
	echo 'Name Home';
});

$route->add('/noticia/.+', function($id) {
	echo "Notícia $id<br><br>";
});


$route->add('/this/is/the/.+/story/of/.+', function($first, $second) {
	echo "This is the $first story of $second";
});

$route->add('/404', function() {
	require("404.php");
});
$route->run();
