<?php
if (!defined('GROUP_ADMIN')) {define('GROUP_ADMIN', 1);}
if (!defined('GROUP_WRITER')) {define('GROUP_WRITER', 2);}

if (!defined('ACTIVE')) {define('ACTIVE', 1);}
if (!defined('DEACTIVE')) {define('DEACTIVE', 0);}

/* --- System active */
if (!defined('ACTIVE_TRUE')) {define('ACTIVE_TRUE', 1);}
if (!defined('ACTIVE_FALSE')) {define('ACTIVE_FALSE', 0);}
if (!defined('EMAIL_TEMPLATE_FORGOT_PASSWORD')) {define('EMAIL_TEMPLATE_FORGOT_PASSWORD', 1);}

if (!defined('NEWS_POST')) {define('NEWS_POST', 1);}
if (!defined('EVENT_POST')) {define('EVENT_POST', 2);}
if (!defined('INSTRUCTION_POST')) {define('INSTRUCTION_POST', 3);}

if (!defined('SESSION_EXPIRED')) {define('SESSION_EXPIRED', 180);} // Expired in 30 minutes

    return [
        'urlBase' => "https://graph.vtcmobile.vn/oauth/authorize",
        'urlBaseToken' => "https://graph.vtcmobile.vn/oauth/access_token",
        'urlAccountApi' => "http://beta.graph.vtcmobile.vn/accountapiv4/server/get_user_info.aspx",
        'urlBaseApi' => "https://graph.vtcmobile.vn",
        'client_id' => "d2611e3f169f19f1fc8789f18c069bea",
        'client_secret' => "4fdd17e9012a18328a9f4a047d2cb488",
        'serviceid' => "330017",
        'redirect_url' => "https://aumobile.vn/moiban/login",
        'redirect_url_logout' => "https://aumobile.vn/moiban/logout",
        'url_api' => "https://aumobile.vn/moiban/api/",

        'checkCode2' => [
            'start' => '2023-02-02',
            'end' => '2023-09-01'
        ],

        'checkCode1' => '2023-02-01',
        'checkCode3' => '2023-09-02',
        'active' => [
            '0' => 'Disable',
            '1' => 'Active'
        ],

        'post_type' => [
            '1' => 'Tin tức',
            '2' => 'Sự kiện',
            '3' => 'Hướng dẫn',
        ],

        'giftcode_type' => [
            1 => 'Trước 1/2/2023',
            2 => 'Từ 2/2/2023 - 1/9/2023',
            3 => 'Tài khoản mới',
        ],


        'gender' => [
            1 => 'Nam',
            2 => 'Nữ',
        ],

        'level_of_user' => [
            1 => 'Admin',
        ],
    ];
