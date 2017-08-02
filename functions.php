<?php

//define constants
$sname = "RHEAAIO";

define("RHEAAIO",$sname);

define("RHEANAME","wp-aio-social");

define("RHEASN","Aio Social");

$site = get_bloginfo("url");

$parse  = parse_url($site);

$domain = $parse['host'];

define("RHEADOMAIN",$domain);

define("RHEAPATH",plugin_dir_path( __FILE__ ));

define("RHEAURI",plugin_dir_url( __FILE__ ));

//load
require(plugin_dir_path( __FILE__ )."/lib/social.class.php");

$AioSocialWP = new RheaSocial();

