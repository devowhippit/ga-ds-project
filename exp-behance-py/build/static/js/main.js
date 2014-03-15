/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

// Spacegray - Ocean Dark Colors
var spacegrayblack      = '#1c1f26';
var spacegraywhite      = '#c0c5ce';
var spacegrayred        = '#bf616a';
var spacegraygreen      = '#a3be8c';
var spacegrayorange     = '#c98772';
var spacegraypurple     = '#b48ead';
var spacegrayblue       = '#86a1b3';
var spacegrayyellow     = '#ebc877';
var spacegraybgcolor    = '#232830';
var spacegraybgcoloralt = '#2b303b';
var spacegraytxtcolor   = '#65737c';

var rgbred    = '#d10000';
var rgborange = '#ff6622';
var rgbyellow = '#ffda21';
var rgbgreen  = '#33dd00';
var rgbblue   = '#1133cc';
var rgbindigo = '#220066';
var rgbviolet = '#330044';

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var routes = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages


      /**
       *
       */       
      var _data;
      var _colors;
      var _projects;
      var _projectsid;
      var _thresh = 150;

      /**
       *
       */
      $.getJSON( "static/data/projectbyimage.json" , function( _projects ) {
        $.getJSON( "static/data/projectbyid.json" , function( _projectsid ) { 
          getColors( _projects , _projectsid );
        });
      });


      /**
       *
       */
      function getColors( _projects , _projectsid ) {

        $.getJSON( "static/data/color_memory.json" , function( _colors ) {
          hist( _projects , _projectsid , _colors );
        });

      }


      /**
       *
       */
      function hist( _projects , _projectsid , _colors ) {

        var _covers     = _colors[ "covers" ][ 0 ];
        var _proj       = _projects[ "projects" ][ 0 ];
        var _color      = '';
        var _time       = 1000;
        var _attributes = new Array();
        var $colorgrid  = $( '#color-grid' );
        var $main       = $( '#main' );
        var _colorarray = [];
        var _colorarrayviews , _colorarrayappr, _colorarraycomm;


        /**
         * Get the most frequent colors of images and get the 
         * stats for that image, create and attribute list to 
         * sort on.
         */
        for ( var key in _covers ) {
          
          _hex = _covers[ key ][ 'freq' ];
          
          if ( !_hex ) continue;

          _hex = ( _hex.length > 6 ) ? _hex.slice( 0 , -2 ) : _hex;

          _keycolor = /*$.xcolor.lighten(*/ '#' + _hex /*)*/;
          _keycolor = '#' + _hex;
          _color    = ( _color == '' ) ? _keycolor : _color;
          _color    = $.xcolor.average( _color , _keycolor );

          _attributes = { 
            'class'              : 'item',
            'data-appreciations' : _proj[ key ][ 0 ][ 'stats' ][ 'appreciations' ],
            'data-views'         : _proj[ key ][ 0 ][ 'stats' ][ 'views' ],
            'data-comments'      : _proj[ key ][ 0 ][ 'stats' ][ 'comments' ],
            'style'              : 'background-color:'+_keycolor+';' 
          };

          /*if ( $.xcolor.distance( '#FF0000' , _keycolor ) < _thresh )*/ _colorarray.push( _attributes );

        }


        /**
         * Sort attribute list
         */
        _colorsorts = {
          _colorarrayviews : 'views',
          _colorarrayappr  : 'appreciations',
          _colorarraycomm  : 'comments'
        }


        /**
         * Create markup from the attributes and create cells to append to the grid
         */
        for ( sort in _colorsorts ) {

          var _colormarkup = '';
          var _colorsort = sortByKey( _colorarray , 'data-' + _colorsorts[sort] );

          for ( var object in _colorsort ) {

            var attributearray = _colorsort[ object ];
            var html = '<div ';
            for ( var attribute in attributearray ) {
              html = html + attribute + '="' + attributearray[ attribute ] + '" ';
            }
            html = html + ' ></div>';
            _colormarkup = _colormarkup + html;

          }
          
          $main.append( '<h3><small>Color distribution of \''+_colorsorts[sort]+'\'</small></h3>' );
          $main.append( '<div class="color-grid color-grid-'+_colorsorts[sort]+'">' + _colormarkup + '</div>' );

        }

        // $colorgrid.isotope({ 
        //   itemSelector : '.item',
        //   layoutMode   : 'masonry',
        //   getSortData  : {
        //       appreciations : '[data-appreciations]',
        //       views         : '[data-views]',
        //       comments      : '[data-comments]'
        //   }
        // });

        // $( '.sorts' ).find( 'a' ).on( 'click', function( event ) {
        //   event.preventDefault();
        //   var sortValue = $( this ).attr( 'data-sort' );
        //   $colorgrid.isotope( { sortBy : sortValue } );
        // });

        $.getJSON( "static/data/hist_memory.json" , function( _data ) { 
          
          var buckets = _data[ "buckets" ];
          var _bucket = [];
          var bucketsnms = [
            [
              '[1000000, 900000]',
              '[899999, 800000]',
              '[799999, 700000]',
              '[699999, 600000]',
              '[599999, 500000]',
              '[499999, 400000]',
              '[399999, 300000]',
              '[299999, 200000]',
              '[199999, 100000]',
              '[99999, 0]'
            ],
            [
              '[99999, 90000]',
              '[89999, 80000]',
              '[79999, 70000]',
              '[69999, 60000]',
              '[59999, 50000]',
              '[49999, 40000]',
              '[39999, 30000]',
              '[29999, 20000]',
              '[19999, 10000]',
              '[9999, 0]'
            ],
            [
              '[9999, 9000]',
              '[8999, 8000]',
              '[7999, 7000]',
              '[6999, 6000]',
              '[5999, 5000]',
              '[4999, 4000]',
              '[3999, 3000]',
              '[2999, 2000]',
              '[1999, 1000]',
              '[999, 0]'
            ],
            [
              '[999, 900]',
              '[899, 800]',
              '[799, 700]',
              '[699, 600]',
              '[599, 500]',
              '[499, 400]',
              '[399, 300]',
              '[299, 200]',
              '[199, 100]',
              '[99, 0]'
            ],
            [
              '[99, 90]',
              '[89, 80]',
              '[79, 70]',
              '[69, 60]',
              '[59, 50]',
              '[49, 40]',
              '[39, 30]',
              '[29, 20]',
              '[19, 10]',
              '[9, 0]'
            ]];

          // Go through view ranges
          for ( var i = 0; i < bucketsnms.length; i++ ) {

            var _bucket    = [];
            var _colorbucket = [];
            var _bucketnm  = bucketsnms[i];
            var _appr      = 0, _comment = 0;
            var _benchmark;
            var _benchcolors;

            var _benchcolors = {
                'red'    : [ ], 
                'orange' : [ ], 
                'yellow' : [ ], 
                'green'  : [ ], 
                'blue'   : [ ], 
                'indigo' : [ ], 
                'violet' : [ ],  
              };

            // Go through projects
            for ( var z = 0; z < _bucketnm.length; z++ ) {

              _bucketth     = typeof buckets[0][_bucketnm[z]] !== 'undefined' ? buckets[0][_bucketnm[z]] : false;
              _bucketlength = typeof buckets[0][_bucketnm[z]] !== 'undefined' ? buckets[0][_bucketnm[z]].length : 0;

              if ( !_bucketth ) continue;
              
              // Get average amount of comments and appreciations per range
              for ( var w = 0; w < _bucketth.length; w++ ) {

                _cproj = {
                  'views'         : _bucketth[ w ][ 'views' ],
                  'appreciations' : _bucketth[ w ][ 'appreciations' ],
                  'comments'      : _bucketth[ w ][ 'comments' ]
                }
                
                _appr    = _appr + _bucketth[ w ][ 'appreciations' ];
                _comment = _comment + _bucketth[ w ][ 'comments' ];
                _id      = _bucketth[ w ][ 'id' ];

                // console.log( _bucketth[ w ] );
                _benchmark = getBenchMarkColors( _projectsid , _id , _covers );

                for ( var color in _benchcolors ) {
                  if ( _benchmark && color == _benchmark[ 'closest' ][ 0 ] ) _benchcolors[ color ].push( _cproj );
                }

              }

              // for ( var color in _benchcolors ) {
              //   if ( _benchmark && _benchcolors[ color ] == _benchmark[ 'closest' ][ 0 ] ) console.log( _benchcolors[ color ] );
              // }

              _appr    = Math.round( _appr / _bucketlength );
              _comment = Math.round( _comment / _bucketlength );

              _colorbucket.push( { 
                'y' : _bucketnm[z] , 
                'a' : _bucketlength , 
                // 'b' : _appr , 
                // 'c' : _comment ,
                'red'    : _benchcolors[ 'red' ].length, 
                'orange' : _benchcolors[ 'orange' ].length, 
                'yellow' : _benchcolors[ 'yellow' ].length, 
                'green'  : _benchcolors[ 'green' ].length, 
                'blue'   : _benchcolors[ 'blue' ].length, 
                'indigo' : _benchcolors[ 'indigo' ].length, 
                'violet' : _benchcolors[ 'violet' ].length, 
              } )

              _bucket.push( { 
                'y' : _bucketnm[z] , 
                'a' : _bucketlength , 
                'b' : _appr , 
                'c' : _comment ,
                // 'red'    : _benchcolors[ 'red' ].length, 
                // 'orange' : _benchcolors[ 'orange' ].length, 
                // 'yellow' : _benchcolors[ 'yellow' ].length, 
                // 'green'  : _benchcolors[ 'green' ].length, 
                // 'blue'   : _benchcolors[ 'blue' ].length, 
                // 'indigo' : _benchcolors[ 'indigo' ].length, 
                // 'violet' : _benchcolors[ 'violet' ].length, 
              } );

            }

            // console.log( _benchcolors );

            _array = stringToArray( _bucketnm[ 0 ] );

            $main.append( '<h3><small>Number of projects \'Views\' in range sets between ' + _array[0] + ' and 0</small></h3><div id="area' + i + '"></div><br><br><br><br>' );

            Morris.Area({
              element         : 'area' + i,
              data            : _bucket,
              xkey            : 'y',
              ykeys           : [
                                  'a',
                                  'b',
                                  'c'
                                ],
              labels          : [
                                  'Number of projects with "Views" in X range',
                                  'Average number of project "Appreciations" in X range',
                                  'Average number of project "Comments" in X range'
                                ],
              parseTime       : false,
              fillOpacity     : 0.3,
              lineColors      : [ 
                                  spacegrayred,
                                  spacegraypurple,
                                  spacegrayblue
                                ],
              behaveLikeLine  : true
            });

            $main.append( '<div id="areacolor' + i + '"></div><br><br><br><br>' );

            Morris.Area({
              element         : 'areacolor' + i,
              data            : _colorbucket,
              xkey            : 'y',
              ykeys           : [
                                  'a',
                                  // 'b',
                                  // 'c',
                                  'red',
                                  'orange',
                                  'yellow',
                                  'green',
                                  'blue',
                                  'indigo',
                                  'violet'
                                ],
              labels          : [
                                  'Number of projects with "Views" in X range',
                                  // 'Average number of project "Appreciations" in X range',
                                  // 'Average number of project "Comments" in X range',
                                  'Number of projects that lean toward red',
                                  'Number of projects that lean toward orange',
                                  'Number of projects that lean toward yellow',
                                  'Number of projects that lean toward green',
                                  'Number of projects that lean toward blue',
                                  'Number of projects that lean toward indigo',
                                  'Number of projects that lean toward violet'
                                ],
              parseTime       : false,
              fillOpacity     : 0.0,
              lineColors      : [ 
                                  spacegraybgcolor ,
                                  // $.xcolor.opacity( spacegraybgcolor , 'lightgrey' , 0.8 ), 
                                  // $.xcolor.opacity( spacegraybgcolor , 'lightgrey' , 1 ),
                                  $.xcolor.opacity( rgbred    , 'lightgrey' , 0.6 ),    
                                  $.xcolor.opacity( rgborange , 'lightgrey' , 0.6 ),
                                  $.xcolor.opacity( rgbyellow , 'lightgrey' , 0.6 ),
                                  $.xcolor.opacity( rgbgreen  , 'lightgrey' , 0.6 ), 
                                  $.xcolor.opacity( rgbblue   , 'lightgrey' , 0.6 ),  
                                  $.xcolor.opacity( rgbindigo , 'lightgrey' , 0.6 ),
                                  $.xcolor.opacity( rgbviolet , 'lightgrey' , 0.6 )
                                ],
              pointFillColors : [ 
                                  spacegraybgcolor ,
                                  // $.xcolor.opacity( spacegraybgcolor , 'lightgrey' , 0.8 ), 
                                  // $.xcolor.opacity( spacegraybgcolor , 'lightgrey' , 1 ),
                                  $.xcolor.lighten( rgbred    ),    
                                  $.xcolor.lighten( rgborange ),
                                  $.xcolor.lighten( rgbyellow ),
                                  $.xcolor.lighten( rgbgreen  ), 
                                  $.xcolor.lighten( rgbblue   ),  
                                  $.xcolor.lighten( rgbindigo ),
                                  $.xcolor.lighten( rgbviolet )
                                ],
              behaveLikeLine  : true
            });

          }

          $( '#loading' ).remove();

        });

      }

    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = routes;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

/**
 *
 */
function getBenchMarkColors( _projectsid , _id , _covers ) {

  var _benchcolors = {
    'red'    : '#d10000',
    'orange' : '#ff6622',
    'yellow' : '#ffda21',
    'green'  : '#33dd00',
    'blue'   : '#1133cc',
    'indigo' : '#220066',
    'violet' : '#330044'
  };
  var _project, _image, _color, _hex, _distance = 1000, _closest;
 
  _id = String( _id );
  
  if ( typeof _projectsid[ "projects" ][ 0 ][ _id ] === 'undefined' ) return false;
  
  _project = _projectsid[ "projects" ][ 0 ][ _id ][ 0 ]; // find the image by using the id to search _projectsid
  _image   = _project[ "covers" ][ "202" ];
  _image   = _image.split( '/' );
  _image   = _image[ _image.length - 1 ];
  _color   = _covers[ _image ][ "freq" ]; // find the color by the image name

  if ( !_color ) return false;

  _hex = ( _color.length > 6 ) ? _color.slice( 0 , -2 ) : _color; // console.log( _hex );

  for ( var color in _benchcolors ) {

    if ( $.xcolor.distance( _benchcolors[ color ] , _hex ) < _distance ) {
      _distance = $.xcolor.distance( _benchcolors[ color ] , _hex );
      _closest  = _benchcolors[ color ];
      _color    = color;
      // console.log( _distance );
      // console.log( 'Closest Color: ' + color + ' ' + _closest );
    }

  }

  return { 'original' : _hex, 'closest' : [ _color , _closest ], 'distance' : _distance };

}

/**
 */
function stringToArray( _string ) {
  _array = _string.substring( 1 )
  _array = _array.substring( 0 , _array.length - 1 );
  _array = _array.replace( ' ' , '' );
  _array = _array.split( ',' );
  return _array;
}

/**
 */
function sortByKey( _array , _key ) {
  _array.sort( function( a , b ) { 
    return a[ _key ] - b[ _key ] ;
  } );
  return _array;
}

})(jQuery); // Fully reference jQuery after this point.
