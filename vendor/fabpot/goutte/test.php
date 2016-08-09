<?php
/*
 * Goutte - How to click a link on a webpage
 */

//in order to use goutte all you need to do is require the .phar file
require_once 'goutte.phar';
//and use the namespace
use Goutte\Client;

//create a new client instance
$client = new Client();
//request the contents of a webpage
$crawler = $client->request('GET', 'http://www.symfony-project.org/');
//the method returns a Crawler object (Symfony\Component\DomCrawler\Crawler).

//select a link
$link = $crawler->selectLink('Plugins')->link();
//click to follow link
$crawler = $client->click($link);

echo $crawler->html();
?>
