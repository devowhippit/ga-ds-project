ga-ds-project
=============

Behance.net Image Analysis Project

Objective: What can image analysis tell us about Design?
-------------------------------------------------------- 

Using technology as a medium for design presents innovative features for predictive analysis such as usability tests and social media metrics. Often, one can judge the effectiveness and longevity of a design by reading these metrics. However, by looking at a crucial element of design, color theory, perhaps we can we can utilize a less tested metric for considering a design. What can color theory reveal about design effectiveness and longevity? Perhaps by observing, measuring, and categorizing color in relation to other metrics we can predict trends and make different kinds of meaningful insights about design.

### Getting the Data

The data is collected from the Social/Professional Creative network [Behance.net][1]. [Through the developer API][2] I gathered sets of images for for projects based on the following query parameters;

`
Sort :            Featured Date
Time :            All, Month, Day
Creative Fields : Graphic Design
`

I did three separate queries for time; All, month, and day, to get a variance of time ranges. Additionally, I did one query representing a major color in the ROYGBIV color spectrum. The color range parameter buffered the search and collected projects around the major color. 

`
Color Values : d10000, ff6622, ffda21, 33dd00, 1133cc, 220066, 330044
Color Range :  20
`

In all, I had 11 different queries. I made about 30 calls per query which gave me a total of 4,000 projects to analyze. I created a page to view the results and do some basic plotting of what I had collected. After examining the data I formulated the following questions to try to answer with the data;

* ### Is there a correlation between high project views and thumbnail content?
* ### Is there a predictive curve for appreciations and comments based on the thumbnail content?

### Plotting Views against appreciations, comments, and colors.

[1]: https://www.behance.net/                                                                      "Behance.net"
[2]: https://www.behance.net/dev                                                                   "Behance Developer API"
[3]: http://www.oesmith.co.uk/morris.js/index.html                                                 "Morris.js"
[4]: http://www.xarg.org/project/jquery-color-plugin-xcolor/                                       "jQuery color plugin xcolor"
[5]: https://chrome.google.com/webstore/detail/jsonview/chklaanhfefbnpoihckbnefhakgolnmc?hl=en     "Chrome JSONView"
[6]: http://flask.pocoo.org/                                                                       "Flask Python Framework"
[7]: http://stackoverflow.com/questions/3241929/python-find-dominant-most-common-color-in-an-image "Extracting Image Clusters Using PIL and Scipy's cluster package."