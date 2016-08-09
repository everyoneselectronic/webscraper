<?php
	/*
	 * Goutte - How to click a link on a webpage
	 */

	$loader = require 'vendor/autoload.php';
	$loader->add('AppName', __DIR__.'/../src/');

	use Goutte\Client;

    $baseUrlPosts = "https://society6.com";
	$stop_url = "https://society6.com/studio/blog/back-to-school-checklist-2-4-weeks-away-7sr";

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
				echo "<p>" . $t . "</p>";
			}
			
		}
	}

	echo "<p>" . "test" . "</p>";

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


// 	https://society6.com/studio/blog/back-to-school-checklist-2-4-weeks-away-7sr
// https://society6.com/studio/blog/announcing-the-booooooom-x-s6-doodle-hunt-gotta-catch-em-all-cpw
// https://society6.com/studio/blog/thats-so-bauhaus-a-beginners-guide-to-design-inspired-art-jw6
// https://society6.com/studio/blog/your-monthly-horoscope-august-2016-ivu
// https://society6.com/studio/blog/six-pack-week-of-august-1-2016-lg5
// https://society6.com/studio/blog/5-ways-to-host-and-enjoy-a-homemade-summer-brunch-gyp
// https://society6.com/studio/blog/the-13-best-marketing-tips-ive-learned-from-working-at-society6-lva
// https://society6.com/studio/blog/irl-6-reasons-to-bring-back-the-handwritten-letter-9zb
// https://society6.com/studio/blog/s6-timelapse-artist-and-cancer-researcher-zsalto-finds-her-calm-through-the-chaos-6vg
// https://society6.com/studio/blog/big-news-faster-shipping-for-our-friends-in-australia--new-zealand-gs9
// https://society6.com/studio/blog/anti-hero-robert-deutsch-on-the-art-of-sarcasm-and-sexuality-7os
// https://society6.com/studio/blog/six-pack-week-of-july-25-2016-alq
// https://society6.com/studio/blog/local-natives-nik-ewing-on-the-intersection-of-art-and-music-kanye-and-swedish-minimalism-x6x
// https://society6.com/studio/blog/art-lovers-unite-the-best-tips--tricks-on-how-to-shop-society6-and-find-your-fave-artists-lsi
// https://society6.com/studio/blog/california-dreaming-inside-hanna-kls-pastel-fantasy-headquarters-by4
// https://society6.com/studio/blog/we-heart-tuesday-bassen-heres-what-happens-when-an-independent-artist-takes-on-a-big-retailer-saw
// https://society6.com/studio/blog/success-secrets-from-a-print-on-demand-pro-fdj
// https://society6.com/studio/blog/summer-favorites-to-keep-the-vacation-vibes-alive-dhv
// https://society6.com/studio/blog/and-the-winners-of-the-booooooom-x-society6-doodle-hunt-are-jdc
// https://society6.com/studio/blog/six-pack-week-of-july-18-2016-j44
// https://society6.com/studio/blog/introducing-the-society6-art-quarterly-no13-6ys
// https://society6.com/studio/blog/finding-immortality-with-quarterly-artist-elena-kulikova-zuv
// https://society6.com/studio/blog/coming-soon-quarterly-zine-no13-d5x
// https://society6.com/studio/blog/back-to-school-checklist-6-8-weeks-away-0qw
// https://society6.com/studio/blog/lazy-girls-guide-a-six-step-room-makeover-9ck
// https://society6.com/studio/blog/in-perfect-harmony-how-nathalie-kelley-embraces-good-vibes-3r3
// https://society6.com/studio/blog/interiors-101-decorating-essentials-for-instant-effortless-style-kw8
// https://society6.com/studio/blog/modern-rebel-marcus-price-on-touring-with-the-biggest-names-in-comedy-oau
// https://society6.com/studio/blog/six-pack-week-of-july-11-2016-37k
// https://society6.com/studio/blog/new-in-town-the-ultimate-guide-to-becoming-a-local-th9
// https://society6.com/studio/blog/room-so-bright-you-gotta-wear-shades-the-power-of-positive-decorating-wyi
// https://society6.com/studio/blog/shine-on-introducing-metal-prints-p7j
// https://society6.com/studio/blog/professional-weekender-5-tips-for-bringing-more-adventure-into-your-life-eqo
// https://society6.com/studio/blog/you-can-do-it-top-ten-ways-to-stay-inspired-ced
// https://society6.com/studio/blog/minimalist-dormgoals-stand-out-with-simplicity-jdm
// https://society6.com/studio/blog/rules-were-made-to-be-broken-go-your-own-way-with-modern-rebel-dormgoals-acr
// https://society6.com/studio/blog/so-metal-artists-heres-how-to-get-in-on-our-newest-product-addition-metal-prints-pt8
// https://society6.com/studio/blog/see-your-room-through-rose-colored-glasses-embrace-the-optimist-dormgoals-3yg
// https://society6.com/studio/blog/wanna-walk-on-the-wild-side-let-the-adventurist-be-your-dormgoals-54x
// https://society6.com/studio/blog/whats-your-style-weve-got-4-epic-dorm-looks-to-help-you-achieve-your-dormgoals-53d
// https://society6.com/studio/blog/your-monthly-horoscope-july-2016-w7f
// https://society6.com/studio/blog/introducing-our-summer-essentials-lookbook-hqo
// https://society6.com/studio/blog/soul-mates-4-tips-for-finding-the-studio-of-your-dreams-nyn
// https://society6.com/studio/blog/pop-etcs-chris-chu-takes-us-to-his-favorite-food-spots-in-new-york-ily
// https://society6.com/studio/blog/cool-kids-book-club-10-ultimate-poolside-reads-tda
// https://society6.com/studio/blog/how-to-design-the-perfect-desk-space-for-maximum-productivity-vibes-0ee
// https://society6.com/studio/blog/six-pack-week-of-june-27-2016-e65
// https://society6.com/studio/blog/i-like-it-what-is-it-a-writers-guide-to-describing-your-art-to-people
// https://society6.com/studio/blog/virtue-in-versatility-casey-saccomannos-multifaceted-approach-to-creativity
// https://society6.com/studio/blog/letter-to-my-younger-self-arden-wray
// https://society6.com/studio/blog/pillow-talk-4-new-ways-to-love-throw-pillows
// https://society6.com/studio/blog/six-pack-week-of-june-20-2016
// https://society6.com/studio/blog/open-call-for-artist-submissions-booooooom-x-society6-doodle-hunt
// https://society6.com/studio/blog/wilderness-magazines-fathers-day-adventure-guide
// https://society6.com/studio/blog/chasing-the-instagram-like-an-essay-by-artist-frenemy
// https://society6.com/studio/blog/the-s6-art-guide-montreal
// https://society6.com/studio/blog/feelings-are-punk-how-wishcandy-redefines-the-feminine
// https://society6.com/studio/blog/six-pack-week-of-june-13-2016
// https://society6.com/studio/blog/come-together-the-joy-of-the-summer-dinner-party
// https://society6.com/studio/blog/plant-life-a-guide-to-your-favorite-foliage
// https://society6.com/studio/blog/delta-spirits-jon-jameson-on-the-art-of-being-a-dad-and-an-artist
// https://society6.com/studio/blog/six-pack-week-of-june-6-2016
// https://society6.com/studio/blog/4-simple-ways-to-maximize-a-small-space
// https://society6.com/studio/blog/your-monthly-horoscope-june-2016
// https://society6.com/studio/blog/talking-magic-with-camille-chew-of-lord-of-masks
// https://society6.com/studio/blog/poolside-reading-a-history-of-west-coast-art
// https://society6.com/studio/blog/six-pack-week-of-may-30-2016
// https://society6.com/studio/blog/grabbing-a-burger-with-musician-michael-rault
// https://society6.com/studio/blog/art-in-the-wild-a-photo-essay
// https://society6.com/studio/blog/should-you-go-to-art-school-we-asked-8-experts-to-weigh-in
// https://society6.com/studio/blog/artist-on-artist-arden-wray-takes-us-inside-tallulah-fontaines-toronto-studio
// https://society6.com/studio/blog/six-pack-week-of-may-23-2016
// https://society6.com/studio/blog/something-for-literally-everyone-a-guide-to-solve-all-of-your-gift-giving-woes
// https://society6.com/studio/blog/get-packing-aloha-beach-club-on-the-top-3-things-to-bring-to-the-beach
// https://society6.com/studio/blog/obsession-artist-katty-huertas-on-the-art-of-the-self
// https://society6.com/studio/blog/staycations-forever-how-to-chill-this-memorial-day-weekend
// https://society6.com/studio/blog/six-pack-week-of-may-16-2016
// https://society6.com/studio/blog/the-s6-art-guide-new-york-city
// https://society6.com/studio/blog/photographer-hannah-kemp-wants-you-to-go-outside
// https://society6.com/studio/blog/a-survival-guide-for-working-with-clients-5-things-you-need-to-know
// https://society6.com/studio/blog/a-bushwick-studio-built-for-besties
// https://society6.com/studio/blog/this-venice-surf-shop-rejects-convention-in-favor-of-music-art-and-some-nudity
// https://society6.com/studio/blog/six-pack-week-of-april-25-2016
// https://society6.com/studio/blog/schooools-out-heres-what-to-do-with-all-that-hard-earned-grad-dough
// https://society6.com/studio/blog/how-creatives-shawn-hanna-and-carly-foulkes-start-the-day-in-their-rustic-la-digs
// https://society6.com/studio/blog/from-social-activism-to-the-selfie-a-history-of-modern-photography
// https://society6.com/studio/blog/i-threw-my-vulnerability-to-the-wind-interview-with-our-quarterly-cover-artist-witchoria
// https://society6.com/studio/blog/six-pack-week-of-april-18-2016
// https://society6.com/studio/blog/the-s6-art-guide-los-angeles
// https://society6.com/studio/blog/introducing-the-society6-art-quarterly-no12
// https://society6.com/studio/blog/just-in-time-for-summer-beach-and-bath-towels-are-here
// https://society6.com/studio/blog/six-pack-week-of-may-9-2016
// https://society6.com/studio/blog/big-news-for-artists-beach-and-bath-towels-are-dropping
// https://society6.com/studio/blog/la-photographer-fauxly-on-the-realness-of-the-hustle
// https://society6.com/studio/blog/contributing-artists-announced-in4mation-x-society6-snapback-hat-collab
// https://society6.com/studio/blog/van-from-waters-on-the-secret-weapon-that-fuels-his-creative-process
// https://society6.com/studio/blog/fieldguided-shows-us-5-dreamy-ways-to-use-wall-tapestries
// https://society6.com/studio/blog/six-pack-week-of-may-2-2016
// https://society6.com/studio/blog/landon-sheely-on-the-purpose-of-art-and-getting-psyched-when-no-one-cares
// https://society6.com/studio/blog/the-art-of-procrastination
// https://society6.com/studio/blog/keeping-the-kid-alive-inside-the-cartoon-universe-of-graffiti-artist-and-illustrator-frenemy
// https://society6.com/studio/blog/getting-meta-with-justin-mays-of-maysgrafx-for-zine-26
// https://society6.com/studio/blog/the-society6-guide-to-contemporary-art
// https://society6.com/studio/blog/where-the-wild-things-go-announcing-our-festival-lookbook
// https://society6.com/studio/blog/5-essential-decor-rules-for-your-first-adult-apartment
// https://society6.com/studio/blog/six-pack-week-of-march-28-2016
// https://society6.com/studio/blog/not-so-vanilla-get-to-know-epicly-bold-illustrator-jeezvanilla-from-zine-26
// https://society6.com/studio/blog/those-who-wander-bring-a-carry-all-pouch
// https://society6.com/studio/blog/no-26-a-to-z-typography-zine
// https://society6.com/studio/blog/nofilter-top-artists-reveal-their-tips-for-instagram-success
// https://society6.com/studio/blog/3-epic-ways-to-treat-mom-this-mothers-day
// https://society6.com/studio/blog/moments-of-unrivaled-joy-s6-artist-ruben-ireland-pens-a-letter-to-his-younger-self
// https://society6.com/studio/blog/attention-adventure-seekers-the-virtually-unbreakable-iphone-adventure-case-is-here
// https://society6.com/studio/blog/apartment-hacks-how-to-curate--hang-a-gallery-wall-like-a-design-pro
// https://society6.com/studio/blog/six-pack-week-of-april-11-2016
// https://society6.com/studio/blog/hotline-bling-janja-primozic-on-her-favorite-iphone-cases
// https://society6.com/studio/blog/robin-eisenberg-on-the-freedom-and-limitations-of-feminist-art
// https://society6.com/studio/blog/spring-vibes-the-only-t-shirts-youll-need-this-spring-5j3
// https://society6.com/studio/blog/new-artist-collaboration-in4mation-x-society6-snapback-hats
// https://society6.com/studio/blog/six-pack-week-of-april-4-2016
// https://society6.com/studio/blog/six-pack-week-of-feb-15-2016
// https://society6.com/studio/blog/six-pack-week-of-feb-8-2016
// https://society6.com/studio/blog/meet-kerby-rosanes-and-his-insanely-intricate-drawings
// https://society6.com/studio/blog/six-pack-week-of-feb-1-2016
// https://society6.com/studio/blog/six-pack-week-of-jan-25-2016
// https://society6.com/studio/blog/introducing-the-society6-ios-app
// https://society6.com/studio/blog/n0-26-zine-contributing-artists-announced
// https://society6.com/studio/blog/introducing-rectangular-pillows-to-society6
// https://society6.com/studio/blog/introducing-the-society6-art-quarterly-no11-23b
// https://society6.com/studio/blog/six-pack-week-of-jan-11-2016
// https://society6.com/studio/blog/new-iphone-se-cases-now-available-on-society6
// https://society6.com/studio/blog/six-pack-week-of-march-21-2016
// https://society6.com/studio/blog/la-garage-punk-band-bleached-on-music-festival-style
// https://society6.com/studio/blog/inside-my-studio-la-based-illustrator-and-animator-julia-pott
// https://society6.com/studio/blog/six-pack-week-of-march-14-2016
// https://society6.com/studio/blog/six-pack-week-of-march-7-2016
// https://society6.com/studio/blog/six-pack-week-of-feb-29-2016
// https://society6.com/studio/blog/how-to-make-the-most-of-the-monthly-artist-promo
// https://society6.com/studio/blog/introducing-carry-all-pouches-to-society6
// https://society6.com/studio/blog/six-pack-week-of-feb-22-2016
// https://society6.com/studio/blog/six-pack-week-of-jan-4-2016
// https://society6.com/studio/blog/six-pack-week-of-dec-28-2015
// https://society6.com/studio/blog/six-pack-week-of-dec-21-2015
// https://society6.com/studio/blog/meet-the-society6-tote-bags
// https://society6.com/studio/blog/meet-the-society6-throw-pillows
// https://society6.com/studio/blog/meet-the-society6-iphone-slim--tough-cases
// https://society6.com/studio/blog/six-pack-week-of-dec-14-2015
// https://society6.com/studio/blog/six-pack-week-of-dec-7-2015
// https://society6.com/studio/blog/six-pack-week-of-nov-30-2015
// https://society6.com/studio/blog/meet-the-society6-throw-blankets
// https://society6.com/studio/blog/meet-the-society6-travel-mugs
// https://society6.com/studio/blog/meet-the-society6-wall-tapestries
// https://society6.com/studio/blog/six-pack-week-of-nov-23-2015
// https://society6.com/studio/blog/s6-timelapse-incredible-watercolor-speed-painting-with-agnes-cecile
// https://society6.com/studio/blog/six-pack-week-of-nov-16-2015
// https://society6.com/studio/blog/six-pack-week-of-nov-9-2015
// https://society6.com/studio/blog/gift-ideas-thatll-make-you-a-holiday-rockstar
// https://society6.com/studio/blog/society6-x-uber-deliver-40ft-mobile-art-gallery-to-los-angeles-neighborhoods
// https://society6.com/studio/blog/six-pack-week-of-nov-2-2015
// https://society6.com/studio/blog/new-artist-collaboration-available-no-26-a-to-z-typography-zine
// https://society6.com/studio/blog/six-pack-week-of-oct-26-2015
// https://society6.com/studio/blog/introducing-throw-blankets-to-society6
// https://society6.com/studio/blog/society6-x-uber-bring-mobile-pop-up-gallery-to-los-angeles
// https://society6.com/studio/blog/society6-x-uber-introduce-illustrator-bioworkz
// https://society6.com/studio/blog/society6-x-uber-introduces-mixed-media-artist-liz-brizzi
// https://society6.com/studio/blog/six-pack-week-of-oct-19-2015
// https://society6.com/studio/blog/new-feature-updated-site-navigation
// https://society6.com/studio/blog/six-pack-week-of-oct-12-2015
// https://society6.com/studio/blog/introducing-travel-mugs-to-society6
// https://society6.com/studio/blog/six-pack-week-of-oct-5-2015
// https://society6.com/studio/blog/announcing-the-2016-society6-calendar-artists
// https://society6.com/studio/blog/six-pack-week-of-sep-28-2015
// https://society6.com/studio/blog/new-limited-edition-screen-print-by-brazilian-artist-zansky-for-sale
// https://society6.com/studio/blog/six-pack-week-of-sep-21-2015
// https://society6.com/studio/blog/six-pack-week-of-sep-14-2015
// https://society6.com/studio/blog/six-pack-week-of-sep-7-2015
// https://society6.com/studio/blog/new-artist-collaboration-available-2015-limited-edition-artist-calendar
// https://society6.com/studio/blog/timelapse-60-hours-of-colored-pencil-in-60-seconds-wcahill-wessel
// https://society6.com/studio/blog/six-pack-week-of-aug-31-2015
// https://society6.com/studio/blog/awesome-typography-vid-using-ira-glasss-classic-creative-advice
// https://society6.com/studio/blog/six-pack-week-of-aug-24-2015
// https://society6.com/studio/blog/they-will-skate-again-2015-life-rolls-on-event-wezekiel
// https://society6.com/studio/blog/lost-time-riso-zine-now-available
// https://society6.com/studio/blog/six-pack-week-of-aug-17-2015
// https://society6.com/studio/blog/introducing-the-newly-redesigned-collections
// https://society6.com/studio/blog/six-pack-week-of-aug-10-2015
// https://society6.com/studio/blog/six-pack-6-featured-artists-found-on-society6-29
// https://society6.com/studio/blog/hello-world-an-s6-collection-by-a-new-member-on-the-crew
// https://society6.com/studio/blog/introducing-laptop-sleeves-on-society6
// https://society6.com/studio/blog/love-and-oils-hyper-realistic-timelapse-woda--kit-king
// https://society6.com/studio/blog/why-all-over-print-tees-asset-artwork-must-fill-entire-square
// https://society6.com/studio/blog/kit-king-x-trekell-paint-set-now-available
// https://society6.com/studio/blog/introducing-iphone-6-power-case--samsung-galaxy-s6-slimtough-cases
// https://society6.com/studio/blog/introducing-all-over-print-shirts-to-society6
// https://society6.com/studio/blog/share-art-get-paid-acg
// https://society6.com/studio/blog/outside-the-lines-wesley-bird--ep-01
// https://society6.com/studio/blog/society6-artist-andreas-lie-goes-viral-with-stunning-double-exposures
// https://society6.com/studio/blog/introducing-leggings-to-society6
// https://society6.com/studio/blog/six-pack-041515
// https://society6.com/studio/blog/six-pack-040815
// https://society6.com/studio/blog/introducing-new-wall-tapestries-to-society6
// https://society6.com/studio/blog/olivier-vilaspasa--his-middle-finger-to-artist-exploitation
// https://society6.com/studio/blog/six-pack-022515
// https://society6.com/studio/blog/six-pack-021815
// https://society6.com/studio/blog/hang-time-kristen-liu-wong
// https://society6.com/studio/blog/quick-product-update-kids-clothing
// https://society6.com/studio/blog/six-pack-021115
// https://society6.com/studio/blog/davide-bonazzi--the-day-trippers
// https://society6.com/studio/blog/announcing-the-artist-for-the-riso-zine-collaboration
// https://society6.com/studio/blog/six-pack-020415
// https://society6.com/studio/blog/artist-interview-stefano-ronchi
// https://society6.com/studio/blog/six-pack-040115
// https://society6.com/studio/blog/deserts-edge-society6-festival-lookbook
// https://society6.com/studio/blog/six-pack-03252015
// https://society6.com/studio/blog/artist-interview-zansky
// https://society6.com/studio/blog/six-pack-031815
// https://society6.com/studio/blog/society6-presents--guillaume-cornet
// https://society6.com/studio/blog/six-pack-031115
// https://society6.com/studio/blog/artist-interview-alejandro-giraldo
// https://society6.com/studio/blog/six-pack-030415
// https://society6.com/studio/blog/how-artists-are-making-great-use-of-the-society6-collections-feature-wexamples
// https://society6.com/studio/blog/six-pack--121714
// https://society6.com/studio/blog/six-pack--121014
// https://society6.com/studio/blog/seller-tips-artist-promotion-materials-edition-03
// https://society6.com/studio/blog/six-pack--120314
// https://society6.com/studio/blog/six-pack--112614
// https://society6.com/studio/blog/brandits-wadrian-macho-aka-seaside-spirit
// https://society6.com/studio/blog/2015-artist-calendar
// https://society6.com/studio/blog/new-feature-collections
// https://society6.com/studio/blog/six-pack--111914
// https://society6.com/studio/blog/six-pack--012815
// https://society6.com/studio/blog/a-unique-look-inside-several-s6-artist-studios
// https://society6.com/studio/blog/entries-due--lost-time-risograph-zine-collaboration
// https://society6.com/studio/blog/six-pack--012115
// https://society6.com/studio/blog/jack-hagley-and-his-infographic-the-world-as-100-people
// https://society6.com/studio/blog/kemi-mai-and-her-beautifully-lit-digital-portraits
// https://society6.com/studio/blog/six-pack--011414
// https://society6.com/studio/blog/from-ours-to-yours-re-charlie-hebdo
// https://society6.com/studio/blog/new-collaboration-lost-time-risograph-zine
// https://society6.com/studio/blog/six-pack--010714
// https://society6.com/studio/blog/six-pack--111214
// https://society6.com/studio/blog/six-pack--110514
// https://society6.com/studio/blog/ezekiel-x-society6-limited-edition-wall-clocks-are-here
// https://society6.com/studio/blog/six-pack--102914
// https://society6.com/studio/blog/quickie-with-josh-dykgraaf
// https://society6.com/studio/blog/six-pack--102214
// https://society6.com/studio/blog/show-us-your-workspace
// https://society6.com/studio/blog/tag-your-work-holidaze
// https://society6.com/studio/blog/artist-interview-rudy-faber
// https://society6.com/studio/blog/six-pack--101514
// https://society6.com/studio/blog/introducing-iphone-6-and-6-plus-skins
// https://society6.com/studio/blog/announcing-the-2015-society6-calendar-artists
// https://society6.com/studio/blog/six-pack--100814
// https://society6.com/studio/blog/seller-tips-about-page
// https://society6.com/studio/blog/attached-graphic-designers-society6-is-hiring
// https://society6.com/studio/blog/six-pack--100114
// https://society6.com/studio/blog/seller-tips-tagging--descriptions
// https://society6.com/studio/blog/society6-presents--photographer-kevin-russ
// https://society6.com/studio/blog/micro-interview-guillaume-cornet-aka-mr-guil
// https://society6.com/studio/blog/six-pack--092414
// https://society6.com/studio/blog/introducing-limited-edition-veeka-x-one--done-cycling-gloves-and-more
// https://society6.com/studio/blog/artist-interview-kristopher-kotcher-aka-frenemy
// https://society6.com/studio/blog/new-artist-collaboration-2015-limited-edition-artist-calendar
// https://society6.com/studio/blog/fight-the-man-a-society6-collection
// https://society6.com/studio/blog/meet-the-new-society6-iphone-6-tough-case
// https://society6.com/studio/blog/introducing-new-iphone-6-and-6-plus-cases-to-society6
// https://society6.com/studio/blog/iphone-6-cases-coming-soon-to-society6
// https://society6.com/studio/blog/introducing-long-sleeve-t-shirts-on-society6
// https://society6.com/studio/blog/public-order-art-show-video--photos
// https://society6.com/studio/blog/announcing-the-society6-x-ezekiel-clothing-contributing-artists
// https://society6.com/studio/blog/public-order-art-show-recap
// https://society6.com/studio/blog/introducing-duvet-covers-on-society6
// https://society6.com/studio/blog/join-us-public-order-group-art-show
// https://society6.com/studio/blog/introducing-new-biker-tanks-on-society6
// https://society6.com/studio/blog/new-collaboration-ezekiel-clothing-x-society6-exclusive-wall-clocks
// https://society6.com/studio/blog/announcing-the-society6-public-order-group-show-artists
// https://society6.com/studio/blog/attention-site-designers-society6-is-hiring
// https://society6.com/studio/blog/seller-tips-artist-promotion-materials-edition-2
// https://society6.com/studio/blog/apply-now-society6-public-order-group-art-show
// https://society6.com/studio/blog/interview-with-philip-morgan
// https://society6.com/studio/blog/interview-with-pat-perry
// https://society6.com/studio/blog/introducing-mugs-on-society6
// https://society6.com/studio/blog/announcing-the-contributing-artists-for-the-2014-society6-artist-calendar
// https://society6.com/studio/blog/interview-with-christina-magnussen-of-gala-and-hans-christian-oren-of-oh-yeah-studio
// https://society6.com/studio/blog/interview-with-wasted-rita
// https://society6.com/studio/blog/interview-with-eben-archer-kling
// https://society6.com/studio/blog/show-off-more-of-your-artwork-with-our-new-tote-bags
// https://society6.com/studio/blog/interview-with-luke-ramsey
// https://society6.com/studio/blog/new-collaboration-2014-limited-edition-artist-calendar
// https://society6.com/studio/blog/introducing-iphone-5s-and-5c-cases
// https://society6.com/studio/blog/introducing-shower-curtains-to-society6
// https://society6.com/studio/blog/interview-with-max-o-matic
// https://society6.com/studio/blog/one--done-studio-to-collaborate-with-veeka-and-society6
// https://society6.com/studio/blog/interview-with-michael-c-hsiung
// https://society6.com/studio/blog/wall-clocks-have-come-to-society6
// https://society6.com/studio/blog/new-collaboration-veeka-x-society6-cycling-gloves-tee-mug--tote-edition
// https://society6.com/studio/blog/interview-with-jesse-draxler
// https://society6.com/studio/blog/interview-with-alexey-luka
// https://society6.com/studio/blog/introducing-baby-onesies-and-kids-tees-on-society6
// https://society6.com/studio/blog/2014-society6-artist-calendar-now-available
// https://society6.com/studio/blog/kit-king-to-collaborate-with-trekell-and-society6
// https://society6.com/studio/blog/introducing-the-samsung-galaxy-s5-case-on-society6
// https://society6.com/studio/blog/announcing-the-s6-tee-collection
// https://society6.com/studio/blog/introducing-v-necks-on-society6
// https://society6.com/studio/blog/new-collaboration-trekell-x-society6-limited-edition-signature-series-art-supplies
// https://society6.com/studio/blog/seller-tips-artist-promotion-materials-edition-1
// https://society6.com/studio/blog/interview-with-ruben-ireland
// https://society6.com/studio/blog/introducing-rugs-on-society6
// https://society6.com/studio/blog/s6-tee-submissions-must-be-posted-by-thursday-april-3rd
// https://society6.com/studio/blog/new-collaboration-s6-tees
// https://society6.com/studio/blog/announcing-the-contributing-artists-for-analog-zine
// https://society6.com/studio/blog/society6-analog-zine-submissions-must-be-posted-by-thursday-february-28th
// https://society6.com/studio/blog/analog-zine-collaboration-details
// https://society6.com/studio/blog/white-ink-printing-now-available-on-tri-blend-athletic-tees
// https://society6.com/studio/blog/introducing-throw-pillows
// https://society6.com/studio/blog/all-rights-reserved-book-available-now-from-society6
// https://society6.com/studio/blog/introducing-tote-bags-on-society6
// https://society6.com/studio/blog/iphone-5-cases-available-now
// https://society6.com/studio/blog/introducing-dark-colored-t-shirts-and-white-ink-printing
// https://society6.com/studio/blog/announcing-the-contributing-artists-for-all-rights-reserved-a-society6-art-book
// https://society6.com/studio/blog/announcing-the-contributing-artists-for-vacancy-zine
// https://society6.com/studio/blog/introducing-outdoor-throw-pillows
// https://society6.com/studio/blog/society6-vacancy-zine-submissions-must-be-posted-by-tuesday-august-6th
// https://society6.com/studio/blog/introducing-tank-tops
// https://society6.com/studio/blog/attention-senior-graphic-designers-society6-is-hiring
// https://society6.com/studio/blog/vacancy-zine-collaboration-details
// https://society6.com/studio/blog/society6-joins-demand-media
// https://society6.com/studio/blog/introducing-samsung-galaxy-s4-cases
// https://society6.com/studio/blog/introducing-ipod-cases
// https://society6.com/studio/blog/introducing-ipad--ipad-mini-cases
// https://society6.com/studio/blog/were-extending-10-more-all-rights-reserved-book-contributor-invitations
// https://society6.com/studio/blog/first-round-of-all-rights-reserved-contributor-invitations-went-out-today
// https://society6.com/studio/blog/all-rights-reserved-1st-edition-book-contributor-invitations-will-start-next-week
// https://society6.com/studio/blog/all-rights-reserved-a-society6-art-book-series-collaboration-overview
// https://society6.com/studio/blog/announcing-the-contributing-artists-for-us-and-them-a-limited-edition-zine-from-society6
// https://society6.com/studio/blog/society6-us-and-them--zine-contributions-must-be-posted-by-friday-december-9th
// https://society6.com/studio/blog/us-and-them-collaboration-details
// https://society6.com/studio/blog/society6-minutes-mine-from-jerzy-goliszewski
// https://society6.com/studio/blog/announcing-the-contributing-artists-for-whiteout-a-limited-edition-zine-from-society6
// https://society6.com/studio/blog/pricing-and-categorizing-your-work-to-sell
// https://society6.com/studio/blog/society6-minutes-welcomes-clemens-behr-with-flat-forest
// https://society6.com/studio/blog/congratulations-ambiguous-x-society6-signature-t-shirt-artist-eric-bonhomme
// https://society6.com/studio/blog/society6-superheroes-contributions-must-be-posted-today-friday-march-11th
// https://society6.com/studio/blog/tag-your-posts-on-society6
// https://society6.com/studio/blog/society6-superheroes-contributions-must-be-posted-by-friday-march-11th
// https://society6.com/studio/blog/congratulations-to-matt-taylor-and-oh-yeah-studio-adidas-x-society6-tron-legacy-tees
// https://society6.com/studio/blog/society6-members-featured-on-we-love-creativity
// https://society6.com/studio/blog/introducing-mini-and-small-fine-art-prints-on-society6
// https://society6.com/studio/blog/society6-stretched-canvas-a-day-in-the-life
// https://society6.com/studio/blog/s6-minutes-paul-octavious-indigo
// https://society6.com/studio/blog/file-preparation-for-t-shirts
// https://society6.com/studio/blog/society6-whiteout-zine-contributions-must-be-posted-by-friday-july-1
// https://society6.com/studio/blog/society6-superheroes-opening-night
// https://society6.com/studio/blog/whiteout-collaboration-details
// https://society6.com/studio/blog/superheroes-collection-has-now-been-expanded
// https://society6.com/studio/blog/superheroes-group-show-opens-tonight-at-d-structure-san-francisco-800pm
// https://society6.com/studio/blog/a-few-more-enhancements-upcoming-new-comments-and-promote-from-your-society
// https://society6.com/studio/blog/home-improvement-on-society6
// https://society6.com/studio/blog/announcing-the-society6-superheroes-group-show-artists
// https://society6.com/studio/blog/society6-superheroes-group-show-artists-revealed
// https://society6.com/studio/blog/tip-top-sellers-secrets-revealed
// https://society6.com/studio/blog/superheroes-group-show-d-structure-san-francisco-x-society6
// https://society6.com/studio/blog/society6-member-karien-deroos-feature-on-blackbookmagcom
// https://society6.com/studio/blog/society6-minutes-welcomes-oh-yeah-studio
// https://society6.com/studio/blog/society6-members-featured-in-fall-2010-issue-of-color-magazine
// https://society6.com/studio/blog/congratulations-blackbook-magazines-new-regime-feature-artist-ruben-ireland
// https://society6.com/studio/blog/announcing-society6-minutes-with-condor-from-wetheconspirators
// https://society6.com/studio/blog/signature-t-shirt-collaboration-with-ambiguous
// https://society6.com/studio/blog/check-out-them-headless-bodies-new-society6-tee-previews
// https://society6.com/studio/blog/please-welcome-blik-our-newest-society6-retail-partner
// https://society6.com/studio/blog/blackbook-magazine-supports-society6-members
// https://society6.com/studio/blog/a-slimmer-better-looking-s6
// https://society6.com/studio/blog/s6-members-maxime-francout-ross-christie-and-simon-dovar-featured-in-idn-v17n4-100th-issue
// https://society6.com/studio/blog/introducing-iphone-cases-on-society6
// https://society6.com/studio/blog/download-the-society6-wallpapers-iphone-app-free-in-the-app-store
// https://society6.com/studio/blog/society6-collaborations-the-results-are-in
// https://society6.com/studio/blog/congratulations-vans-artist-shoe-project-contributors
// https://society6.com/studio/blog/sell-more-from-your-studio-store-and-other-classic-rhymes
// https://society6.com/studio/blog/limited-edition-screenprint-from-collaboration-with-max-o-matic-now-available
// https://society6.com/studio/blog/the-locals-only-collection-is-live-on-society6
// https://society6.com/studio/blog/society6-featured-by-fast-company-magazine
// https://society6.com/studio/blog/society6-featured-in-readymade-magazine-issue-44
// https://society6.com/studio/blog/collaboration-with-ea-for-the-sims-10th-anniversary
// https://society6.com/studio/blog/craig-atkinsons-caf-royal-publishes-this-is-a-zine-gemma-correll
// https://society6.com/studio/blog/emergence-print-by-gavin-potenza-on-plywerk
// https://society6.com/studio/blog/jon-macnair-featured-in-faesthetic-issue12
// https://society6.com/studio/blog/ross-christie-joins-the-vans-artists-we-support-roster
// https://society6.com/studio/blog/the-high-quality-of-society6-art-prints
// https://society6.com/studio/blog/prints-skins-or-t-shirts-which-do-your-fans-prefer
// https://society6.com/studio/blog/following-and-endorsing-on-society6
// https://society6.com/studio/blog/locals-only-post-it-up
// https://society6.com/studio/blog/jesse-draxler-bloodtime-and-wafathanks-for-the-tees
// https://society6.com/studio/blog/idn-extra-03-society6-the-new-twenties-book-arriving-in-july
// https://society6.com/studio/blog/locals-only-collaboration-directions
// https://society6.com/studio/blog/one-way-or-another-a-contributor-art-collection-for-a-great-cause
// https://society6.com/studio/blog/introducing-stretched-canvas-prints-on-society6
// https://society6.com/studio/blog/society6-artists-get-promoted-by-cool-hunting
// https://society6.com/studio/blog/society6-partners-with-threadless
// https://society6.com/studio/blog/society6-has-drastically-reduced-our-international-shipping-rates
// https://society6.com/studio/blog/craig-atkinsons-caf-royal-publishes-hello-goodbye-by-maxime-francout
// https://society6.com/studio/blog/julian-callos-feature-interview-in-ammo-magazine-issue-2
// https://society6.com/studio/blog/kitsune-noir-poster-club
// https://society6.com/studio/blog/the-portland-prints-show
// https://society6.com/studio/blog/joshua-clay-collaboration-with-mtv-for-travis-mccoys-charity-track
// https://society6.com/studio/blog/andrew-groves-fungas-man-tee-for-the-threadless-select-series
// https://society6.com/studio/blog/chris-piascik-collaboration-with-stash-dvd-magazine-issue-63
// https://society6.com/studio/blog/flavorpill-daily-dose-pick-today-society6
// https://society6.com/studio/blog/1000-prints-on-society6
// https://society6.com/studio/blog/lloyd-eugene-winter-iv-collaboration-with-pinball-publishing
// https://society6.com/studio/blog/society6-gets-a-spread-in-holiday-matinees-i-swear-to-good-you-are-god-at-this
// https://society6.com/studio/blog/t-shirts-laptop-skins-and-more-now-available-in-the-new-society6-store
// https://society6.com/studio/blog/checkout-candy-magazine-no-13-the-society6-issue
// https://society6.com/studio/blog/society6-members-grab-the-cover-of-good-magazine-the-neighborhoods-issue
// https://society6.com/studio/blog/society6-members-artwork-now-available-on-urbanoutfitterscom-print-shop
// https://society6.com/studio/blog/society6-publisher-network-puts-your-artwork-on-hundreds-of-homepages
// https://society6.com/studio/blog/have-you-lost-weight-did-you-cut-your-hair
// https://society6.com/studio/blog/society6-collaborations-56-partners-in-9-months-whats-next
// https://society6.com/studio/blog/10-years-10-artists-1-collection-the-sims
// https://society6.com/studio/blog/guardian-of-bravery-02
// https://society6.com/studio/blog/ross-christie-featured-in-good-vs-evil-magazine-issue-4
// https://society6.com/studio/blog/collaborate-on-society6
// https://society6.com/studio/blog/want-a-print-of-your-own-artwork
// https://society6.com/studio/blog/sell-your-artwork-as-gallery-quality-prints-on-society6
// https://society6.com/studio/blog/a-special-thanks-to-michael-cina-and-youworkforthem
// https://society6.com/studio/blog/idn-v16n5-featuring-society6-member-matt-lyon-aka-c86
// https://society6.com/studio/blog/rinse-and-repeat
// https://society6.com/studio/blog/coming-very-soon-sell-your-artwork-or-buy-it-from-artists-on-demand-at-s6
// https://society6.com/studio/blog/facebook-connect-and-twitter-your-society6-posts
// https://society6.com/studio/blog/we-need-your-vote-please-society6-nominated-for-psfk-good-idea-awards
// https://society6.com/studio/blog/please-help-society6-get-to-sxsw-2010-we-need-your-help
// https://society6.com/studio/blog/society6-artist-studio-tours
// https://society6.com/studio/blog/weve-added-facebook-connect-to-help-you-promote-your-society6-posts
// https://society6.com/studio/blog/our-first-curator-opportunity-with-our-friends-from-bespoken
// https://society6.com/studio/blog/just-launched-the-society6-publisher-network-let-us-know-if-you-wanna-join
// https://society6.com/studio/blog/thank-you-blaine-fontana-and-juxtapoz-magazine
// https://society6.com/studio/blog/society6-hits-the-design-charts-10-for-this-week
// https://society6.com/studio/blog/thank-you-michael-cina-and-youworkforthem
// https://society6.com/studio/blog/hunted-by-cool-hunting
// https://society6.com/studio/blog/tweaks-and-touches-whats-new-in-the-design-of-society6
// https://society6.com/studio/blog/collaborate-with-upso-and-threadless-select-series
// https://society6.com/studio/blog/popular-curators-artists-hit-the-charts-on-society6
// https://society6.com/studio/blog/in-memory-of-michael-jackson
// https://society6.com/studio/blog/special-thanks-to-our-friends-at-flavorpill
// https://society6.com/studio/blog/this-is-not-a-contest
// https://society6.com/studio/blog/discover-quality-posts-using-our-latest-feature
// https://society6.com/studio/blog/congratulations-to-dibec-society6s-first-ever-opportunity-grant-recipient
// https://society6.com/studio/blog/were-pulling-for-ya-blaine
// https://society6.com/studio/blog/thanks-for-the-brain-picking-maria
// https://society6.com/studio/blog/new-grant-highlight-rec-center-studios
// https://society6.com/studio/blog/apply-now-applications-are-closing-for-the-youworkforthem-illustrators-grant
// https://society6.com/studio/blog/apply-now-applications-are-closing-for-the-society6-introductory-grant
// https://society6.com/studio/blog/micro-patronage-anyone-can-give-a-grant-on-society6
// https://society6.com/studio/blog/new-grant-highlight-rolf-contemporary-gallery
// https://society6.com/studio/blog/new-posts-studios
// https://society6.com/studio/blog/thanks-to-our-friends-at-mashable
// https://society6.com/studio/blog/psfk-supports-society6
// https://society6.com/studio/blog/suggested-artists-to-follow-on-society6
// https://society6.com/studio/blog/getting-inspired
// https://society6.com/studio/blog/get-nominations-to-become-a-finalist
// https://society6.com/studio/blog/artist-grants-are-live-on-society6
// https://society6.com/studio/blog/twitter-integration-zuna
// https://society6.com/studio/blog/collaborating-in-s6-mike-garrett
// https://society6.com/studio/blog/easy-to-apply
// https://society6.com/studio/blog/our-first-grant-in-the-new-system
// https://society6.com/studio/blog/twitter-integration
// https://society6.com/studio/blog/opportunity-grants
// https://society6.com/studio/blog/recently-active-posts
// https://society6.com/studio/blog/rss-feeds
// https://society6.com/studio/blog/collaborating-in-s6
// https://society6.com/studio/blog/a-post-about-studios
// https://society6.com/studio/blog/collaborations-on-society6
// https://society6.com/studio/blog/grants-authored-by-individuals
// https://society6.com/studio/blog/people-amp-posts
// https://society6.com/studio/blog/society6-is-now-open-32309
// https://society6.com/studio/blog/now-seeking-arts-forward-non-profit-partners
// https://society6.com/studio/blog/society6-members-can-now-invite-your-friends
// https://society6.com/studio/blog/artist-grants-are-coming
// https://society6.com/studio/blog/the-artist-district-in-downtown-la-doors
// https://society6.com/studio/blog/wed-like-to-welcome-our-friends-to-society6-we-need-your-feedback
?>



