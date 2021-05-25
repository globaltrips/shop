<?php
// do href text replacement so you don forget about it please
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$response = array();
$response['success'] = false;
$response['message'] = 'Could not update configuration object';

include_once '/var/www/globaltrips_cdn_pages/definitions.php';


if(!isset($_GET['build'])) {
  $response['success'] = false;
  $response['message'] = 'Build is required';
  die(json_encode($response));
}



$response['env'] = $_GET['build'];

if($response['env'] == 'dev') {
  $baseUrl = _DEV_SITE_URL;
  $siteName = _DEV_SITE_NAME;
} else if($response['env'] == 'prod') {
  $baseUrl = _SITE_URL;
  $siteName = _SITE_NAME;
} else {
  $response['success'] = false;
  $response['message'] = 'Build env is not valid';
  die(json_encode($response));
}


$actionUrlClass = 'j-action-trigger';
$actionDefaultUrlClass = 'j-action-default-trigger';
$actionUrl = $baseUrl.'signup/?';
$actionPhoneClass = 'j-action-phone-trigger';
$actionPhone = '(999) 999-9999';
$logoUrl = '/img/club/logo.png';

// BS5
// $searchIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
//   <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
// </svg>';

$searchIcon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px"
                   height="24px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                <g style="opacity:1;">
                  <path d="M18.853,17.438l-3.604-3.604c-0.075-0.075-0.166-0.127-0.267-0.156C15.621,12.781,16,11.686,16,10.5
                    C16,7.463,13.537,5,10.5,5S5,7.463,5,10.5S7.463,16,10.5,16c1.186,0,2.281-0.379,3.18-1.018c0.028,0.101,0.08,0.191,0.155,0.267
                    l3.604,3.604c0.301,0.301,0.858,0.227,1.249-0.165C19.079,18.297,19.153,17.739,18.853,17.438z M10.5,14C8.568,14,7,12.432,7,10.5
                    S8.568,7,10.5,7S14,8.568,14,10.5S12.432,14,10.5,14z"/>
                </g>
                <g >
                </g>
                </svg>';

$config = [];



// location counts
$config['counts'] = [
  'hotels' => [
    'cancun' => 804,
    'gatlinburg' => 459,
    'los-angeles' => 719,
    'myrtle-beach' => 331,
    'new-orleans' => 108,
    'new-york' => 586,
    'orlando' => 697,
    'phoenix' => 192,
    'san-francisco' => 218,
    'williamsburg' => 141,
  ],
  'condos' => [
    'cancun' => 1407,
    'gatlinburg' => 601,
    'los-angeles' => 1102,
    'myrtle-beach' => 551,
    'new-orleans' => 999,
    'new-york' => 852,
    'orlando' => 999,
    'phoenix' => 999,
    'san-francisco' => 999,
    'williamsburg' => 999,
  ],
];

// deals
$config['global']['deals'] = [];
$config['global']['deals']['faq'] = [];
$config['global']['deals']['faq']['action_title'] = 'Read More';
$config['global']['deals']['faq']['action_url'] = $baseUrl.'app/faqs/';
$config['global']['deals']['faq']['qs'] = [
  [
    'q' => 'Who is Global Trips?',
    'a' => 'We are a US based members only travel company. We specialize in wholesale prices of hotels and weekly condo stays. Our members routinely save 50% or more on hotels and $1000’s off of weekly condo stays. Since the onset of Covid-19, our prices are even lower than normal as hotels and resorts give us better deals to try and fill up empty rooms.',
  ],
  [
    'q' => 'What is a weekly stay?',
    'a' => 'Our best deals are called "hot weeks". A hot week is an 8 day, 7 night stay at a resort property for as low as $298 for the entire stay. You can choose from 1, 2 or even 3 bedroom units, and literally save thousands of dollars on your next vacation.',
  ],
  [
    'q' => 'Why is there a charge?',
    'a' => "In order to bring you true wholesale pricing, we charge a membership fee, similar to a Sam's club or Costco. Sites like Expedia and Priceline are free to use, but charge you retail when you book, so you end up paying more in the long run.",
  ],
  [
    'q' => 'Can I see your prices?',
    'a' => "Of course! Create a free trial membership to check out our members only rates. We're sure you'll love them.",
  ],
//   [
//     'q' => 'Do I have to take a timeshare tour?',
//     'a' => 'Nope. As a premium member you have access to all of the amazing deals with no catches. You are not going to be required to take a tour or sit through any presentations. You simply pay and stay!',
//   ],
//   [
//     'q' => 'Why should I sign up now?',
//     'a' => 'Right now we are offering a special of $20 a month. Our premium membership is normally $49 a month but we are running this promotion to help the travel industry to recover from COVID.',
//   ],
//   [
//     'q' => 'What kind of contract am I signing up for?',
//     'a' => 'No Contract. The membership is month to month and you have the flexibility to cancel anytime.',
//   ],
//   [
//     'q' => 'Travel Notice COVID-19',
//     'a' => "Many destinations have COVID-19 travel restrictions in place. These restrictions can change quickly and without prior notice. To find out more about restrictions in place for your destination, check the specific COVID-19 regulations for your departure location and destination. Continue to check for updates frequently as you get nearer to your departure date.
// We recommend following the guidance from governments and public health officials to help slow the spread of COVID-19. The decision to travel is a personal one. Ultimately, it's up to you to determine what's best for you and your family.
// We encourage you to check COVID-19 travel and health advisories information from CDC.gov.",
//   ],
//   [
//     'q' => 'How do I cancel?',
//     'a' => 'You can call our member service team Monday - Friday 9:00 AM - 5:00 PM Eastern time or submit your request via the "Contact Us" page on the website.',
//   ],
];

$config['global']['deals']['how_it_works'] = [
  'title' => 'Weekly Stays',
  'content' => 'Members have access to the best deals. Check out the video to learn more!',
  'video_url' => 'https://player.vimeo.com/external/547671806.hd.mp4?s=0746a5de6e35aec7dfacad8b8006b49d769b3a95&profile_id=174',
  'thumbnail_url' => '/img/club/gt-video-thumbnail.png',
];

$config['global']['deals']['check_list'] = [];
$config['global']['deals']['check_list']['img_alt'] = 'Map';
$config['global']['deals']['check_list']['title'] = 'HOW MUCH WILL YOU SAVE?';

$config['global']['deals']['check_list']['items'] = [];
$config['global']['deals']['check_list']['items'][0] = '500,000 Hotels';
$config['global']['deals']['check_list']['items'][1] = 'Last Minute Deals';
$config['global']['deals']['check_list']['items'][2] = 'No Credit Card required';
$config['global']['deals']['check_list']['description'] = 'Find out how much you could save on your next vacation, start searching for free today';
$config['global']['deals']['check_list']['btn_text'] = 'SIGN UP NOW';
$config['global']['deals']['check_list']['action_url'] = $actionUrl;


$config['deals']['orlando'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'Orlando',
    'state' => 'Florida',
    'location' => 'Orlando, FL',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/orlando/orlando-map-phone.png',
  ],
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'classes' => '',
    'img' => '/img/hero/orlando/orlando-hero-2.jpg',
    'og_img' => '/img/hero/orlando/orlando-hero-2-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['orlando'].' Participating Hotels',
    'content' => "Orlando is a magical place. There’s an incredible mix of fun things to do here that makes it an ideal vacationing spot for not only families but young singles, baby boomers, foodies, outdoor adventurous types, luxury shoppers and international visitors.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>',
  ],
  'banners' => [
    [
      'title' => 'Search Orlando',
      'description' => '',
      'button' => 'SEARCH NOW', 
      'img' => '/img/offers/orlando/orlando-360-150.png',
    ],
    [
      'title' => $config['counts']['hotels']['orlando'].' Orlando Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/orlando/sheraton_vistana.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Sheraton Vistana Resort</a>', // should be resort villas?
        'content' => "Soothing fountains and world-class amenities are just minutes away from the best of Orlando's attractions, making this the perfect place for you to create unforgettable vacations.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C002ML04',
        ],
      ],
      [ 
        'img' => '/img/offers/orlando/marriotts_grande_vista.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Marriott's Grande Vista</a>",
        'content' => "Regardless of whether you're looking for nonstop theme park thrills or fabulous dining, shopping and enough golf and recreational opportunities to keep you energized throughout your stay, Marriott's Grande Vista offers unforgettable experiences that will make your vacation a magical getaway.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C026MI02',
        ],
      ],
      [ 
        'img' => '/img/offers/orlando/hyatt_regency.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Hyatt Regency</a>',
        'content' => 'Located on International Drive, this resort is adjacent to the convention center, 2 miles from SeaWorld, within 4 miles of Universal Studios and Islands of Adventure, and 7 miles from Downtown Disney® area. A huge sundeck includes a poolside bar and a swimming grotto with a zero-entry pool and waterslide.',
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C01J8102',
        ],
      ],
      [ 
        'img' => '/img/offers/orlando/sunshine_resort.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Sunshine Resort</a>',
        'content' => "The airy 2-bedroom apartments feature full kitchens and dining areas, plus whirlpool tubs in master bedrooms. Cable TV and DVD players are also included, and Wi-Fi access is available for a fee. Parking is free. The outdoor pool area includes a kids' pool and snack bar. Other amenities include tennis and basketball courts, shuffleboard, a sauna and hot tub. There's also a barbecue area and a fire pit.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0BATT02',
        ],
      ],
      [ 
        'img' => '/img/offers/orlando/hilton_grand_vacations_seaworld.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Hilton Grand Vacations at Seaworld</a>',
        'content' => 'From an enhanced sense of arrival, our recently renovated guest rooms and meeting facilities, along with a new restaurant, a superior location and complimentary transportation to the major theme parks, we invite you to experience your next meeting, social gathering or fun-filled family Orlando vacation with us!',
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0079C02',
        ],
      ],
      [ 
        'img' => '/img/offers/orlando/springhill_suites.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">SpringHill Suites</a>',
        'content' => "We're located near Orange County Convention Center hotel and Orlando International Airport, making out-of-town business travel easier than ever! Our suites are thoughtfully designed to offer room to relax with amenities such as cloud-like beds with plush pillows, comfy lounge areas, HDTVs with premium channels, work desks & free Wi-Fi. Whether you're searching for a weekend getaway or extended stay hotel, you'll feel all the comforts of home at our suites, with nice amenities like our free park shuttles!",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C01C1Q02',
        ],
      ],
      [ 
        'img' => '/img/offers/orlando/doubletree_hilton_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">DoubleTree by Hilton</a>',
        'content' => "If you're taking a family vacation or traveling on business DoubleTree is a great choice among hotels near Orlando's airport. Only 10 minutes north of Orlando International Airport, the hotel is situated away from the bustle of Central Florida theme parks, but close enough to reach favorite attractions in just 20 minutes.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02BB902',
        ],
      ],
    ],
  ],
];

$config['deals']['myrtle-beach'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'Myrtle Beach',
    'state' => 'South Carolina',
    'location' => 'Myrtle Beach, SC',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/myrtle-beach/myrtle-beach-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'classes' => '',
    'img' => '/img/hero/myrtle-beach/myrtle-beach-hero-2.jpg',
    'og_img' => '/img/hero/myrtle-beach/myrtle-beach-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['myrtle-beach'].' Participating Hotels',
    'content' => "Beautiful beaches, award-winning restaurants, and first-rate entertainment can all be found in Myrtle Beach, the heart of the Grand Strand! Myrtle Beach is a visitor’s dream, offering everything from relaxing beaches, shopping, exhilarating thrill rides, exciting attractions, quality dining options, and sizzling nightlife. All of this adds up to the perfect vacation.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search Myrtle Beach',
      'description' => '',
      'button' => 'SEARCH NOW',
      'img' => '/img/offers/myrtle-beach/myrtle-beach-360-150.png',
    ],
    [
      'title' => $config['counts']['hotels']['myrtle-beach'].' Myrtle Beach Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/myrtle-beach/bluegreen_vacations.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Bluegreen Seaglass Tower</a>', // should be resort villas?
        'content' => "Occupying a sleek, glass-fronted high-rise, this relaxed, beachfront hotel is a 2-minute walk from the Myrtle Beach Boardwalk and Promenade, and 1.8 miles from Broadway at the Beach shopping center.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00ZHK02',
        ],
      ],
      [ 
        'img' => '/img/offers/myrtle-beach/dayton_house.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Dayton House</a>",
        'content' => "The Dayton House offers comfortable accommodations just steps away from the warm sand and beautiful Atlantic Ocean.
Accommodations range from efficiency rooms that sleep up to four guests, to oceanfront one bedroom suites that sleep up to six guests.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0HP9001',
        ],
      ],
      [ 
        'img' => '/img/offers/myrtle-beach/sun_n_sand.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Sun N Sand</a>',
        'content' => "Located on the South Carolina's storied Grand Strand, the Sun & Sand Resort delights visitors with its easy mix of Southern charm and contemporary services and amenities. Our attractive address on South Ocean Boulevard offers our guests easy access to the best shopping, dining, live entertainment and family-friendly attractions on the South Carolina coast.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0245L02',
        ],
      ],
      [ 
        'img' => '/img/offers/myrtle-beach/forest_dunes.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Forest Dunes</a>',
        'content' => 'Forrest Dunes Resort is located on the Golden Mile in Myrtle Beach. This quiet and residential area of Myrtle Beach provides guests with an enjoyable beach vacation.',
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0GIOP03',
        ],
      ],
      [ 
        'img' => '/img/offers/myrtle-beach/sea_crest_resort.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Sea Crest</a>',
        'content' => "It's a perennial family favorite for area vacationers. Its unbeatable location just blocks from the Family Kingdom Amusement Park and other attractions along with its children’s water park, coffee and internet cafe’ and Malibu Beach Bar make Sea Crest a “must-stay” resort!",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02QIF03',
        ],
      ],
      [ 
        'img' => '/img/offers/myrtle-beach/beach_colony.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Beach Colony</a>',
        'content' => 'Welcome to Beach Colony Resort! A popular family resort located oceanfront along the coveted Golden Mile in Myrtle Beach. Our family friendly resort offers spacious condo-style amenities and beach efficiencies, on-site dining, and generous resort-style amenities.',
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C004AP06',
        ],
      ],
      [ 
        'img' => '/img/offers/myrtle-beach/caribbean_resort.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Caribbean Resort</a>',
        'content' => "Enjoy the sun, sand, and the pleasures of golfing at Myrtle Beach’s very own, The Caribbean Resort & Villas!",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0BAHW02',
        ],
      ],
    ],
  ],
];

$config['deals']['gatlinburg'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'Gatlinburg',
    'state' => 'Tennesee',
    'location' => 'Gatlinburg, TN',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/gatlinburg/gatlinburg-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'classes' => '',
    'img' => '/img/hero/gatlinburg/gatlinburg-hero-1.jpg',
    'og_img' => '/img/hero/gatlinburg/gatlinburg-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['gatlinburg'].' Participating Hotels',
    'content' => "Located in Sevier County, Gatlinburg, TN is one of the southeast's most popular vacation destinations. Nestled in the heart of the Great Smoky Mountains, Gatlinburg is a charming town surrounded by high ridges, including Mount Le Conte, Sugarland Mountain, Cove Mountain, and Big Ridge.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search Gatlinburg',
      'description' => '',
      'button' => 'SEARCH NOW', 
      'img' => '/img/offers/gatlinburg/gatlinburg-360-150.png',
    ],
    [
      'title' => $config['counts']['hotels']['gatlinburg'].' Gatlinburg Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/gatlinburg/bearskin_lodge.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Bearskin Lodge</a>', // should be resort villas?
        'content' => "A landmark on the historic Gunflint Trail since 1925. Beautiful wilderness resort lodging on the edge of the BWCA in northern Minnesota.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02MH003',
        ],
      ],
      [ 
        'img' => '/img/offers/gatlinburg/glenstone_lodge.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Glenstone Lodge</a>",
        'content' => "Glenstone Lodge and Conference Center offers outstanding value in a beautiful mountain setting along a clear sparkling stream in the heart of Gatlinburg, walking distance to shops, attractions, and restaurants. Indoor and outdoor pools, on-site dining and 12,000 square feet of meeting space make this an ideal destination for families and groups alike.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02H1I02',
        ],
      ],
      [ 
        'img' => '/img/offers/gatlinburg/park_vista.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Park Vista</a>',
        'content' => "The premier full-service Hotel in Gatlinburg, TN. 300 rooms, 30 suites, mini waterpark/indoor pool, 25,000 sq ft convention space, Vista Grill restaurant, Firefly's lounge. State of the art Exercise Facility. And the World Famous Doubletree Cookie!",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C006L504',
        ],
      ],
      [ 
        'img' => '/img/offers/gatlinburg/westgate-smoky-mountain.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Westgate Smoky Mountain</a>',
        'content' => 'A full-service resort in Gatlinburg, provides easy access to Great Smoky Mountains National Park, as well as downtown Gatlinburg and Pigeon Forge, home to the Dollywood theme park. Onsite amenities include the state-of-the-art Wild Bear Falls water park, two outdoor pools, two hot tubs, miniature golf course, fitness center and world-class Serenity Spa. Dining options include the Roaring Fork. Guests can choose from a variety of accommodation choices such as studio villas, one-bedroom deluxe villas and two-bedroom villas, each of which contains a kitchenette or fully equipped kitchen.',
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00DOG03',
        ],
      ],
      [ 
        'img' => '/img/offers/gatlinburg/brookside_resort.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Brookside Resort</a>',
        'content' => "We have lots of activities for every member of the family to enjoy including a heated swimming pool, sauna, ice cream snack bar, video arcade, supervised kids' activities, miniature golf course, tennis courts, 9 hole golf course, and much more!!",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02I6502',
        ],
      ],
      [ 
        'img' => '/img/offers/gatlinburg/baymont.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Baymont</a>",
        'content' => "We are located near many attractions in Gatlinburg, TN including Ripley's Aquarium. Every room has a private balcony overlooking the Pigeon River with Great Smoky Mountain views.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C01PTP02',
        ],
      ],
      [ 
        'img' => '/img/offers/gatlinburg/edgewater_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Edgewater Hotel</a>',
        'content' => "Perched atop the banks of the little Pigeon River, The Edgewater Hotel has a towering altitude and an uncompromising attitude toward excellence in guest relations, comfort, safety and value.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0BDSD02',
        ],
      ],
    ],
  ],
];

$config['deals']['williamsburg'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'Williamsburg',
    'state' => 'Virginia',
    'location' => 'Williamsburg, VA',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/williamsburg/williamsburg-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'classes' => '',
    'img' => '/img/hero/williamsburg/williamsburg-hero-1.jpg',
    'og_img' => '/img/hero/williamsburg/williamsburg-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['williamsburg'].' Participating Hotels',
    'content' => "Come experience history in the making. It’s revolutionary fun with something for everyone. Enjoy everything from luxurious spas, world-class golf, and award-winning restaurants to living-history museums, surprising thrills, biking, and hiking. Whatever your idea of fun is, you’ll find it all in Greater Williamsburg. Experience Virginia tourism at its best and plan your trip to Williamsburg today!",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search Williamsburg',
      'description' => '',
      'button' => 'SEARCH NOW', 
      'img' => '/img/offers/williamsburg/williamsburg-360-150.png',      
    ],
    [
      'title' => $config['counts']['hotels']['williamsburg'].' Williamsburg Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/williamsburg/best_western_historic_area.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Best Western</a>', // should be resort villas?
        'content' => "Located in the heart of Williamsburg, the Best Western Historic Area offers affordable luxury in an ideal location.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C01SDL03',
        ],
      ],
      [ 
        'img' => '/img/offers/williamsburg/bluegreen_vacations.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Bluegreen Patrick Henry Square</a>",
        'content' => "Bluegreen Patrick Henry Square™ welcomes you to relax, revive and re-energize yourself in an atmosphere that combines engaging American history with exploration and fun. Ideally located only half a block from historic Williamsburg, the resort provides the perfect place to begin your journey back in time. Plan your day from the comfort of your cozy studio, roomy 1-bedroom premium suite, or spacious 2- or 3-bedroom accommodations or spacious 2-bedroom suite complete with full kitchen, separate living and dining areas and all the comforts of home. The colonial-inspired décor will motivate you to explore everything historic Williamsburg has to offer.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00RNM04',
        ],
      ],
      [ 
        'img' => '/img/offers/williamsburg/comfort_suites.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Comfort Suites</a>',
        'content' => "This straightforward all-suite hotel is 2 miles from Downtown and 7 miles from the Jamestown Settlement living history museum. Unfussy suites come with free Wi-Fi and flat-screen TVs, as well as minifridges, microwaves and coffeemakers; some add pull-out sofas, desks with ergonomic seats and whirlpool tubs.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C01TTH03',
        ],
      ],
      [ 
        'img' => '/img/offers/williamsburg/springhill_suites.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Springhill Suites</a>',
        'content' => "The SpringHill Suites by Marriott in historic Williamsburg, Virginia with new breakfast, provides a sensible choice for travelers to Virginia's historic triangle of Colonial Williamsburg, Jamestown and Yorktown. Located in the heart of Colonial Williamsburg's historic district, this hotel offers nearby attractions including Busch Gardens, Water Country USA, Colonial Williamsburg, the College of William and Mary, Merchants Square Shopping District, Prime Outlets, the Williamsburg Winery, and The Pottery.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0078F04',
        ],
      ],
      [ 
        'img' => '/img/offers/williamsburg/colonial_gardens.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Colonial Gardens</a>",
        'content' => "Colonial Gardens offers a luxury accommodation that will delight your entire party within Williamsburg’s city limits. Once you arrive at our historic home you will immediately feel both comfortable and special with its causal elegance. The furniture is inviting, the linens and fabrics are upscale yet cozy.  You will enjoy our whole house accommodations which are self catered. Private chef services are available at an additional cost if desired. The gardens at Colonial Gardens will beckon you to stop and watch the birds, butterflies and other wildlife in its park-like setting seasons permitting.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02MLR03',
        ],
      ],
      [ 
        'img' => '/img/offers/williamsburg/clarion_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Clarion Hotel</a>',
        'content' => "At the Clarion Hotel, business and leisure travelers can find the perfect place to reconnect with family, friends and colleagues. Our conference center hotel features all the space needed to host your next event. Whether it’s a business meeting or family reunion, you will find our unique space and friendly staff makes booking here an easy decision. From banquet rooms, to meeting space as well as a restaurant and bar area, our hotel provides all the options needed to properly connect with your people.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C004HE06',
        ],
      ],
      [ 
        'img' => '/img/offers/williamsburg/wyndham_patriots.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Wyndham Patriots Place</a>',
        'content' => "Wyndham Patriots’ Place, situated about a mile away from Williamsburg’s historical area, was built on the lush grounds of a former golf course. The property’s spaciousness, mature landscaping and lower-key architectural style lends a warm, comfortable “home away from home” feel to your stay.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0HK7E01',
        ],
      ],
    ],
  ],
];

$config['deals']['los-angeles'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'Los Angeles',
    'state' => 'California',
    'location' => 'Los Angeles, CA',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/los-angeles/los-angeles-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'classes' => '',
    'img' => '/img/hero/los-angeles/los-angeles-hero-1.jpg',
    'og_img' => '/img/hero/los-angeles/los-angeles-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['los-angeles'].' Participating Hotels',
    'content' => 'The city of Los Angeles [69] (also known simply as L.A., and nicknamed the "City of Angels") is the most populous city in California. Located on a broad basin in Southern California, the city is surrounded by vast mountain ranges, valleys, forests, beautiful beaches along the Pacific Ocean, and nearby desert.',
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search Los Angeles',
      'description' => '',
      'button' => 'SEARCH NOW', 
      'img' => '/img/offers/los-angeles/los-angeles-360-150.png',      
    ],
    [
      'title' => $config['counts']['hotels']['los-angeles'].' Los Angeles Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/los-angeles/doubletree.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">DoubleTree by Hilton</a>', // should be resort villas?
        'content' => "Los Angeles Downtown Hotel with easy access to major attractions, stunning views from the rooftop Kyoto Gardens and state-of-the-art Executive War Room and meeting space for all your needs!",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00EI602',
        ],
      ],
      [ 
        'img' => '/img/offers/los-angeles/level_furnished_living.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Level Furnished Living</a>",
        'content' => "Whether you are travelling for business, relocating or in transition, on a graduate program, or simply taking an extended holiday, the advantages that our furnished apartments offer are second to none. LEVEL couples the convenience of an apartment accommodation with the best of a hotel-style experience.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0RXGL03',
        ],
      ],
      [ 
        'img' => '/img/offers/los-angeles/sheraton_grand_los_angeles.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Sheraton Grand LA</a>',
        'content' => "In the heart of downtown financial district, the Sheraton Los Angeles Downtown Hotel is an inviting retreat for any lifestyle. Centrally located with entrances into the Macy’s Mall and just one block south of the city’s financial district, the Sheraton also makes for the most convenient choice downtown for meetings. Additionally, the hotel is only four blocks from the STAPLES Center and the Los Angeles Convention Center.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00EDH02',
        ],
      ],
      [ 
        'img' => '/img/offers/los-angeles/the_westin_bonaventure.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Westin Bonaventure</a>',
        'content' => "The Westin Bonaventure provides the ultimate urban oasis in the heart of the downtown Los Angeles' business district. Elegantly presiding over the City of Angels, an international symbol that has come to represent the beauty and sophistication of the city itself, this famous Westin Los Angeles hotel is one of the most photographed destinations in the world.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0I0SC01',
        ],
      ],
      [ 
        'img' => '/img/offers/los-angeles/millennium_biltmore.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Millennium Biltmore</a>",
        'content' => "Hollywood glamour personified. An elegant stay awaits in the heart of LA's vibrant cultural district.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0024R04',
        ],
      ],
      [ 
        'img' => '/img/offers/los-angeles/the_ritz_carlton.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Ritz Carlton</a>',
        'content' => "Days spent lounging by the rooftop pool. Nights remembered with cocktails and skyline views. Moments spent rubbing shoulders with celebrity entourages. At The Ritz-Carlton, Los Angeles, every experience articulates the charisma of this iconic destination.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C01B3Z02',
        ],
      ],
      [ 
        'img' => '/img/offers/los-angeles/miyako_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Miyako Hotel</a>',
        'content' => "Enjoy the flavor of Japanese hospitality in the heart of downtown Los Angeles. The Miyako Hotel is just moments from all tourists attractions and exciting things to do in Los Angeles both for business and pleasure.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00H3X03',
        ],
      ],
    ],
  ],
];

$config['deals']['cancun'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'Cancun',
    'state' => 'Quintana Roo',
    'location' => 'Cancun, MX',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/cancun/cancun-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'img' => '/img/hero/cancun/cancun-hero-1.jpg',
    'og_img' => '/img/hero/cancun/cancun-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['cancun'].' Participating Hotels',
    'content' => "Cancun is recognized throughout the world for its spectacular white sand beaches and its fascinating sea in turquoise blue tones. With unique natural places, Mayan culture, water activities and adventure. International cuisine, spectacular golf courses, sophisticated spa facilities; exclusive shopping centers, typical handicraft markets as well as shows, bars and nightclubs that give fame to its incomparable nightlife.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search Cancun',
      'description' => '',
      'button' => 'SEARCH NOW', 
      'img' => '/img/offers/cancun/cancun-360-150.png',      
    ],
    [
      'title' => $config['counts']['hotels']['cancun'].' Canc&uacute;n Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/cancun/dream_sands.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Dreams Sands</a>', // should be resort villas?
        'content' => "Perfectly situated along a breathtaking white sand beach in the heart of Cancun’s Hotel Zone, sits Dreams Sands Cancun Resort & Spa. Dreams Sands Cancun is walking distance from great shopping, restaurants and bars, and is only a short 15 minutes away from downtown Cancun. Enjoy the 650-foot stretch of pristine, white sand beach along the Mexican Caribbean.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C007V205',
        ],
      ],
      [ 
        'img' => '/img/offers/cancun/hyatt_ziva.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Hyatt Ziva</a>",
        'content' => "The only resort in the region surrounded on three sides by the Caribbean Sea. All-inclusive adventure for all ages.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00G6805',
        ],
      ],
      [ 
        'img' => '/img/offers/cancun/park_royal_cancun.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Park Royal</a>',
        'content' => "At the Park Royal Hotel Resorts on the Mexican Caribbean, you will be surrounded by beauty and pampered by our service. Our hotels have everything to make your vacation fun, memorable, and exciting. Plan a romantic getaway, family vacation, corporate retreat, reunion, or wedding and honeymoon. Live the experience of a lifetime in Mexico at one our exclusive resorts all inclusive.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C008IG05',
        ],
      ],
      [ 
        'img' => '/img/offers/cancun/sunset_royal_beach_resort.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Sunset Royal</a>',
        'content' => "Resting on one of the most beautiful white sand beaches in the Mexican Caribbean with breathtaking views of the turquoise blue Caribbean Sea, Sunset Royal Resort is an ideal place for a Cancun vacation. Located in a peaceful area of Cancun’s hotel zone, it’s close enough for easy access to popular travel entertainment, such as Coco Bongo and Dady’O nightclubs and Señor Frog’s and Carlos ‘n Charlie’s restaurants, but it’s also far enough away to escape the action if you choose to do so.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00CN504',
        ],
      ],
      [ 
        'img' => '/img/offers/cancun/panama_jack_resorts.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Panama Jack Resorts</a>",
        'content' => "Choose the world of Panama Jack Resorts and choose what’s most important to you in our all-inclusive paradise. Let the rhythm of the tropics soothe your soul while the ocean waves wash your cares away. We’ll handle the rest with a smile.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00RUN04',
        ],
      ],
      [ 
        'img' => '/img/offers/cancun/casa_turquesa.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Casa Turquesa</a>',
        'content' => "Exclusivity, Privacy & Art. Casa Turquesa is a Boutique Hotel featuring 24 Junior Suites and 5 Luxury Master Suites. Situated in the heart of the hotel zone in Cancun, offering privacy, exclusivity and art. Personalized service, al la carte dining, luxury accommodation.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0AFDW02',
        ],
      ],
      [ 
        'img' => '/img/offers/cancun/the_royal_islander.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Royal Islander</a>',
        'content' => "Nestled on the beach, The Royal Islander offers enchanting views of the Caribbean and the Nichupte Lagoon. Seek a moment of solitude at sunrise and enjoy blissful hours in the warm sun. Play in the pool. Head for the tennis courts. Sign up for a round of golf at a nearby course and explore ancient Mayan temples at El Rey. Sip a tropical cocktail on the terrace. Savor fresh seafood cooked to perfection. A peaceful ambiance and time-honored hospitality make this resort a truly special place to vacation with family and friends.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C029NG03',
        ],
      ],
    ],
  ],
];

$config['deals']['san-francisco'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'San Francisco',
    'state' => 'California',
    'location' => 'San Francisco, CA',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/san-francisco/san-francisco-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'img' => '/img/hero/san-francisco/san-francisco-hero-1.jpg',
    'og_img' => '/img/hero/san-francisco/san-francisco-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['san-francisco'].' Participating Hotels',
    'content' => "It may measure less than 50 square miles and have a population that doesn’t even crack a million, but San Francisco justly ranks as one of the greatest cities in the world. Famous for grand-dame Victorians, cable cars, a dynamic waterfront, and a soaring golden bridge, this city truly has it all. With trend-defining cuisine ranging from Michelin-starred dining to outrageous food trucks; world-renowned symphony, ballet, theater, and opera; plus almost boundless outdoor adventures, San Francisco justifiably stands out as one of the ultimate must-visit cities on any traveler’s wish list.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search San Francisco',
      'description' => '',
      'button' => 'SEARCH NOW',
      'img' => '/img/offers/san-francisco/san-francisco-360-150.png',      
    ],
    [
      'title' => $config['counts']['hotels']['san-francisco'].' San Francisco Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/san-francisco/san_remo_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">San Remo Hotel</a>', // should be resort villas?
        'content' => "Offering free Wi-Fi, this cosy European-style hotel is located in North Beach within walking distance of Fisherman's Wharf. It combines old-world charm along with modern amenities such as free Wi-Fi.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02W6N03',
        ],
      ],
      [ 
        'img' => '/img/offers/san-francisco/hotel_zoe_fishermans_wharf.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Zoe Fisherman's Wharf</a>",
        'content' => "Hotel Zoe debuts as San Francisco’s newest sophisticated Fisherman’s Wharf hotel, offering guests a whimsical and authentic hospitality experience.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C001ZF05',
        ],
      ],
      [ 
        'img' => '/img/offers/san-francisco/global_luxury_suites.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Global Luxury Suites</a>',
        'content' => "Global Luxury Suites offers luxury short and long-term corporate and vacation home rentals.
Customer satisfaction is our number one priority.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0ANPJ03',
        ],
      ],
      [ 
        'img' => '/img/offers/san-francisco/hotel_via.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Hotel Via</a>',
        'content' => "Located in the South Beach neighborhood of San Francisco, with Oracle Park across the street, Hotel Via is outfitted with modern, custom-made furniture and features a sun terrace and views of the city. Guests can enjoy the on-site rooftop bar with 360-degree views of Oracle Park, the Bay, and the San Francisco skyline.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00JO505',
        ],
      ],
      [ 
        'img' => '/img/offers/san-francisco/americania_hotel.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Americania Hotel</a>",
        'content' => "A hip San Francisco hotel that offers a convenient space well suited for families and business travelers.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00DIB03',
        ],
      ],
      [ 
        'img' => '/img/offers/san-francisco/hilton_san_francisco.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Hilton Union Square</a>',
        'content' => "Take in the city heights and sights from the heart of San Francisco. Soak in the breathtaking view from your room, then get out and explore the best of the Bay Area.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0078K02',
        ],
      ],
      [ 
        'img' => '/img/offers/san-francisco/embassy_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Embassy Hotel</a>',
        'content' => "We’re located in the heart of San Francisco and close to the Opera, Symphony, the Asian Art Museum, the California Culinary Academy and a wide variety of fine dining restaurants. In addition, The Embassy Hotel is within walking distance to the downtown financial district and close to the famous North Beach.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00E9R02',
        ],
      ],
    ],
  ],
];

$config['deals']['new-york'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'New York',
    'state' => 'New York State',
    'location' => 'New York, NY',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/new-york/new-york-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'img' => '/img/hero/new-york/new-york-hero-1.jpg',
    'og_img' => '/img/hero/new-york/new-york-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['new-york'].' Participating Hotels',
    'content' => "As one of the world's leading metropolises for art, fashion, food and theater, New York is a city every traveler should visit. Whether you come for a day trip or for an extended stay, choosing what to see and do is the toughest part – the possibilities are endless.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search New York',
      'description' => '',
      'button' => 'SEARCH NOW', 
      'img' => '/img/offers/new-york/new-york-360-150.png',      
    ],
    [
      'title' => $config['counts']['hotels']['new-york'].' New York Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/new-york/club_quarters.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Club Quarters</a>', // should be resort villas?
        'content' => "With premier access to some of NYC's most iconic sights, a dreamy stay awaits in The City of Dreams. Whether you're staying for a New York minute or longer in one of our deluxe studio apartments, your journey starts here.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C005MV06',
        ],
      ],
      [ 
        'img' => '/img/offers/new-york/mr_c_seaport.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Mr. C Seaport</a>",
        'content' => "The timeless glamour of Beverly Hills comes alive in stylish, European comfort with contemporary amenities, elegant service and personalized experiences by the fourth generation Cipriani family.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00GMB03',
        ],
      ],
      [ 
        'img' => '/img/offers/new-york/millenium_hilton.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Millenium Hilton</a>',
        'content' => "A high-rise hotel in the heart of Manhattan's Financial District! We have spectacular views and we're directly across from the World Trade Center and 11 Subway lines. Wall Street & the Brooklyn Bridge are a short walk away.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C006DK02',
        ],
      ],
      [ 
        'img' => '/img/offers/new-york/four_seasons_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Four Seasons Hotel</a>',
        'content' => "What better vantage point to conquer New York than a 52-story art deco icon designed by I.M. Pei? The newly transformed Four Seasons Hotel New York offers 368 ultra-spacious Manhattan luxury suites and hotel rooms, each a sanctuary with comforts more reminiscent of a private residence. Experience luxury accommodations filled with natural light, contemporary, custom furnishings and state-of-the-art technology.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02MRP02',
        ],
      ],
      [ 
        'img' => '/img/offers/new-york/best_western_gregory_hotel.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Best Western Gregory Hotel</a>",
        'content' => "The Best Western Gregory Hotel is sure to provide a peaceful and comforting home away from home for any traveler. Each Best Western hotel provides free internet access, giving guests the opportunity to check emails and surf the web, all from the comforts of their room or the business center. With cleanliness and value being our top priority, we ensure a restful and productive stay. On top of that, our superior customer service will ensure that we meet all your needs and go beyond your expectations.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C01D5F02',
        ],
      ],
      [ 
        'img' => '/img/offers/new-york/the_standard.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Standard</a>',
        'content' => "Rising above a former elevated railroad that has been developed into downtown’s favorite public park, The Standard, High Line is the first Standard Hotel to be built from the ground up. Its 338 rooms offer sweeping views of the uptown skyline and the Hudson River.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0RXFH03',
        ],
      ],
      [ 
        'img' => '/img/offers/new-york/rosewood_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Carlyle</a>',
        'content' => "Known for its refined style and charm, The Carlyle, A Rosewood Hotel embodies its neighborhood like no other luxury hotel. With Central Park views and Madison Avenue location, this quintessential New York hotel is a legend in its own right.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C007BY03',
        ],
      ],
    ],
  ],
];

$config['deals']['phoenix'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'Phoenix',
    'state' => 'Arizona',
    'location' => 'Phoenix, AZ',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/phoenix/phoenix-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'img' => '/img/hero/phoenix/phoenix-hero-1.jpg',
    'og_img' => '/img/hero/phoenix/phoenix-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['phoenix'].' Participating Hotels',
    'content' => "It's time to go beyond. Follow trails that reveal mighty mountaintops. Wander among iconic landscapes beneath picture-perfect skies.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search Phoenix',
      'description' => '',
      'button' => 'SEARCH NOW',
      'img' => '/img/offers/phoenix/phoenix-360-150.png',      
    ],
    [
      'title' => $config['counts']['hotels']['phoenix'].' Phoenix Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/phoenix/kimpton_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Kimpton Hotel</a>', // should be resort villas?
        'content' => 'The boutique hotel offers 242 spacious guest rooms and suites, all with modern interior touches and views of the surrounding city and mountains. In step with the signature style of Kimpton Hotel Palomar, this Phoenix destination combines contemporary design with an "Art in Motion" theme embracing the undercurrent of artistic energy throughout. Amenities include approximately 10,000 square feet of multi-use space across 10 meeting rooms, which can be customized for social and business events.',
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00BP004',
        ],
      ],
      [ 
        'img' => '/img/offers/phoenix/four_points_by_sheraton.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Four Points by Sheraton</a>",
        'content' => "Four Points by Sheraton Phoenix South Mountain presents all the conveniences you need for a successful trip to the Phoenix, Arizona area.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0IC2T01',
        ],
      ],
      [ 
        'img' => '/img/offers/phoenix/la_quinta_by_wyndham.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">La Quinta by Wyndham</a>',
        'content' => "Whether you’re traveling for business or pleasure, La Quinta by Wyndham is here to help you feel assured, relaxed and recharged.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02HZD03',
        ],
      ],
      [ 
        'img' => '/img/offers/phoenix/enchantment_resort.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Enchantment Resort</a>',
        'content' => "Surrounded by the towering red rock walls of Northern Arizona's Boynton Canyon, Enchantment Resort combines the rugged grandeur of the Southwest landscape with equal parts luxury and Native American culture.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0ARU402',
        ],
      ],
      [ 
        'img' => '/img/offers/phoenix/embassy_suites_phoenix.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Embassy Suites</a>",
        'content' => "A full service Embassy Suites Hotel located in Midtown/Downtown Phoenix; nestled in the Theatre, Arts and Museum District and numerous Medical & Fortune 100 companies. Adjacent to the Central/Thomas Light Rail.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00CIR03',
        ],
      ],
      [ 
        'img' => '/img/offers/phoenix/westin_phoenix_downtown.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Westin Phoenix Downtown</a>',
        'content' => "Offering a sense of renewal in downtown Phoenix and located 5 miles from Sky Harbor International Airport and within walking distance to the Phoenix Convention Center, Chase Field, Talking Stick Resort Arena and the business and entertainment district.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02F1C02',
        ],
      ],
      [ 
        'img' => '/img/offers/phoenix/renaissance_phoenix.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Renaissance</a>',
        'content' => "An artful urban retreat among downtown Phoenix hotels…With stylish new guestrooms, the Renaissance Phoenix Downtown combines the body of a full-service business and convention hotel with the soul of a boutique hotel. Discover the finest in downtown.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0097S04',
        ],
      ],
    ],
  ],
];

$config['deals']['new-orleans'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'New Orleans',
    'state' => 'Louisiana',
    'location' => 'New Orleans, LA',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/new-orleans/new-orleans-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'img' => '/img/hero/new-orleans/new-orleans-hero-1.jpg',
    'og_img' => '/img/hero/new-orleans/new-orleans-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['new-orleans'].' Participating Hotels',
    'content' => "There are probably a thousand reasons to visit New Orleans, as it's one of the most eccentric, vibrant cities in the world. It's filled with friendly people, amazing food, awesome live music and memorable attractions. It's a city where anyone can find something to enjoy, and adventures are constantly underway.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search New Orleans',
      'description' => '',
      'button' => 'SEARCH NOW', 
      'img' => '/img/offers/new-orleans/new-orleans-360-150.png',      
    ],
    [
      'title' => $config['counts']['hotels']['new-orleans'].' New Orleans Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/new-orleans/bienville_house_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Bienville House Hotel</a>', // should be resort villas?
        'content' => 'A boutique New Orleans hotel. Just as the French Quarter is perfectly situated in the heart of New Orleans, the Bienville House Hotel is perfectly situated in the midst of the historic French Quarter. ',
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00G6V03',
        ],
      ],
      [ 
        'img' => '/img/offers/new-orleans/frenchmen_hotel.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Frenchmen Hotel</a>",
        'content' => "A Funky, Boutique Hotel on NOLA's Frenchmen Street. Your home away from home. Relax with friends. Hang by the pool. Listen to great live music. Have a drink with us!",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C07BVW03',
        ],
      ],
      [ 
        'img' => '/img/offers/new-orleans/the_jung_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Jung Hotel</a>',
        'content' => "207 spacious luxury hotel and residential suite accommodations have been thoughtfully appointed with upscale amenities. Guests will enjoy complimentary WiFi, in-room dining and dry cleaning services, a rooftop pool, and on-site valet parking.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0GMYX03',
        ],
      ],
      [ 
        'img' => '/img/offers/new-orleans/super_8_by_wyndham.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Super 8 by Wyndham</a>',
        'content' => "Rest up at Super 8 by Wyndham with free breakfast, high-speed WiFi, and more. Convenient locations around the world give you the freedom to roam and a comfortable place to spend the night.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C05WJ903',
        ],
      ],
      [ 
        'img' => '/img/offers/new-orleans/rathbone_mansions.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Rathbone Mansions</a>",
        'content' => "Experience New Orleans past and present when you stay at our fun, historical hotel.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C07BW003',
        ],
      ],
      [ 
        'img' => '/img/offers/new-orleans/homewood_suites.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Homewood Suites</a>',
        'content' => "Nestled between the French Quarter and Warehouse District in the downtown business district, the hotel is blocks from New Orleans, Louisiana’s famous sites and activities.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C06GFR02',
        ],
      ],
      [ 
        'img' => '/img/offers/new-orleans/ace_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Ace Hotel</a>',
        'content' => "A friendly place, Ace Hotel New Orleans sits on the corner of Carondelet and Lafayette.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0AGSI03',
        ],
      ],
    ],
  ],
];

// offers
$config['global']['offers'] = [];
$config['global']['offers']['faq'] = [];
$config['global']['offers']['faq']['action_title'] = 'Read More';
$config['global']['offers']['faq']['action_url'] = $baseUrl.'app/faqs/';
$config['global']['offers']['faq']['qs'] = [
  [
    'q' => 'Who is Global Trips?',
    'a' => 'We are a US based members only travel company. We specialize in wholesale prices of hotels and weekly condo stays. Our members routinely save 50% or more on hotels and $1000’s off of weekly condo stays. Since the onset of Covid-19, our prices are even lower than normal as hotels and resorts give us better deals to try and fill up empty rooms.',
  ],
  [
    'q' => 'What is a weekly stay?',
    'a' => 'Our best deals are called "hot weeks". A hot week is an 8 day, 7 night stay at a resort property for as low as $298 for the entire stay. You can choose from 1, 2 or even 3 bedroom units, and literally save thousands of dollars on your next vacation.',
  ],
  [
    'q' => 'Why is there a charge?',
    'a' => "In order to bring you true wholesale pricing, we charge a membership fee, similar to a Sam's club or Costco. Sites like Expedia and Priceline are free to use, but charge you retail when you book, so you end up paying more in the long run.",
  ],
  [
    'q' => 'Can I see your prices?',
    'a' => "Of course! Create a membership to check out our members only rates. We're sure you'll love them.",
  ],
];

$config['global']['offers']['how_it_works'] = [
  'title' => 'Weekly Stays',
  'content' => 'Members have access to the best deals. Check out the video to learn more!',
  'video_url' => 'https://player.vimeo.com/external/547671806.hd.mp4?s=0746a5de6e35aec7dfacad8b8006b49d769b3a95&profile_id=174',
  'thumbnail_url' => '/img/club/gt-video-thumbnail.png',
];

$config['global']['offers']['check_list'] = [];
$config['global']['offers']['check_list']['img_alt'] = 'Map';
$config['global']['offers']['check_list']['title'] = 'NEVER PAY RETAIL AGAIN';

$config['global']['offers']['check_list']['items'] = [];
$config['global']['offers']['check_list']['items'][0] = 'Low monthly subscription';
$config['global']['offers']['check_list']['items'][1] = 'Direct pricing';
$config['global']['offers']['check_list']['items'][2] = 'Best savings online';
$config['global']['offers']['check_list']['items'][3] = 'Cancel any time';
$config['global']['offers']['check_list']['description'] = 'Find out how much you could save on your next vacation, start searching today';
$config['global']['offers']['check_list']['btn_text'] = 'SIGN UP NOW';
$config['global']['offers']['check_list']['action_url'] = $actionUrl;

$config['offers'] = [];
$config['offers']['orlando'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'Orlando',
    'state' => 'Florida',
    'location' => 'Orlando, FL',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/orlando/orlando-map-phone.png',
  ],
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'classes' => '',
    'img' => '/img/hero/orlando/orlando-hero-2.jpg',
    'og_img' => '/img/hero/orlando/orlando-hero-2-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['orlando'].' Participating Hotels',
    'content' => "Orlando is a magical place. There’s an incredible mix of fun things to do here that makes it an ideal vacationing spot for not only families but young singles, baby boomers, foodies, outdoor adventurous types, luxury shoppers and international visitors.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>',
  ],
  'banners' => [
    [
      'title' => 'Search Orlando',
      'description' => '',
      'button' => 'SEARCH NOW', 
      'img' => '/img/offers/orlando/orlando-360-150.png',
    ],
    [
      'title' => $config['counts']['hotels']['orlando'].' Orlando Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/orlando/sheraton_vistana.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Sheraton Vistana Resort</a>', // should be resort villas?
        'content' => "Soothing fountains and world-class amenities are just minutes away from the best of Orlando's attractions, making this the perfect place for you to create unforgettable vacations.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C002ML04',
        ],
      ],
      [ 
        'img' => '/img/offers/orlando/marriotts_grande_vista.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Marriott's Grande Vista</a>",
        'content' => "Regardless of whether you're looking for nonstop theme park thrills or fabulous dining, shopping and enough golf and recreational opportunities to keep you energized throughout your stay, Marriott's Grande Vista offers unforgettable experiences that will make your vacation a magical getaway.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C026MI02',
        ],
      ],
      [ 
        'img' => '/img/offers/orlando/hyatt_regency.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Hyatt Regency</a>',
        'content' => 'Located on International Drive, this resort is adjacent to the convention center, 2 miles from SeaWorld, within 4 miles of Universal Studios and Islands of Adventure, and 7 miles from Downtown Disney® area. A huge sundeck includes a poolside bar and a swimming grotto with a zero-entry pool and waterslide.',
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C01J8102',
        ],
      ],
      [ 
        'img' => '/img/offers/orlando/sunshine_resort.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Sunshine Resort</a>',
        'content' => "The airy 2-bedroom apartments feature full kitchens and dining areas, plus whirlpool tubs in master bedrooms. Cable TV and DVD players are also included, and Wi-Fi access is available for a fee. Parking is free. The outdoor pool area includes a kids' pool and snack bar. Other amenities include tennis and basketball courts, shuffleboard, a sauna and hot tub. There's also a barbecue area and a fire pit.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0BATT02',
        ],
      ],
      [ 
        'img' => '/img/offers/orlando/hilton_grand_vacations_seaworld.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Hilton Grand Vacations at Seaworld</a>',
        'content' => 'From an enhanced sense of arrival, our recently renovated guest rooms and meeting facilities, along with a new restaurant, a superior location and complimentary transportation to the major theme parks, we invite you to experience your next meeting, social gathering or fun-filled family Orlando vacation with us!',
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0079C02',
        ],
      ],
      [ 
        'img' => '/img/offers/orlando/springhill_suites.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">SpringHill Suites</a>',
        'content' => "We're located near Orange County Convention Center hotel and Orlando International Airport, making out-of-town business travel easier than ever! Our suites are thoughtfully designed to offer room to relax with amenities such as cloud-like beds with plush pillows, comfy lounge areas, HDTVs with premium channels, work desks & free Wi-Fi. Whether you're searching for a weekend getaway or extended stay hotel, you'll feel all the comforts of home at our suites, with nice amenities like our free park shuttles!",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C01C1Q02',
        ],
      ],
      [ 
        'img' => '/img/offers/orlando/doubletree_hilton_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">DoubleTree by Hilton</a>',
        'content' => "If you're taking a family vacation or traveling on business DoubleTree is a great choice among hotels near Orlando's airport. Only 10 minutes north of Orlando International Airport, the hotel is situated away from the bustle of Central Florida theme parks, but close enough to reach favorite attractions in just 20 minutes.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02BB902',
        ],
      ],
    ],
  ],
];

$config['offers']['myrtle-beach'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'Myrtle Beach',
    'state' => 'South Carolina',
    'location' => 'Myrtle Beach, SC',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/myrtle-beach/myrtle-beach-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'classes' => '',
    'img' => '/img/hero/myrtle-beach/myrtle-beach-hero-2.jpg',
    'og_img' => '/img/hero/myrtle-beach/myrtle-beach-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['myrtle-beach'].' Participating Hotels',
    'content' => "Beautiful beaches, award-winning restaurants, and first-rate entertainment can all be found in Myrtle Beach, the heart of the Grand Strand! Myrtle Beach is a visitor’s dream, offering everything from relaxing beaches, shopping, exhilarating thrill rides, exciting attractions, quality dining options, and sizzling nightlife. All of this adds up to the perfect vacation.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search Myrtle Beach',
      'description' => '',
      'button' => 'SEARCH NOW',
      'img' => '/img/offers/myrtle-beach/myrtle-beach-360-150.png',
    ],
    [
      'title' => $config['counts']['hotels']['myrtle-beach'].' Myrtle Beach Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/myrtle-beach/bluegreen_vacations.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Bluegreen Seaglass Tower</a>', // should be resort villas?
        'content' => "Occupying a sleek, glass-fronted high-rise, this relaxed, beachfront hotel is a 2-minute walk from the Myrtle Beach Boardwalk and Promenade, and 1.8 miles from Broadway at the Beach shopping center.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00ZHK02',
        ],
      ],
      [ 
        'img' => '/img/offers/myrtle-beach/dayton_house.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Dayton House</a>",
        'content' => "The Dayton House offers comfortable accommodations just steps away from the warm sand and beautiful Atlantic Ocean.
Accommodations range from efficiency rooms that sleep up to four guests, to oceanfront one bedroom suites that sleep up to six guests.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0HP9001',
        ],
      ],
      [ 
        'img' => '/img/offers/myrtle-beach/sun_n_sand.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Sun N Sand</a>',
        'content' => "Located on the South Carolina's storied Grand Strand, the Sun & Sand Resort delights visitors with its easy mix of Southern charm and contemporary services and amenities. Our attractive address on South Ocean Boulevard offers our guests easy access to the best shopping, dining, live entertainment and family-friendly attractions on the South Carolina coast.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0245L02',
        ],
      ],
      [ 
        'img' => '/img/offers/myrtle-beach/forest_dunes.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Forest Dunes</a>',
        'content' => 'Forrest Dunes Resort is located on the Golden Mile in Myrtle Beach. This quiet and residential area of Myrtle Beach provides guests with an enjoyable beach vacation.',
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0GIOP03',
        ],
      ],
      [ 
        'img' => '/img/offers/myrtle-beach/sea_crest_resort.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Sea Crest</a>',
        'content' => "It's a perennial family favorite for area vacationers. Its unbeatable location just blocks from the Family Kingdom Amusement Park and other attractions along with its children’s water park, coffee and internet cafe’ and Malibu Beach Bar make Sea Crest a “must-stay” resort!",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02QIF03',
        ],
      ],
      [ 
        'img' => '/img/offers/myrtle-beach/beach_colony.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Beach Colony</a>',
        'content' => 'Welcome to Beach Colony Resort! A popular family resort located oceanfront along the coveted Golden Mile in Myrtle Beach. Our family friendly resort offers spacious condo-style amenities and beach efficiencies, on-site dining, and generous resort-style amenities.',
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C004AP06',
        ],
      ],
      [ 
        'img' => '/img/offers/myrtle-beach/caribbean_resort.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Caribbean Resort</a>',
        'content' => "Enjoy the sun, sand, and the pleasures of golfing at Myrtle Beach’s very own, The Caribbean Resort & Villas!",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0BAHW02',
        ],
      ],
    ],
  ],
];

$config['offers']['gatlinburg'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'Gatlinburg',
    'state' => 'Tennesee',
    'location' => 'Gatlinburg, TN',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/gatlinburg/gatlinburg-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'classes' => '',
    'img' => '/img/hero/gatlinburg/gatlinburg-hero-1.jpg',
    'og_img' => '/img/hero/gatlinburg/gatlinburg-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['gatlinburg'].' Participating Hotels',
    'content' => "Located in Sevier County, Gatlinburg, TN is one of the southeast's most popular vacation destinations. Nestled in the heart of the Great Smoky Mountains, Gatlinburg is a charming town surrounded by high ridges, including Mount Le Conte, Sugarland Mountain, Cove Mountain, and Big Ridge.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search Gatlinburg',
      'description' => '',
      'button' => 'SEARCH NOW', 
      'img' => '/img/offers/gatlinburg/gatlinburg-360-150.png',
    ],
    [
      'title' => $config['counts']['hotels']['gatlinburg'].' Gatlinburg Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/gatlinburg/bearskin_lodge.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Bearskin Lodge</a>', // should be resort villas?
        'content' => "A landmark on the historic Gunflint Trail since 1925. Beautiful wilderness resort lodging on the edge of the BWCA in northern Minnesota.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02MH003',
        ],
      ],
      [ 
        'img' => '/img/offers/gatlinburg/glenstone_lodge.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Glenstone Lodge</a>",
        'content' => "Glenstone Lodge and Conference Center offers outstanding value in a beautiful mountain setting along a clear sparkling stream in the heart of Gatlinburg, walking distance to shops, attractions, and restaurants. Indoor and outdoor pools, on-site dining and 12,000 square feet of meeting space make this an ideal destination for families and groups alike.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02H1I02',
        ],
      ],
      [ 
        'img' => '/img/offers/gatlinburg/park_vista.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Park Vista</a>',
        'content' => "The premier full-service Hotel in Gatlinburg, TN. 300 rooms, 30 suites, mini waterpark/indoor pool, 25,000 sq ft convention space, Vista Grill restaurant, Firefly's lounge. State of the art Exercise Facility. And the World Famous Doubletree Cookie!",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C006L504',
        ],
      ],
      [ 
        'img' => '/img/offers/gatlinburg/westgate-smoky-mountain.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Westgate Smoky Mountain</a>',
        'content' => 'A full-service resort in Gatlinburg, provides easy access to Great Smoky Mountains National Park, as well as downtown Gatlinburg and Pigeon Forge, home to the Dollywood theme park. Onsite amenities include the state-of-the-art Wild Bear Falls water park, two outdoor pools, two hot tubs, miniature golf course, fitness center and world-class Serenity Spa. Dining options include the Roaring Fork. Guests can choose from a variety of accommodation choices such as studio villas, one-bedroom deluxe villas and two-bedroom villas, each of which contains a kitchenette or fully equipped kitchen.',
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00DOG03',
        ],
      ],
      [ 
        'img' => '/img/offers/gatlinburg/brookside_resort.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Brookside Resort</a>',
        'content' => "We have lots of activities for every member of the family to enjoy including a heated swimming pool, sauna, ice cream snack bar, video arcade, supervised kids' activities, miniature golf course, tennis courts, 9 hole golf course, and much more!!",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02I6502',
        ],
      ],
      [ 
        'img' => '/img/offers/gatlinburg/baymont.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Baymont</a>",
        'content' => "We are located near many attractions in Gatlinburg, TN including Ripley's Aquarium. Every room has a private balcony overlooking the Pigeon River with Great Smoky Mountain views.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C01PTP02',
        ],
      ],
      [ 
        'img' => '/img/offers/gatlinburg/edgewater_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Edgewater Hotel</a>',
        'content' => "Perched atop the banks of the little Pigeon River, The Edgewater Hotel has a towering altitude and an uncompromising attitude toward excellence in guest relations, comfort, safety and value.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0BDSD02',
        ],
      ],
    ],
  ],
];

$config['offers']['williamsburg'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'Williamsburg',
    'state' => 'Virginia',
    'location' => 'Williamsburg, VA',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/williamsburg/williamsburg-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'classes' => '',
    'img' => '/img/hero/williamsburg/williamsburg-hero-1.jpg',
    'og_img' => '/img/hero/williamsburg/williamsburg-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['williamsburg'].' Participating Hotels',
    'content' => "Come experience history in the making. It’s revolutionary fun with something for everyone. Enjoy everything from luxurious spas, world-class golf, and award-winning restaurants to living-history museums, surprising thrills, biking, and hiking. Whatever your idea of fun is, you’ll find it all in Greater Williamsburg. Experience Virginia tourism at its best and plan your trip to Williamsburg today!",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search Williamsburg',
      'description' => '',
      'button' => 'SEARCH NOW', 
      'img' => '/img/offers/williamsburg/williamsburg-360-150.png',      
    ],
    [
      'title' => $config['counts']['hotels']['williamsburg'].' Williamsburg Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/williamsburg/best_western_historic_area.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Best Western</a>', // should be resort villas?
        'content' => "Located in the heart of Williamsburg, the Best Western Historic Area offers affordable luxury in an ideal location.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C01SDL03',
        ],
      ],
      [ 
        'img' => '/img/offers/williamsburg/bluegreen_vacations.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Bluegreen Patrick Henry Square</a>",
        'content' => "Bluegreen Patrick Henry Square™ welcomes you to relax, revive and re-energize yourself in an atmosphere that combines engaging American history with exploration and fun. Ideally located only half a block from historic Williamsburg, the resort provides the perfect place to begin your journey back in time. Plan your day from the comfort of your cozy studio, roomy 1-bedroom premium suite, or spacious 2- or 3-bedroom accommodations or spacious 2-bedroom suite complete with full kitchen, separate living and dining areas and all the comforts of home. The colonial-inspired décor will motivate you to explore everything historic Williamsburg has to offer.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00RNM04',
        ],
      ],
      [ 
        'img' => '/img/offers/williamsburg/comfort_suites.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Comfort Suites</a>',
        'content' => "This straightforward all-suite hotel is 2 miles from Downtown and 7 miles from the Jamestown Settlement living history museum. Unfussy suites come with free Wi-Fi and flat-screen TVs, as well as minifridges, microwaves and coffeemakers; some add pull-out sofas, desks with ergonomic seats and whirlpool tubs.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C01TTH03',
        ],
      ],
      [ 
        'img' => '/img/offers/williamsburg/springhill_suites.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Springhill Suites</a>',
        'content' => "The SpringHill Suites by Marriott in historic Williamsburg, Virginia with new breakfast, provides a sensible choice for travelers to Virginia's historic triangle of Colonial Williamsburg, Jamestown and Yorktown. Located in the heart of Colonial Williamsburg's historic district, this hotel offers nearby attractions including Busch Gardens, Water Country USA, Colonial Williamsburg, the College of William and Mary, Merchants Square Shopping District, Prime Outlets, the Williamsburg Winery, and The Pottery.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0078F04',
        ],
      ],
      [ 
        'img' => '/img/offers/williamsburg/colonial_gardens.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Colonial Gardens</a>",
        'content' => "Colonial Gardens offers a luxury accommodation that will delight your entire party within Williamsburg’s city limits. Once you arrive at our historic home you will immediately feel both comfortable and special with its causal elegance. The furniture is inviting, the linens and fabrics are upscale yet cozy.  You will enjoy our whole house accommodations which are self catered. Private chef services are available at an additional cost if desired. The gardens at Colonial Gardens will beckon you to stop and watch the birds, butterflies and other wildlife in its park-like setting seasons permitting.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02MLR03',
        ],
      ],
      [ 
        'img' => '/img/offers/williamsburg/clarion_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Clarion Hotel</a>',
        'content' => "At the Clarion Hotel, business and leisure travelers can find the perfect place to reconnect with family, friends and colleagues. Our conference center hotel features all the space needed to host your next event. Whether it’s a business meeting or family reunion, you will find our unique space and friendly staff makes booking here an easy decision. From banquet rooms, to meeting space as well as a restaurant and bar area, our hotel provides all the options needed to properly connect with your people.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C004HE06',
        ],
      ],
      [ 
        'img' => '/img/offers/williamsburg/wyndham_patriots.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Wyndham Patriots Place</a>',
        'content' => "Wyndham Patriots’ Place, situated about a mile away from Williamsburg’s historical area, was built on the lush grounds of a former golf course. The property’s spaciousness, mature landscaping and lower-key architectural style lends a warm, comfortable “home away from home” feel to your stay.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0HK7E01',
        ],
      ],
    ],
  ],
];

$config['offers']['los-angeles'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'Los Angeles',
    'state' => 'California',
    'location' => 'Los Angeles, CA',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/los-angeles/los-angeles-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'classes' => '',
    'img' => '/img/hero/los-angeles/los-angeles-hero-1.jpg',
    'og_img' => '/img/hero/los-angeles/los-angeles-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['los-angeles'].' Participating Hotels',
    'content' => 'The city of Los Angeles [69] (also known simply as L.A., and nicknamed the "City of Angels") is the most populous city in California. Located on a broad basin in Southern California, the city is surrounded by vast mountain ranges, valleys, forests, beautiful beaches along the Pacific Ocean, and nearby desert.',
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search Los Angeles',
      'description' => '',
      'button' => 'SEARCH NOW', 
      'img' => '/img/offers/los-angeles/los-angeles-360-150.png',      
    ],
    [
      'title' => $config['counts']['hotels']['los-angeles'].' Los Angeles Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/los-angeles/doubletree.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">DoubleTree by Hilton</a>', // should be resort villas?
        'content' => "Los Angeles Downtown Hotel with easy access to major attractions, stunning views from the rooftop Kyoto Gardens and state-of-the-art Executive War Room and meeting space for all your needs!",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00EI602',
        ],
      ],
      [ 
        'img' => '/img/offers/los-angeles/level_furnished_living.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Level Furnished Living</a>",
        'content' => "Whether you are travelling for business, relocating or in transition, on a graduate program, or simply taking an extended holiday, the advantages that our furnished apartments offer are second to none. LEVEL couples the convenience of an apartment accommodation with the best of a hotel-style experience.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0RXGL03',
        ],
      ],
      [ 
        'img' => '/img/offers/los-angeles/sheraton_grand_los_angeles.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Sheraton Grand LA</a>',
        'content' => "In the heart of downtown financial district, the Sheraton Los Angeles Downtown Hotel is an inviting retreat for any lifestyle. Centrally located with entrances into the Macy’s Mall and just one block south of the city’s financial district, the Sheraton also makes for the most convenient choice downtown for meetings. Additionally, the hotel is only four blocks from the STAPLES Center and the Los Angeles Convention Center.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00EDH02',
        ],
      ],
      [ 
        'img' => '/img/offers/los-angeles/the_westin_bonaventure.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Westin Bonaventure</a>',
        'content' => "The Westin Bonaventure provides the ultimate urban oasis in the heart of the downtown Los Angeles' business district. Elegantly presiding over the City of Angels, an international symbol that has come to represent the beauty and sophistication of the city itself, this famous Westin Los Angeles hotel is one of the most photographed destinations in the world.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0I0SC01',
        ],
      ],
      [ 
        'img' => '/img/offers/los-angeles/millennium_biltmore.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Millennium Biltmore</a>",
        'content' => "Hollywood glamour personified. An elegant stay awaits in the heart of LA's vibrant cultural district.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0024R04',
        ],
      ],
      [ 
        'img' => '/img/offers/los-angeles/the_ritz_carlton.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Ritz Carlton</a>',
        'content' => "Days spent lounging by the rooftop pool. Nights remembered with cocktails and skyline views. Moments spent rubbing shoulders with celebrity entourages. At The Ritz-Carlton, Los Angeles, every experience articulates the charisma of this iconic destination.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C01B3Z02',
        ],
      ],
      [ 
        'img' => '/img/offers/los-angeles/miyako_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Miyako Hotel</a>',
        'content' => "Enjoy the flavor of Japanese hospitality in the heart of downtown Los Angeles. The Miyako Hotel is just moments from all tourists attractions and exciting things to do in Los Angeles both for business and pleasure.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00H3X03',
        ],
      ],
    ],
  ],
];

$config['offers']['cancun'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'Cancun',
    'state' => 'Quintana Roo',
    'location' => 'Cancun, MX',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/cancun/cancun-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'img' => '/img/hero/cancun/cancun-hero-1.jpg',
    'og_img' => '/img/hero/cancun/cancun-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['cancun'].' Participating Hotels',
    'content' => "Cancun is recognized throughout the world for its spectacular white sand beaches and its fascinating sea in turquoise blue tones. With unique natural places, Mayan culture, water activities and adventure. International cuisine, spectacular golf courses, sophisticated spa facilities; exclusive shopping centers, typical handicraft markets as well as shows, bars and nightclubs that give fame to its incomparable nightlife.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search Cancun',
      'description' => '',
      'button' => 'SEARCH NOW', 
      'img' => '/img/offers/cancun/cancun-360-150.png',      
    ],
    [
      'title' => $config['counts']['hotels']['cancun'].' Canc&uacute;n Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/cancun/dream_sands.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Dreams Sands</a>', // should be resort villas?
        'content' => "Perfectly situated along a breathtaking white sand beach in the heart of Cancun’s Hotel Zone, sits Dreams Sands Cancun Resort & Spa. Dreams Sands Cancun is walking distance from great shopping, restaurants and bars, and is only a short 15 minutes away from downtown Cancun. Enjoy the 650-foot stretch of pristine, white sand beach along the Mexican Caribbean.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C007V205',
        ],
      ],
      [ 
        'img' => '/img/offers/cancun/hyatt_ziva.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Hyatt Ziva</a>",
        'content' => "The only resort in the region surrounded on three sides by the Caribbean Sea. All-inclusive adventure for all ages.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00G6805',
        ],
      ],
      [ 
        'img' => '/img/offers/cancun/park_royal_cancun.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Park Royal</a>',
        'content' => "At the Park Royal Hotel Resorts on the Mexican Caribbean, you will be surrounded by beauty and pampered by our service. Our hotels have everything to make your vacation fun, memorable, and exciting. Plan a romantic getaway, family vacation, corporate retreat, reunion, or wedding and honeymoon. Live the experience of a lifetime in Mexico at one our exclusive resorts all inclusive.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C008IG05',
        ],
      ],
      [ 
        'img' => '/img/offers/cancun/sunset_royal_beach_resort.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Sunset Royal</a>',
        'content' => "Resting on one of the most beautiful white sand beaches in the Mexican Caribbean with breathtaking views of the turquoise blue Caribbean Sea, Sunset Royal Resort is an ideal place for a Cancun vacation. Located in a peaceful area of Cancun’s hotel zone, it’s close enough for easy access to popular travel entertainment, such as Coco Bongo and Dady’O nightclubs and Señor Frog’s and Carlos ‘n Charlie’s restaurants, but it’s also far enough away to escape the action if you choose to do so.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00CN504',
        ],
      ],
      [ 
        'img' => '/img/offers/cancun/panama_jack_resorts.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Panama Jack Resorts</a>",
        'content' => "Choose the world of Panama Jack Resorts and choose what’s most important to you in our all-inclusive paradise. Let the rhythm of the tropics soothe your soul while the ocean waves wash your cares away. We’ll handle the rest with a smile.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00RUN04',
        ],
      ],
      [ 
        'img' => '/img/offers/cancun/casa_turquesa.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Casa Turquesa</a>',
        'content' => "Exclusivity, Privacy & Art. Casa Turquesa is a Boutique Hotel featuring 24 Junior Suites and 5 Luxury Master Suites. Situated in the heart of the hotel zone in Cancun, offering privacy, exclusivity and art. Personalized service, al la carte dining, luxury accommodation.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0AFDW02',
        ],
      ],
      [ 
        'img' => '/img/offers/cancun/the_royal_islander.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Royal Islander</a>',
        'content' => "Nestled on the beach, The Royal Islander offers enchanting views of the Caribbean and the Nichupte Lagoon. Seek a moment of solitude at sunrise and enjoy blissful hours in the warm sun. Play in the pool. Head for the tennis courts. Sign up for a round of golf at a nearby course and explore ancient Mayan temples at El Rey. Sip a tropical cocktail on the terrace. Savor fresh seafood cooked to perfection. A peaceful ambiance and time-honored hospitality make this resort a truly special place to vacation with family and friends.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C029NG03',
        ],
      ],
    ],
  ],
];

$config['offers']['san-francisco'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'San Francisco',
    'state' => 'California',
    'location' => 'San Francisco, CA',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/san-francisco/san-francisco-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'img' => '/img/hero/san-francisco/san-francisco-hero-1.jpg',
    'og_img' => '/img/hero/san-francisco/san-francisco-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['san-francisco'].' Participating Hotels',
    'content' => "It may measure less than 50 square miles and have a population that doesn’t even crack a million, but San Francisco justly ranks as one of the greatest cities in the world. Famous for grand-dame Victorians, cable cars, a dynamic waterfront, and a soaring golden bridge, this city truly has it all. With trend-defining cuisine ranging from Michelin-starred dining to outrageous food trucks; world-renowned symphony, ballet, theater, and opera; plus almost boundless outdoor adventures, San Francisco justifiably stands out as one of the ultimate must-visit cities on any traveler’s wish list.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search San Francisco',
      'description' => '',
      'button' => 'SEARCH NOW',
      'img' => '/img/offers/san-francisco/san-francisco-360-150.png',      
    ],
    [
      'title' => $config['counts']['hotels']['san-francisco'].' San Francisco Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/san-francisco/san_remo_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">San Remo Hotel</a>', // should be resort villas?
        'content' => "Offering free Wi-Fi, this cosy European-style hotel is located in North Beach within walking distance of Fisherman's Wharf. It combines old-world charm along with modern amenities such as free Wi-Fi.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02W6N03',
        ],
      ],
      [ 
        'img' => '/img/offers/san-francisco/hotel_zoe_fishermans_wharf.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Zoe Fisherman's Wharf</a>",
        'content' => "Hotel Zoe debuts as San Francisco’s newest sophisticated Fisherman’s Wharf hotel, offering guests a whimsical and authentic hospitality experience.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C001ZF05',
        ],
      ],
      [ 
        'img' => '/img/offers/san-francisco/global_luxury_suites.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Global Luxury Suites</a>',
        'content' => "Global Luxury Suites offers luxury short and long-term corporate and vacation home rentals.
Customer satisfaction is our number one priority.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0ANPJ03',
        ],
      ],
      [ 
        'img' => '/img/offers/san-francisco/hotel_via.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Hotel Via</a>',
        'content' => "Located in the South Beach neighborhood of San Francisco, with Oracle Park across the street, Hotel Via is outfitted with modern, custom-made furniture and features a sun terrace and views of the city. Guests can enjoy the on-site rooftop bar with 360-degree views of Oracle Park, the Bay, and the San Francisco skyline.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00JO505',
        ],
      ],
      [ 
        'img' => '/img/offers/san-francisco/americania_hotel.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Americania Hotel</a>",
        'content' => "A hip San Francisco hotel that offers a convenient space well suited for families and business travelers.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00DIB03',
        ],
      ],
      [ 
        'img' => '/img/offers/san-francisco/hilton_san_francisco.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Hilton Union Square</a>',
        'content' => "Take in the city heights and sights from the heart of San Francisco. Soak in the breathtaking view from your room, then get out and explore the best of the Bay Area.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0078K02',
        ],
      ],
      [ 
        'img' => '/img/offers/san-francisco/embassy_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Embassy Hotel</a>',
        'content' => "We’re located in the heart of San Francisco and close to the Opera, Symphony, the Asian Art Museum, the California Culinary Academy and a wide variety of fine dining restaurants. In addition, The Embassy Hotel is within walking distance to the downtown financial district and close to the famous North Beach.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00E9R02',
        ],
      ],
    ],
  ],
];

$config['offers']['new-york'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'New York',
    'state' => 'New York State',
    'location' => 'New York, NY',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/new-york/new-york-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'img' => '/img/hero/new-york/new-york-hero-1.jpg',
    'og_img' => '/img/hero/new-york/new-york-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['new-york'].' Participating Hotels',
    'content' => "As one of the world's leading metropolises for art, fashion, food and theater, New York is a city every traveler should visit. Whether you come for a day trip or for an extended stay, choosing what to see and do is the toughest part – the possibilities are endless.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search New York',
      'description' => '',
      'button' => 'SEARCH NOW', 
      'img' => '/img/offers/new-york/new-york-360-150.png',      
    ],
    [
      'title' => $config['counts']['hotels']['new-york'].' New York Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/new-york/club_quarters.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Club Quarters</a>', // should be resort villas?
        'content' => "With premier access to some of NYC's most iconic sights, a dreamy stay awaits in The City of Dreams. Whether you're staying for a New York minute or longer in one of our deluxe studio apartments, your journey starts here.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C005MV06',
        ],
      ],
      [ 
        'img' => '/img/offers/new-york/mr_c_seaport.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Mr. C Seaport</a>",
        'content' => "The timeless glamour of Beverly Hills comes alive in stylish, European comfort with contemporary amenities, elegant service and personalized experiences by the fourth generation Cipriani family.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00GMB03',
        ],
      ],
      [ 
        'img' => '/img/offers/new-york/millenium_hilton.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Millenium Hilton</a>',
        'content' => "A high-rise hotel in the heart of Manhattan's Financial District! We have spectacular views and we're directly across from the World Trade Center and 11 Subway lines. Wall Street & the Brooklyn Bridge are a short walk away.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C006DK02',
        ],
      ],
      [ 
        'img' => '/img/offers/new-york/four_seasons_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Four Seasons Hotel</a>',
        'content' => "What better vantage point to conquer New York than a 52-story art deco icon designed by I.M. Pei? The newly transformed Four Seasons Hotel New York offers 368 ultra-spacious Manhattan luxury suites and hotel rooms, each a sanctuary with comforts more reminiscent of a private residence. Experience luxury accommodations filled with natural light, contemporary, custom furnishings and state-of-the-art technology.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02MRP02',
        ],
      ],
      [ 
        'img' => '/img/offers/new-york/best_western_gregory_hotel.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Best Western Gregory Hotel</a>",
        'content' => "The Best Western Gregory Hotel is sure to provide a peaceful and comforting home away from home for any traveler. Each Best Western hotel provides free internet access, giving guests the opportunity to check emails and surf the web, all from the comforts of their room or the business center. With cleanliness and value being our top priority, we ensure a restful and productive stay. On top of that, our superior customer service will ensure that we meet all your needs and go beyond your expectations.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C01D5F02',
        ],
      ],
      [ 
        'img' => '/img/offers/new-york/the_standard.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Standard</a>',
        'content' => "Rising above a former elevated railroad that has been developed into downtown’s favorite public park, The Standard, High Line is the first Standard Hotel to be built from the ground up. Its 338 rooms offer sweeping views of the uptown skyline and the Hudson River.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0RXFH03',
        ],
      ],
      [ 
        'img' => '/img/offers/new-york/rosewood_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Carlyle</a>',
        'content' => "Known for its refined style and charm, The Carlyle, A Rosewood Hotel embodies its neighborhood like no other luxury hotel. With Central Park views and Madison Avenue location, this quintessential New York hotel is a legend in its own right.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C007BY03',
        ],
      ],
    ],
  ],
];

$config['offers']['phoenix'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'Phoenix',
    'state' => 'Arizona',
    'location' => 'Phoenix, AZ',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/phoenix/phoenix-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'img' => '/img/hero/phoenix/phoenix-hero-1.jpg',
    'og_img' => '/img/hero/phoenix/phoenix-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['phoenix'].' Participating Hotels',
    'content' => "It's time to go beyond. Follow trails that reveal mighty mountaintops. Wander among iconic landscapes beneath picture-perfect skies.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search Phoenix',
      'description' => '',
      'button' => 'SEARCH NOW',
      'img' => '/img/offers/phoenix/phoenix-360-150.png',      
    ],
    [
      'title' => $config['counts']['hotels']['phoenix'].' Phoenix Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/phoenix/kimpton_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Kimpton Hotel</a>', // should be resort villas?
        'content' => 'The boutique hotel offers 242 spacious guest rooms and suites, all with modern interior touches and views of the surrounding city and mountains. In step with the signature style of Kimpton Hotel Palomar, this Phoenix destination combines contemporary design with an "Art in Motion" theme embracing the undercurrent of artistic energy throughout. Amenities include approximately 10,000 square feet of multi-use space across 10 meeting rooms, which can be customized for social and business events.',
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00BP004',
        ],
      ],
      [ 
        'img' => '/img/offers/phoenix/four_points_by_sheraton.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Four Points by Sheraton</a>",
        'content' => "Four Points by Sheraton Phoenix South Mountain presents all the conveniences you need for a successful trip to the Phoenix, Arizona area.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0IC2T01',
        ],
      ],
      [ 
        'img' => '/img/offers/phoenix/la_quinta_by_wyndham.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">La Quinta by Wyndham</a>',
        'content' => "Whether you’re traveling for business or pleasure, La Quinta by Wyndham is here to help you feel assured, relaxed and recharged.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02HZD03',
        ],
      ],
      [ 
        'img' => '/img/offers/phoenix/enchantment_resort.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Enchantment Resort</a>',
        'content' => "Surrounded by the towering red rock walls of Northern Arizona's Boynton Canyon, Enchantment Resort combines the rugged grandeur of the Southwest landscape with equal parts luxury and Native American culture.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0ARU402',
        ],
      ],
      [ 
        'img' => '/img/offers/phoenix/embassy_suites_phoenix.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Embassy Suites</a>",
        'content' => "A full service Embassy Suites Hotel located in Midtown/Downtown Phoenix; nestled in the Theatre, Arts and Museum District and numerous Medical & Fortune 100 companies. Adjacent to the Central/Thomas Light Rail.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00CIR03',
        ],
      ],
      [ 
        'img' => '/img/offers/phoenix/westin_phoenix_downtown.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Westin Phoenix Downtown</a>',
        'content' => "Offering a sense of renewal in downtown Phoenix and located 5 miles from Sky Harbor International Airport and within walking distance to the Phoenix Convention Center, Chase Field, Talking Stick Resort Arena and the business and entertainment district.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C02F1C02',
        ],
      ],
      [ 
        'img' => '/img/offers/phoenix/renaissance_phoenix.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Renaissance</a>',
        'content' => "An artful urban retreat among downtown Phoenix hotels…With stylish new guestrooms, the Renaissance Phoenix Downtown combines the body of a full-service business and convention hotel with the soul of a boutique hotel. Discover the finest in downtown.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0097S04',
        ],
      ],
    ],
  ],
];

$config['offers']['new-orleans'] = [
  'definitions' => [
    'privacy_policy_url' => $baseUrl.'legal/privacy/',
    'city' => 'New Orleans',
    'state' => 'Louisiana',
    'location' => 'New Orleans, LA',
  ],
  'map_section' => [
    'title' => 'What are you waiting for?',
    'content' => 'These are limited time offers. Sign up to access the amazing deals we have to offer!',
    'image' => '/img/offers/new-orleans/new-orleans-map-phone.png',
  ],  
  'hero' => [
    'template' => 'banner',
    'brand_img' => $logoUrl,
    'img' => '/img/hero/new-orleans/new-orleans-hero-1.jpg',
    'og_img' => '/img/hero/new-orleans/new-orleans-hero-1200-630.jpg',
    'title' => 'Exclusive Offers',
    'sub_title' => $config['counts']['hotels']['new-orleans'].' Participating Hotels',
    'content' => "There are probably a thousand reasons to visit New Orleans, as it's one of the most eccentric, vibrant cities in the world. It's filled with friendly people, amazing food, awesome live music and memorable attractions. It's a city where anyone can find something to enjoy, and adventures are constantly underway.",
    'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary '.$actionUrlClass.'">'.$searchIcon.' SEARCH NOW</a>'
  ],
  'banners' => [
    [
      'title' => 'Search New Orleans',
      'description' => '',
      'button' => 'SEARCH NOW', 
      'img' => '/img/offers/new-orleans/new-orleans-360-150.png',      
    ],
    [
      'title' => $config['counts']['hotels']['new-orleans'].' New Orleans Hotels',
      'description' => 'CHECKOUT EXCLUSIVE OFFERS',
      'button' => 'SEARCH NOW',   
      'img' => '',
    ],
  ],
  'offers' => [
    'template' => 'card',
    'container_classes' => 'px-2 px-sm-0',
    'action_class' => $actionUrlClass,
    'action_url' => $actionUrl,
//     'container_classes' => 'px-0 card-rounded-0', // specific do full screen offers on mobile
    'classes' => '',
    'list' => [
      [ 
        'img' => '/img/offers/new-orleans/bienville_house_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Bienville House Hotel</a>', // should be resort villas?
        'content' => 'A boutique New Orleans hotel. Just as the French Quarter is perfectly situated in the heart of New Orleans, the Bienville House Hotel is perfectly situated in the midst of the historic French Quarter. ',
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '54%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C00G6V03',
        ],
      ],
      [ 
        'img' => '/img/offers/new-orleans/frenchmen_hotel.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Frenchmen Hotel</a>",
        'content' => "A Funky, Boutique Hotel on NOLA's Frenchmen Street. Your home away from home. Relax with friends. Hang by the pool. Listen to great live music. Have a drink with us!",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '48%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C07BVW03',
        ],
      ],
      [ 
        'img' => '/img/offers/new-orleans/the_jung_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">The Jung Hotel</a>',
        'content' => "207 spacious luxury hotel and residential suite accommodations have been thoughtfully appointed with upscale amenities. Guests will enjoy complimentary WiFi, in-room dining and dry cleaning services, a rooftop pool, and on-site valet parking.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '45%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0GMYX03',
        ],
      ],
      [ 
        'img' => '/img/offers/new-orleans/super_8_by_wyndham.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Super 8 by Wyndham</a>',
        'content' => "Rest up at Super 8 by Wyndham with free breakfast, high-speed WiFi, and more. Convenient locations around the world give you the freedom to roam and a comfortable place to spend the night.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '58%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C05WJ903',
        ],
      ],
      [ 
        'img' => '/img/offers/new-orleans/rathbone_mansions.jpg',
        'title' => "<a href='".$actionUrl."' role='button' class='".$actionUrlClass."'>Rathbone Mansions</a>",
        'content' => "Experience New Orleans past and present when you stay at our fun, historical hotel.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '41%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C07BW003',
        ],
      ],
      [ 
        'img' => '/img/offers/new-orleans/homewood_suites.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Homewood Suites</a>',
        'content' => "Nestled between the French Quarter and Warehouse District in the downtown business district, the hotel is blocks from New Orleans, Louisiana’s famous sites and activities.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '40%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C06GFR02',
        ],
      ],
      [ 
        'img' => '/img/offers/new-orleans/ace_hotel.jpg',
        'title' => '<a href="'.$actionUrl.'" role="button" class="'.$actionUrlClass.'">Ace Hotel</a>',
        'content' => "A friendly place, Ace Hotel New Orleans sits on the corner of Carondelet and Lafayette.",
        'action' => '<a href="'.$actionUrl.'" role="button" class="btn btn-secondary w-100 mt-3 align-self-end '.$actionUrlClass.'">VIEW DEAL</a>',
        'phone' => '<span>Phone: </span><a href="'.$actionPhone.'" class="'.$actionPhoneClass.'">'.$actionPhone.'</a>',
        'highlight_box' => [
          'action_url' => $actionUrl,
          'action_class' => $actionUrlClass,
          'line1' => 'UP TO', // No more than 16 characters (Recommended)
          'line2' => '59%', // No more than 5 Digits (Recommended)
          'line3' => 'SAVINGS', // No more than 16 characters (Recommended)
        ],
        'property_details' => [
          'propType' => 'hotel',
          'propId' => 'C0AGSI03',
        ],
      ],
    ],
  ],
];


// Add Hashed params
// foreach(($config['deals'] ?? []) as $k => $v) {
//   $pathName = '/deals/'.$k.'/';
  
//   $tmp1 = [
//     'dslp_pathname' => $pathName,
//     'dslp_hcity' => $pathName,
//     'dslp_himg' => $v2['img'] ?? '',
//     'dslp_hcount' => $v2['img'] ?? '',
//   ];
  
  
//   foreach(($v['offers']['list'] ?? []) as $k2 => $v2) {
//     $tmp2 = [
//       'dslp_pathname' => $pathName,
//       'dslp_propertyType' => $v2['property_details']['propType'] ?? '',
//       'dslp_propertyId' => $v2['property_details']['propId'] ?? '',
//       'dslp_himg' => $v2['img'] ?? ''
//     ];
//     $hashedParams = buildActionLink($tmp2);
//     $config['deals'][$k]['offers']['list'][$k2]['highlight_box']['action_url'] = $baseUrl.http_build_query(['q' =>$hashedParams]);
//   }
// }

// function buildActionLink($params = []) {
//   $paramsStr = '';
//   try {
    
//   }catch(\Exception) {
//     $paramsStr = '';
//   }
//   return $paramsStr;
// }

function encrypt_decrypt_config_builder($action, $string) {
  $output = false;$encrypt_method = _ENCRYPT_METHOD;$secret_key = _SECRET_KEY;$secret_iv = _SECRET_IV;
  $key = hash('sha256', $secret_key);$iv = substr(hash('sha256', $secret_iv), 0, 16);
  if( $action == 'encrypt' ){$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);$output = base64_encode($output);
  }elseif( $action == 'decrypt' ) {$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);}
  return $output;
}

// room here to validate the object

file_put_contents('../config.json',json_encode($config));

$response['success'] = true;
$response['message'] = 'Configuration object updated successfully';

die(json_encode($response));