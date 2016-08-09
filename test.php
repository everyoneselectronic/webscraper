<?php
	/*
	 * Goutte - How to click a link on a webpage
	 */

	$loader = require 'vendor/autoload.php';
	$loader->add('AppName', __DIR__.'/../src/');

	use Goutte\Client;

	// $urls = array(			"https://society6.com/studio/blog/back-to-school-checklist-2-4-weeks-away-7sr",

    $page_urls = array(
    	"https://society6.com/studio/blog/page/1",
    	"https://society6.com/studio/blog/page/2",
    	"https://society6.com/studio/blog/page/3",
    	"https://society6.com/studio/blog/page/4",
    	"https://society6.com/studio/blog/page/5"
    );

	$client = new \Goutte\Client();

	// Create and use a guzzle client instance that will time out after 90 seconds
	$guzzleClient = new \GuzzleHttp\Client(array(
		'timeout' => 90,
		'verify' => false,
	));

	$client->setClient($guzzleClient);


	$urls = array();
	// get page urls
	foreach ($page_urls as $url) {

		$crawler = $client->request('GET', $url);
		$link = $crawler->filter(".post-title > a")->extract('href');

		foreach ($link as $u) {
			array_push($urls, $u);
			// echo "<p>" . $u . "</p>";
		}
	}

	foreach ($urls as $url) {

		echo "<p>" . $url ."</p>";

		$crawler = $client->request('GET', $url);

		$name = $crawler->filter("h1.post-title")->text();

		// echo "<p>" . $name ."</p>";

		$result = $crawler
			->filter('.post-text img')
			// ->filterXpath('//img[contains(@src, "0089")]')
			// ->filterXPath('//img[contains(@alt, "' . $name . '")]')
			// ->filterXPath('//img/@src')
			->last()
			->extract('src');

		// echo "<p><img src='" . $result[0] . "'></p>";



		if ($result)
		{
			list($width, $height) = getimagesize($result[0]);
			if ($width == 700 && $height == 700)
			{
				// $image = $img;
				echo "<p>" . $name . "</p><img src='" . $result[0] . "'>";

			}
		}

		$crawler = null;
		$name = null;
		$result = null;
	}
?>
