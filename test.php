<?php
	/*
	 * Goutte - How to click a link on a webpage
	 */
	require 'phpmailer/PHPMailerAutoload.php';

	$loader = require 'vendor/autoload.php';
	$loader->add('AppName', __DIR__.'/../src/');


	use Goutte\Client;

	$client = new \Goutte\Client();

	// Create and use a guzzle client instance that will time out after 90 seconds
	$guzzleClient = new \GuzzleHttp\Client(array(
		'timeout' => 90,
		'verify' => false,
	));

	$client->setClient($guzzleClient);

	// images to get
	$images = array();

	// Society 6
	$baseUrlPosts = "https://society6.com";
	$stop_url = "https://society6.com/studio/blog/back-to-school-checklist-2-4-weeks-away-7sr";

    $page_urls = array(
    	"https://society6.com/studio/blog/page/1",
    	"https://society6.com/studio/blog/page/2",
    	"https://society6.com/studio/blog/page/3",
    	"https://society6.com/studio/blog/page/4",
    	"https://society6.com/studio/blog/page/5"
    );

	$urls = array();
	// get page urls
	foreach ($page_urls as $url) {

		// $link = $crawler->selectLink('Security Advisories')->link();
		// $crawler = $client->click($link);
		$crawler = $client->request('GET', $url);
		$link = $crawler->filter(".post-title > a")->extract('href');

		foreach ($link as $u) {
			$t = $baseUrlPosts . $u;
			if ($t == $stop_url) {
				break 2;
			}
			else {
				array_push($urls, $t);
				// echo "<p>" . $t . "</p>";
			}
			
		}
	}

	foreach ($urls as $url) {

		// echo "<p>" . $url ."</p>";

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
				array_push($image, $result[0]);
				echo "<p>" . $url . "</p><img src='" . $result[0] . "'>";

			}
		}
	}

	// boooooooooooooooooooooom

	$url_boom = "http://www.booooooom.com/?s=society6.com%2Fproduct%2F";
	$stop_url_boom = "http://www.booooooom.com/2016/07/27/artist-spotlight-casey-weldon/";
	$urlsPosts_boom = array();

	// get page urls
	$crawler = $client->request('GET', $url_boom);
	$link = $crawler->filter(".post > h2 > a")->extract('href');

	foreach ($link as $u) {
		// echo "<p>" . $t . "</p>";
		if ($u == $stop_url_boom) {
			break;
		}
		else {
			array_push($urlsPosts_boom, $t);
			echo "<p>" . $u . "</p>";
		}
		
	}

	foreach ($urlsPosts_boom as $url) {

		// echo "<p>" . $url ."</p>";

		$crawler = $client->request('GET', $url);

		$name = $crawler->filter(".post > h2 > a")->text();

		// echo "<p>" . $name ."</p>";

		$result = $crawler
			// ->filter('.post-text img')
			->filterXPath('//a[contains(@href, "society6.com/product/")]/img')
			// ->filterXpath('//img[contains(@src, "0089")]')
			// ->filterXPath('//img[contains(@alt, "' . $name . '")]')
			// ->filterXPath('//img/@src')
			// ->last()
			->extract('src');

		// echo "<p><img src='" . $result[0] . "'></p>";

		if ($result)
		{
			list($width, $height) = getimagesize($result[0]);
			if ($width == 1200 && $height == 1200)
			{
				array_push($image, $result[0]);
				echo "<p>" . $url . "</p><img src='" . $result[0] . "'>";

			}
		}
	}


	// download images
	// DOWNLOAD images and send email
	// setimage to 3
	// if (count($images) >= 3 && !file_exists("done.txt"))
	if (!file_exists("done.txt"))
	{
		// create text file to check if done
		$ourFileName = "done.txt";
		$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
		fclose($ourFileHandle);

		//  DOWNLOAD IMAGES
		// $n = 0;
		// foreach ($images as $image)
		// {
		// 	$url = $image;
		// 	$img = 'img/' . $n .'.jpg';
		// 	file_put_contents($img, file_get_contents($url));
		// 	$n++;
		// }


		//PHPMailer Object
		$mail = new PHPMailer;

		//From email address and name
		$mail->From = "fogertyliam@gmail.com";
		$mail->FromName = "Liam Fogerty";

		//To address and name
		$mail->addAddress("fogertyliam@gmail.com", "Liam Fogerty");

		//Address to which recipient will reply
		$mail->addReplyTo("fogertyliam@gmail.com", "Reply");

		//Send HTML or Plain Text email
		$mail->isHTML(true);

		$dir    = 'img/';
		$files = scandir($dir);

		foreach ($files as $file)
		{
			//Provide file path and name of the attachments
			$mail->addAttachment($dir . $file); //Filename is optional
		}

		$mail->Subject = "15 hidden friends";
		$mail->Body = "<i>Mail body in HTML</i>";
		$mail->AltBody = "This is the plain text version of the email content";

		if(!$mail->send()) 
		{
		    echo "Mailer Error: " . $mail->ErrorInfo;
		} 
		else 
		{
		    echo "Message has been sent successfully";
		}

	}

	echo "<p>END</p>";

?>



