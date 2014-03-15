<?php
/**
 * Plugin Name: exp. Behance
 * Plugin URI: http://wordpress.org/extend/plugins/behance-and-wordpress/
 * Version: 0.1
 * Author: Devon Hirth
 * Description: 
 * Text Domain: exp-behance
 * License: GPLv3
 */


/**
 * Helpers Function Array
 *
 * Usage (replace 'function_name' and $function_arg);
 * call_user_func( $helpers['function_name'] , $function_arg , $function_arg );
 *
 * Add Array Item (Function);
 * 'function_name' => function( $function_arg ) {
 *     // Do something
 *     return $return_something;
 * },
 * 
 */
$be_helpers = array(

	/**
	 * Environment Booleans
	 * @return [boolean] true if matches environment, false if doesn't
	 */
	'islocal' => function() {
		$u_local = array( 'local.behance.com' );
		return in_array( $_SERVER['SERVER_NAME'] , $u_local ) ? true : false;
	},
	'isdev' => function() {
		$u_dev = array( 'expbehance.devonhirth.com' );
		return in_array( $_SERVER['SERVER_NAME'] , $u_dev ) ? true : false;
	},
	'isstage' => function() {
		$u_stage = array( '' );
		return in_array( $_SERVER['SERVER_NAME'] , $u_stage ) ? true : false;
	},
	'isprod' => function() {
		$u_prod = array( '' );
		return in_array( $_SERVER['SERVER_NAME'] , $u_prod ) ? true : false;
	}

);

// Personal Portfolio
// $APP_NAME          = 'Personal Portfolio';
// $API_KEY_CLIENT_ID = 'S9ISvMy4MgV4cXvijnbIQOqtj9gTtVI0';
// $CLIENT_SECRET     = '_d4WB4R.VV1_VL5qcCy1nYZGujY7nJN6';
// $REDIRECT_URI      = 'http://www.devonhirth.com';

if ( call_user_func( $be_helpers[ 'islocal' ] ) ) :
	// Development
	$APP_NAME          = 'Behance Data Analysis Development';
	$API_KEY_CLIENT_ID = 'aeFHYbSwjcIAeYt4t9drudDpiJoQRZgz';
	$CLIENT_SECRET     = 'u._702YppKBocNIyuMTGe4m942cx9QCJ';
elseif ( call_user_func( $be_helpers[ 'isdev' ] ) ) :
	// Stage
	$APP_NAME          = 'Behance Data Analysis Staging';
	$API_KEY_CLIENT_ID = 'xHM0ruMO9nggYfH8DzBQx9iwrVATN4yp';
	$CLIENT_SECRET     = 'NZoD0e.0IxuLrJg_n4f0RwqI_p6E8r5G';
else :
	// Production
	$APP_NAME          = 'Behance Data Analysis';
	$API_KEY_CLIENT_ID = 'RvmuO4ai2TetDEBKKn2SJDwQ3iMM0LNZ';
	$CLIENT_SECRET     = 'dIDenw6S4Yr1LRLEgh9KdyGunI_ZHicZ';
endif;

// Red
// $APP_NAME          = 'Behance Data Analysis d10000';
// $API_KEY_CLIENT_ID = 'C0SEGo1RNvGzFgIz8hHgHViokj36Z5R9';
// $CLIENT_SECRET     = '1AwDueQWtdqzsOEn9IqOXj6ul0LRonSQ';

// Orange
// $APP_NAME          = 'Behance Data Analysis ff6622';
// $API_KEY_CLIENT_ID = 'hAVq0ImQ2aNnR4SHhX9z6Wkv8xceQie7';
// $CLIENT_SECRET     = 'cNIuCeGr7jNpd7nfkhaS1uYNPR8IFvrb';

// Yellow
// $APP_NAME          = 'Behance Data Analysis ffda21';
// $API_KEY_CLIENT_ID = 'vfjtcQvwMpdEek53M8hJlLwACYgSevB8';
// $CLIENT_SECRET     = 'gTOaSslB6J7T_UIoiJ2gdL7d8aED.ZNJ';

// Green
// $APP_NAME          = 'Behance Data Analysis 33dd00';
// $API_KEY_CLIENT_ID = 'SL2j3uuir3PkTyOkP6aBNBXjz2Fj0nii';
// $CLIENT_SECRET     = 'oWtf37ugLubqqrdKsjC5k52OAjiHQYxz';

// Blue
// $APP_NAME          = 'Behance Data Analysis 1133cc';
// $API_KEY_CLIENT_ID = 'ICHYA5zde2CjaDBRwIlfmPBvvJDOnE9J';
// $CLIENT_SECRET     = '1cowumDl3B9gQimWMuoSCyTLX.L8k7TP';

// Indigo
// $APP_NAME          = 'Behance Data Analysis 220066';
// $API_KEY_CLIENT_ID = 'voDe3OmYIMw8Qaeru7jYwM3SCtgYGYfs';
// $CLIENT_SECRET     = 'Cd07DSWOxgBGFUZlWCF8ls5EfwNS9lbg';

// Violet
// $APP_NAME          = 'Behance Data Analysis 330044';
// $API_KEY_CLIENT_ID = 'WxYTyflwBvaaq0VeAx9qXVsvk9ZY7BXJ';
// $CLIENT_SECRET     = '0RU5fhEWgQ3byZU8RFYE2LdKoLz3Kw5Z';

$USER          = 'devonhirth';
$REDIRECT_URI  = 'http://expbehance.devonhirth.com/';
$GETVARS       = $_GET;
$ROYGBIV       = array( 'd10000' , 'ff6622' , 'ffda21' , '33dd00' , '1133cc' , '220066' , '330044' );
$ROYGBIV_KEYS  = array( 
	'C0SEGo1RNvGzFgIz8hHgHViokj36Z5R9', 
	'hAVq0ImQ2aNnR4SHhX9z6Wkv8xceQie7', 
	'vfjtcQvwMpdEek53M8hJlLwACYgSevB8', 
	'SL2j3uuir3PkTyOkP6aBNBXjz2Fj0nii', 
	'ICHYA5zde2CjaDBRwIlfmPBvvJDOnE9J', 
	'voDe3OmYIMw8Qaeru7jYwM3SCtgYGYfs', 
	'WxYTyflwBvaaq0VeAx9qXVsvk9ZY7BXJ' 
);
$APP_NAMES = array( 
	'Behance Data Analysis d10000', 
	'Behance Data Analysis ff6622', 
	'Behance Data Analysis ffda21', 
	'Behance Data Analysis 33dd00', 
	'Behance Data Analysis 1133cc', 
	'Behance Data Analysis 220066', 
	'Behance Data Analysis 330044' 
);


/**
 * Create slug from string. Replacing special characters
 * and spaces with underscores.
 * @param  string $string string to generate slug.
 * @param  string $space string to replace spaces and special chars.
 * @return string the formatted slug.
 */
function create_slug( $string , $space ) {
	$string = rtrim( strtolower( trim( preg_replace( '/[^A-Za-z0-9-]+/' , $space , html_entity_decode( strip_tags( $string ) ) ) ) ) , $space );
	return $string;
}
 
/**
 * Create a var dump with pre tags wrapped around it.
 * @param  string $var variable to be dumped
 * @return void
 */
function pre_var_dump( $var ) {
	echo '<pre>'."\n";
	var_dump( $var );
	echo '</pre>'."\n";
}

/**
 * Create an echo with pre tags wrapped around it.
 * @param  string $var variable to be wrapped
 * @return void
 */
function pre_echo( $var ) {
	echo '<pre>'."\n";
	echo $var;
	echo '</pre>'."\n";
}

/**
 * cURL Function
 * @param  [string] $url url to curl
 * @return [object]      the object return of the curl or the file content
 */
function get_curl( $setopt )  {
	if( function_exists( 'curl_init' ) ) {
		$ch = curl_init();
		if ( array_key_exists( 'CURLOPT_URL' , $setopt ) )            curl_setopt( $ch , CURLOPT_URL , $setopt['CURLOPT_URL'] );
		if ( array_key_exists( 'CURLOPT_RETURNTRANSFER' , $setopt ) ) curl_setopt( $ch , CURLOPT_RETURNTRANSFER , $setopt['CURLOPT_RETURNTRANSFER'] );
		if ( array_key_exists( 'CURLOPT_HEADER' , $setopt ) )         curl_setopt( $ch , CURLOPT_HEADER , $setopt['CURLOPT_HEADER'] );
		if ( array_key_exists( 'CURLOPT_SSL_VERIFYHOST' , $setopt ) ) curl_setopt( $ch , CURLOPT_SSL_VERIFYHOST , $setopt['CURLOPT_SSL_VERIFYHOST'] );
		if ( array_key_exists( 'CURLOPT_SSL_VERIFYPEER' , $setopt ) ) curl_setopt( $ch , CURLOPT_SSL_VERIFYPEER , $setopt['CURLOPT_SSL_VERIFYPEER'] );
		if ( array_key_exists( 'CURLOPT_USERAGENT' , $setopt ) )      curl_setopt( $ch , CURLOPT_USERAGENT , $setopt['CURLOPT_USERAGENT'] );
		// foreach ( $setopt as $key => $value ) {
		// 	curl_setopt( $ch , $key , $value );
		// }
		$output = curl_exec( $ch );
		echo curl_error( $ch );
		curl_close( $ch );
		return $output;
	} else {
		return file_get_contents( $url );
	}
}

function be_getbehance() {
	
	global $API_KEY_CLIENT_ID, $REDIRECT_URI, $USER, $APP_NAME, $GETVARS, $ROYGBIV, $ROYGBIV_KEYS;

	echo '<p>Data scrape demonstration of the <a href="https://www.behance.net/">Behance Network</a> via the <a href="https://www.behance.net/dev" target="_blank">developer api</a>.</p>'."\n";
	echo '<p>Wordpress website framework with <a href="http://roots.io" target="_blank">Roots starter theme</a>. Charts generated with <a href="http://www.oesmith.co.uk/morris.js" target="_blank">morris.js</a>. Color picker by <a href="http://acko.net/blog/farbtastic-jquery-color-picker-plug-in/" target="_blank">Farbtastic</a>.</p>'."\n";
	
	$cache_fields      = 'cache/be_cache_fields.json';

	if ( file_exists( $cache_fields ) && filemtime( $cache_fields ) > time() - 60 * 60 ) :
		$data_fields  = json_decode( file_get_contents( $cache_fields ) , true );
	else :
		$CURLOPT_URL  = 'http://www.behance.net/v2/fields?api_key=' . $API_KEY_CLIENT_ID;
		$data_fields  = get_curl( array( 
			'CURLOPT_URL'            => $CURLOPT_URL,
			'CURLOPT_USERAGENT'      => $APP_NAME,
			'CURLOPT_RETURNTRANSFER' => true
		));
		$data_fields  = json_decode( $data_fields , true );
		$cache_fields = file_put_contents( $cache_fields , json_encode( $data_fields ) );
	endif;

	be_buildform( $data_fields );

	$page   = ( isset( $GETVARS[ 'page' ] ) ) ? $GETVARS[ 'page' ] : '1';
	$field  = ( isset( $GETVARS[ 'field' ] ) ) ? create_slug( $GETVARS[ 'field' ] , '+' ) : create_slug( 'Graphic Design' , '+' );

	$parameters = array(
		0 => array(
			'endpoint' => 'projects',
			'field'    => $field,
			'time'     => 'all',
			'page'     => $page,
			'api_key'  => $API_KEY_CLIENT_ID
		),
		1 => array(
			'endpoint' => 'projects',
			'field'    => $field,
			'time'     => 'month',
			'page'     => $page,
			'api_key'  => $API_KEY_CLIENT_ID
		),
		2 => array(
			'endpoint' => 'projects',
			'field'    => $field,
			'time'     => 'week',
			'page'     => $page,
			'api_key'  => $API_KEY_CLIENT_ID
		),
		3 => array(
			'endpoint' => 'projects',
			'field'    => $field,
			'time'     => 'today',
			'page'     => $page,
			'api_key'  => $API_KEY_CLIENT_ID
		),
		4 => array(
			'endpoint'  => 'projects',
			'field'     => $field,
			'color_hex' => $ROYGBIV[0],
			'page'      => $page,
			'api_key'   => $ROYGBIV_KEYS[0]
		),
		5 => array(
			'endpoint'  => 'projects',
			'field'     => $field,
			'color_hex' => $ROYGBIV[1],
			'page'      => $page,
			'api_key'   => $ROYGBIV_KEYS[1]
		),
		6 => array(
			'endpoint'  => 'projects',
			'field'     => $field,
			'color_hex' => $ROYGBIV[2],
			'page'      => $page,
			'api_key'   => $ROYGBIV_KEYS[2]
		),
		7 => array(
			'endpoint'  => 'projects',
			'field'     => $field,
			'color_hex' => $ROYGBIV[3],
			'page'      => $page,
			'api_key'   => $ROYGBIV_KEYS[3]
		),
		8 => array(
			'endpoint'  => 'projects',
			'field'     => $field,
			'color_hex' => $ROYGBIV[4],
			'page'      => $page,
			'api_key'   => $ROYGBIV_KEYS[4]
		),
		9 => array(
			'endpoint'  => 'projects',
			'field'     => $field,
			'color_hex' => $ROYGBIV[5],
			'page'      => $page,
			'api_key'   => $ROYGBIV_KEYS[5]
		),
		10 => array(
			'endpoint'  => 'projects',
			'field'     => $field,
			'color_hex' => $ROYGBIV[6],
			'page'      => $page,
			'api_key'   => $ROYGBIV_KEYS[6]
		)
	);

	foreach ( $parameters as $set ) {
		be_process( $set );
	}

	be_buildchart();

}

function be_process( $parameters ) {

	global $API_KEY_CLIENT_ID, $REDIRECT_URI, $USER, $APP_NAME, $APP_NAMES;

	$ENDPOINT     = $parameters[ 'endpoint' ]; unset( $parameters[ 'endpoint' ] );
	$CURLOPT_URL  = 'http://www.behance.net/v2/'.$ENDPOINT;
	$cache_id     = 'be_'.$ENDPOINT.'_';
	$param_count  = 0;
	$param_length = sizeof( $parameters );

	foreach( $parameters as $key => $value ) :
		$CURLOPT_URL .= ( $param_count > 0 ) ? '&'.$key.'='.(string)$value : '?'.$key.'='.(string)$value;
		$cache_id    .= ( $param_count < $param_length - 1 ) ? $value.'_' : '';
		$param_count++;
	endforeach;
	
	// $cache_id         = sha1( $CURLOPT_URL );
	$cache_id           = trim( $cache_id , '_' );
	$cache_projects     = 'cache/' . $cache_id . '.json';
	foreach ( $APP_NAMES as $key => $value ) :
		if ( isset( $parameters[ 'color_hex' ] ) && strpos( $value , $parameters[ 'color_hex' ] ) !== false ) :
			$NAME_QUERY = $value;
		else :
			$NAME_QUERY = $APP_NAME;
		endif;
	endforeach;

	if ( file_exists( $cache_projects ) /*&& filemtime( $cache_projects ) > time() - 60 * 60*/ ) :
		$data_projects  = json_decode( file_get_contents( $cache_projects ) , true );
	else :
		$data_projects  = get_curl( array( 
			'CURLOPT_URL'            => $CURLOPT_URL,
			'CURLOPT_USERAGENT'      => $NAME_QUERY,
			'CURLOPT_RETURNTRANSFER' => true
		));
		$data_projects  = json_decode( $data_projects , true );
		$cache_projects = file_put_contents( $cache_projects , json_encode( $data_projects ) );
	endif;

	$parameters[ 'endpoint' ] = $ENDPOINT;
	unset( $parameters[ 'api_key' ] );

	$id = array(
		'url'   => $CURLOPT_URL,
		'id'    => $cache_id,
		'param' => $parameters
	);

	be_loop( $id , $data_projects );

}

function be_loop( $id , $data ) {

	echo '<h2>Query Result</h2>'."\n";
	echo '<pre><small>';
	echo 'ID: '.$id[ 'id' ]."\n";
	echo 'local: <a href="http://'.$_SERVER['SERVER_NAME'].'/cache/'.$id[ 'id' ].'.json" target="_blank">'.$_SERVER['SERVER_NAME'].'/cache/'.$id[ 'id' ].'</a>'."\n";
	foreach( $id[ 'param' ] as $key => $value ) :
	echo $key.': '.$value."\n";
	endforeach;
	echo '</small></pre><br>'."\n";

	$barid_v = 'barv-'.$id[ 'id' ];
	$barid_a = 'bara-'.$id[ 'id' ];
	$barid_c = 'barc-'.$id[ 'id' ];
	$hex_color = isset( $id[ 'param' ][ 'color_hex' ] ) ? '#'.$id[ 'param' ][ 'color_hex' ] : '#1769ff';
	?>
	<div class="row count3 charts">
	<h4 class="add cols">Views</h4>
	<h4 class="add cols">Appreciations</h4>
	<h4 class="add cols">Comments</h4>
	<div id="<? echo $barid_v ?>" class="add cols"></div>
	<div id="<? echo $barid_a ?>" class="add cols"></div>
	<div id="<? echo $barid_c ?>" class="add cols"></div>
	</div>
	<script>
	$( document ).ready( function() {
		Morris.Bar({
			element: '<? echo $barid_v ?>',
			data: [ <? 
				foreach( $data[ 'projects' ] as $project ) : 
					$project_name = str_replace( '"' , '' , $project[ 'name' ] );
					$project_name = preg_replace( "/\r|\n/" , '' , $project_name );
					echo '{ y : "'.$project_name.'" , views : '.$project[ 'stats' ][ 'views' ].' },';
				endforeach;
				?> ],
			xkey: 'y',
			ykeys: [ 'views' ],
			<? if ( $hex_color ) echo 'barColors: ["'.$hex_color.'"],'; ?>
			labels: [ 'Views' ]
		});
		Morris.Bar({
			element: '<? echo $barid_a ?>',
			data: [ <? 
				foreach( $data[ 'projects' ] as $project ) : 
					$project_name = str_replace( '"' , '' , $project[ 'name' ] );
					$project_name = preg_replace( "/\r|\n/" , '' , $project_name );
					echo '{ y : "'.$project_name.'" , appreciations : '.$project[ 'stats' ][ 'appreciations' ].' },';
				endforeach;
				?> ],
			xkey: 'y',
			ykeys: [ 'appreciations' ],
			<? if ( $hex_color ) echo 'barColors: ["'.$hex_color.'"],'; ?>
			labels: [ 'Appreciations' ]
		});
		Morris.Bar({
			element: '<? echo $barid_c ?>',
			data: [ <? 
				foreach( $data[ 'projects' ] as $project ) : 
					$project_name = str_replace( '"' , '' , $project[ 'name' ] );
					$project_name = preg_replace( "/\r|\n/" , '' , $project_name );
					echo '{ y : "'.$project_name.'" , comments : '.$project[ 'stats' ][ 'comments' ].' },';
				endforeach;
				?> ],
			xkey: 'y',
			ykeys: [ 'comments' ],
			<? if ( $hex_color ) echo 'barColors: ["'.$hex_color.'"],'; ?>
			labels: [ 'Comments' ]
		});
	});
	</script>
	<?

	echo '<div class="thumbnails row count5">'."\n";
	foreach( $data[ 'projects' ] as $project ) :

		$cover = basename( $project[ 'covers' ][ 202 ] );
		$local = 'cache/img/' . $cover;
		$cover = ( file_exists( $local ) ) ? $local : $cover;

		echo '<div class="cols add">'."\n";
			echo '<img class="col12" src="'.$cover.'">'."\n";
			echo '<div class="text-wrap col12">'."\n";
				echo '<h4><a href="'.$project[ 'url' ].'" target="_blank">'.$project[ 'name' ].'</a></h4>'."\n";
				echo '<p><small>'."\n";
				echo 'Views: '.$project[ 'stats' ][ 'views' ].'<br/>'."\n";
				echo 'Appreciations: '.$project[ 'stats' ][ 'appreciations' ].'<br/>'."\n";
				echo 'Comments: '.$project[ 'stats' ][ 'comments' ].'<br/>'."\n";
				echo '</small></p>'."\n";
			echo '</div>'."\n";
		echo '</div>'."\n";

	endforeach;
	echo '</div>'."\n";

}

function be_buildform( $data_fields ) {

	echo '<h2>Query Parameters</h2>'."\n";

	echo '<form id="be_form" class="row add count5">'."\n";

		echo '<div class="cols add row">'."\n";
			echo '<label>Sort</label>'."\n";
			echo '<div class="txt-wrap"><p><small>The order the results are returned in. Possible values: featured_date (default), appreciations, views, comments, published_date.</small></p></div>'."\n";
			echo '<select class="col12">'."\n";
				echo '<option>Featured Date</option>'."\n";
				echo '<option>Appreciations</option>'."\n";
				echo '<option>Views</option>'."\n";
				echo '<option>Comments</option>'."\n";
				echo '<option>Published Date</option>'."\n";
			echo '</select>'."\n";
		echo '</div>'."\n";


		echo '<div class="cols add row">'."\n";
			echo '<label>Time</label>'."\n";
			echo '<div class="txt-wrap"><p><small>Limits the search by time. Possible values: all (default), today, week, month.</small></p></div>'."\n";
			echo '<select class="col12">'."\n";
				echo '<option>all</option>'."\n";
				echo '<option>today</option>'."\n";
				echo '<option>week</option>'."\n";
				echo '<option>month</option>'."\n";
			echo '</select>'."\n";
		echo '</div>'."\n";


		echo '<div class="cols add row">'."\n";
			echo '<label>Creative Fields</label>'."\n";
			echo '<div class="txt-wrap"><p><small>Limits the search by creative field. Accepts a URL-encoded field name from the list of defined creative fields.</small></p></div>'."\n";
			echo '<select class="col12">'."\n";
			foreach( $data_fields['fields'] as $key => $value ) :
				echo '<option>'.$value['name'].'</option>'."\n";
			endforeach;
			echo '</select>'."\n";
		echo '</div>'."\n";


		echo '<div class="cols add row">'."\n";
			echo '<label>Color Value</label>'."\n";
			echo '<div class="txt-wrap"><p><small>Limit results to an RGB hex value</small></p>'."\n";
			echo '<div id="colorpicker" class="row">'."\n";
				echo '<div class="farbtastic">'."\n";
						echo '<div class="color" style="background-color: rgb(255, 0, 0);"></div>'."\n";
						echo '<div class="wheel"></div>'."\n";
						echo '<div class="overlay"></div>'."\n";
						echo '<div class="h-marker marker" style="left: 97px; top: 13px;"></div>'."\n";
						echo '<div class="sl-marker marker" style="left: 119px; top: 121px;"></div>'."\n";
					echo '</div>'."\n";
				echo '</div>'."\n";
			echo '</div>'."\n";
			echo '<input type="text" id="color" name="color" value="#ffffff" class="col12"/>'."\n";
		echo '</div>'."\n";


		echo '<div class="cols add row">'."\n";
			echo '<label>Color Range</label>'."\n";
			echo '<div class="txt-wrap"><p><small>How closely to match the requested color_hex, in color shades (default:20) [0-255]</small></p></div>'."\n";
			echo '<input type="number" name="quantity" min="0" max="255" class="col12" value="20">'."\n";
		echo '</div>'."\n";


	echo '</form>'."\n";

}

function be_buildchart() {
	
	global $GETVARS, $ROYGBIV;

	foreach( $ROYGBIV as $value ) :
		$id = 'full-color-chart'.$value;
		echo '<h2>'.$value.'</h2>'."\n";
		echo '<div class="row add">'."\n";

		echo '<div id="'.$id.'" class="add"></div>'."\n";

	?><script>
	$( document ).ready( function() {
		Morris.Bar({
			element: '<? echo $id ?>',
			data: [ <?
		foreach ( scandir( 'cache' ) as $filename ) :
		    if ( strpos( $filename , $value ) ) :
		    	$data = json_decode( file_get_contents( 'cache/' . $filename ) , true );
		    	foreach( $data[ 'projects' ] as $project ) : 
		    		$project_name = str_replace( '"' , '' , $project[ 'name' ] );
					$project_name = preg_replace( "/\r|\n/" , '' , $project_name );
					echo '{ y : "'.$project_name.'" , views : '.$project[ 'stats' ][ 'views' ].' },';
				endforeach;
		    endif;
		endforeach;
		?> ],
			xkey: 'y',
			ykeys: [ 'views' ],
			<? echo 'barColors: ["#'.$value.'"],'; ?>
			labels: [ 'Views' ]
		});
	});
	</script><?

		echo '</div>'."\n";
	endforeach;

	// Scan directory
	// echo '<div id="bar-example"></div>'."\n";

}

?>
