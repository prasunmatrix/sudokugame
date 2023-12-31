<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Member';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['user-registration']   = 'Member/registration';
$route['user-login']   = 'Member/user_login';
$route['game-finalised']   = 'Member/game_finalised';
$route['game-cancel']   = 'Member/game_cancel';
$route['game-win']   = 'Member/game_win';
$route['game-lost']   = 'Member/game_lost';
$route['usersignup']   = 'api/User/signup';


