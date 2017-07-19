

// I'm sure that when you get the library, there will be other options for animating
var deg = 0;
function rotateSVG(element)
{
  deg = deg + 22.5;
  jQuery(element).css({'transform': 'rotate(' + deg + 'deg)'});
}

// When the whole document loads
jQuery(document).ready(function(){

  // Add a show listener to do some kind of animation when the SVG comes into view
  // This may or may not be the process with Livicons
  jQuery('.lievo-svg-wrapper img').show('fast',function(){
    rotateSVG(jQuery(this));
  });

  // Target every image inside the CSS class lievo-svg-wrapper and add a hover listener
  jQuery('.lievo-svg-wrapper img').hover(function(){
    rotateSVG(jQuery(this));
  });

  // Make the call to Google Sheets
  // More information http://api.jquery.com/jquery.ajax/
  var sheet_url = "https://spreadsheets.google.com/feeds/list/1KouqYG9ba3B29q6sMPlrwQz5kEkjiSSYQ73wy9-SY0k/od6/public/values?alt=json";
  var request = jQuery.ajax({
    dataType:"json",
    url: sheet_url,
    type: "GET"
  }).done(function(e){
    if (e.hasOwnProperty('feed') && e.feed.hasOwnProperty('entry'))
    {
      // e.feed.entry is an array of objects
      // we are accessing one less than the length of the array to get the last row
      var last_row = e.feed.entry[e.feed.entry.length -1];
      if (last_row.hasOwnProperty('content') && last_row.content.hasOwnProperty('$t'))
      {
        jQuery('#building-space-committed-number').text(parseInt(last_row.gsx$buildingspacecommittedtoenergyefficiency.$t).toLocaleString());
        jQuery('#member-number').text(parseInt(last_row.gsx$ofmembers.$t).toLocaleString());
        jQuery('#people-educated-number').text(parseInt(last_row.gsx$peopleeducated.$t).toLocaleString());
        jQuery('#solar-built-number').text(parseInt(last_row.gsx$solarbuiltkw.$t).toLocaleString());
      }
    }
  });
});
