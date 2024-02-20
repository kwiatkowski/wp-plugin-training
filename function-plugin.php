<?php
/*
 * Plugin Name: running-calculator
 * Description: Zapewnia strukturę oraz funkcjonalności serwisu dla https://github.com/kwiatkowski/running-calculator-vue.
 * Author: Marcin Kwiatkowski
 * Author URI: https://kwiatkowski.co
 * Text Domain: theme-plugin running-calculator
 * Domain Path: /languages/
 * Version: 2024.02.20
 */

define('TRAINING_NAME', 'running-calculator');


// custom types
require 'src/pt-training.php';

// custom taxonomies
require 'src/tax-training-shoes.php';