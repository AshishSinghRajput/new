<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(ENVIRONMENT == 'development'):
    $config['base_url'] = 'http://localhost/converge/PPHCL/';    
elseif(ENVIRONMENT == 'production'):
    $config['base_url'] = 'http://cnvg.in/priyadarshini/';
endif;

$config['index_page'] = '';
$config['uri_protocol']	= 'REQUEST_URI';
$config['url_suffix'] = '';
$config['language']	= 'english';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = FALSE;
$config['subclass_prefix'] = 'MY_';
$config['composer_autoload'] = FALSE;
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-=';

$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';

$config['allow_get_array'] = TRUE;
$config['log_threshold'] = 0;
$config['log_path'] = '';
$config['log_file_extension'] = '';
$config['log_file_permissions'] = 0644;
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['error_views_path'] = '';
$config['cache_path'] = '';
$config['cache_query_string'] = FALSE;
$config['encryption_key'] = 'CNVG.PRIYDARSHINI@2019';

$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = NULL;
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;

$config['cookie_prefix']	= '';
$config['cookie_domain']	= '';
$config['cookie_path']		= '/';
$config['cookie_secure']	= FALSE;
$config['cookie_httponly'] 	= FALSE;

$config['standardize_newlines'] = FALSE;
$config['global_xss_filtering'] = FALSE;

$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array();

$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';

$config['captcha'] = array(
    'img_path' => './captcha/',
    'img_url' => $config['base_url'].'captcha/',
    'font_path' => 'fonts/verdana.ttf',
    'font_path' => FCPATH . 'system/fonts/Merriweather-Bold.ttf',
    'img_width' => '130',
    'img_height' => 40,
    'word_length' => 3,
    'font_size' => 16,
    'colors' => array(
        'background' => array(255, 255, 255),
        'border' => array(255, 255, 255),
        'text' => array(0, 0, 0),
        'grid' => array(192, 192, 192)
    )
);

$config['thumbnail_width_1000']	= '1000';
$config['thumbnail_width_600'] = '600';
$config['thumbnail_width_500']	= '500';
$config['thumbnail_height_300']	= '300';
$config['thumbnail_width_250']	= '250';
$config['thumbnail_width_125']	= '125';

$config['thumbnail_height_1250'] = '1250';
$config['thumbnail_height_1000'] = '1000';
$config['thumbnail_height_750'] = '750';
$config['thumbnail_height_500']	= '500';
$config['thumbnail_height_375']	= '375';
$config['thumbnail_height_250']	= '250';
$config['thumbnail_height_125']	= '125';

$config['store_images'] ='store/';
$config['store_thumbnail1'] ='store/thumbnail1/';
$config['store_thumbnail2'] ='store/thumbnail2/';

$config['brand_images'] ='brand/';
$config['brand_thumbnail1'] = $config['brand_images'].'thumbnail1/';
$config['brand_thumbnail2'] = $config['brand_images'].'thumbnail2/';

$config['category_images'] ='category/';
$config['category_thumbnail1'] = $config['category_images'].'thumbnail1/';
$config['category_thumbnail2'] = $config['category_images'].'thumbnail2/';

$config['product_images'] ='product/';
$config['product_thumbnail1'] = $config['product_images'].'thumbnail1/';
$config['product_thumbnail2'] = $config['product_images'].'thumbnail2/';

$config['users_images'] ='users/';
$config['users_thumbnail1'] = $config['users_images'].'thumbnail1/';
$config['users_thumbnail2'] = $config['users_images'].'thumbnail2/';

$config['bulk_upload_file'] ='assets/bank_excel_file/';
$config['project_image_info'] ='assets/project_image/';
$config['uc_info'] ='assets/uc_info/';
$config['brand_img'] ='assets/brand_img/';
$config['category_img'] ='assets/category_img/';
$config['multiple_thumb_image_path'] ='assets/project_thumb_image/';

/* File Upload */
$config['images_allowed_types'] = 'gif|jpg|jpeg|bmp|png|JPG|JPEG|';
$config['allowed_types'] = 'gif|jpg|jpeg|bmp|png|JPG|JPEG|';
$config['multi_allowed_types'] ='gif|jpg|jpeg|JPEG|png|pdf|PDF|DOCX|docx|DOC|doc|xlsx';
$config['bulk_allowed_types'] = 'xlsx|xls';
$config['pdf_allowed_types'] = 'pdf';
$config['gallery_video'] = 'mp4';
$config['max_video_size'] = '15360';
$config['max_size'] = '10000';
$config['max_width']	= '1024';
$config['max_height']	= '768';
$config['image_encryption'] = TRUE;
$config['default_per_page'] = 3;