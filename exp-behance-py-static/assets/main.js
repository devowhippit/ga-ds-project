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

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var routes = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages
      var _data;

      $.getJSON( "assets/hist_memory.json", function( _data ) { 
        
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
          ]
        ];

        // Go through view ranges
        for ( var i = 0; i < bucketsnms.length; i++ ) {

          var _bucket   = [];
          var _bucketnm = bucketsnms[i];
          var _appr = 0, _comment = 0;

          // Go through projects
          for ( var z = 0; z < _bucketnm.length; z++ ) {

            _bucketth     = typeof buckets[0][_bucketnm[z]] !== 'undefined' ? buckets[0][_bucketnm[z]] : false;
            _bucketlength = typeof buckets[0][_bucketnm[z]] !== 'undefined' ? buckets[0][_bucketnm[z]].length : 0;
            

            if ( !_bucketth ) continue;
            
            // Get average amount of comments and appreciations per range
            for ( var w = 0; w < _bucketth.length; w++ ) {
              _appr    = _appr + _bucketth[ w ][ 'appreciations' ];
              _comment = _comment + _bucketth[ w ][ 'comments' ];
            }

            _appr    =  Math.round( _appr / _bucketlength );
            _comment =  Math.round( _comment / _bucketlength );

            _bucket.push( { 'y' : _bucketnm[z] , 'a' : _bucketlength , 'b' : _appr , 'c' : _comment } );

          }

          _array = stringToArray( _bucketnm[ 0 ] );

          $( '#main' ).append( '<h3><small>Number of projects \'Views\' in range sets between ' + _array[0] + ' and 0</small></h3><div id="area' + i + '"></div><br><br><br><br>' );

          Morris.Area({
            element        : 'area' + i,
            data           : _bucket,
            xkey           : 'y',
            ykeys          : ['a','b','c'],
            labels         : [
                                'Number of projects with "Views" in X range',
                                'Average number of project "Appreciations" in X range',
                                'Average number of project "Comments" in X range'
                             ],
            parseTime      : false,
            fillOpacity    : 0.5,
            lineColors     : [ spacegrayred , spacegrayblue , spacegraypurple ],
            behaveLikeLine : true//,
            // hoverCallback  : function ( index , options , content ) 
            //                 {
            //                   var row = options.data[ index ];
            //                   _array = stringToArray( row.y );
            //                   return row.a + ' projects fall between ' + _array[0] + ' and ' + _array[1] + ' views.';
            //                 }
          });

        }

      });

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
 */
function stringToArray( _string ) {
  _array = _string.substring( 1 )
  _array = _array.substring( 0 , _array.length - 1 );
  _array = _array.replace( ' ' , '' );
  _array = _array.split( ',' );
  return _array;
}

})(jQuery); // Fully reference jQuery after this point.
