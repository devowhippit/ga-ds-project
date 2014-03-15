ga-ds-project
=============

Behance.net Image Analysis Project

What can image analysis tell us about Design?
---------------------------------------------

Using technology as a medium for design presents innovative features for predictive analysis such as usability tests and social media metrics. Often, one can judge the effectiveness and longevity of a design by reading these metrics. However, by looking at design principles, such as color theory, perhaps we can we can discover something for considering good design. What can color theory reveal about design effectiveness and longevity? Perhaps by observing, measuring, and categorizing color in relation to other metrics we can predict trends and make different kinds of meaningful insights about design.

### Getting the Data

The data is collected from the Social/Professional Creative network [Behance.net][1]. [Through the developer API][2] I gathered sets of images for for projects based on the following query parameters;

* `Sort            : Featured Date`
* `Time            : All, Month, Day`
* `Creative Fields : Graphic Design`

I did three separate queries for time; All, month, and day, to get a variance of time ranges. Additionally, I did one query representing a major color in the ROYGBIV color spectrum. The color range parameter buffered the search and collected projects around the major color. 

* `Color Values : d10000, ff6622, ffda21, 33dd00, 1133cc, 220066, 330044`
* `Color Range  : 20`

![Results of the Query Analysis][queryresult]
![Thumbnail of Collected Projects][projects]

In all, there were 11 different queries with about 30 calls per query resulting in a total of 4,000 projects to analyze. [Here is a page to view the results][9] with some basic plotting of the stats in each collection. After examining the data I formulated the following questions to try to answer with the data;

* Is there a correlation between high project views and thumbnail content?
* Is there a predictive curve for appreciations and comments based on the thumbnail content?

### Plotting Views against appreciations, comments, and colors.

In order to try and answer some of these questions I wanted to look at the project stats overall and compare it to the color features that were collected. The data was cached in .json files locally width each query having it's own file so a lot of time was spent combining and organizing the data in a way that was more easily digestable by the plotting scripts.

![Project Stats Comparison][projectsbyviews]

What was found by plotting the stats of each project made sense; projects with a large amount of views also have the largest average of 'appreciations' and 'comments.'

### Color Analysis

In order to compare color features I wanted to disect the images gathered and find out the most frequent colors used in each image. Using a [K-Means Clustering technique][7], I was able to build a dataset that extracted the five most frequent colors in each project cover photo. 

![Color Distribution][colordistribution]

With the colors gathered, the same project stats data as before against their corresponding color data.

![Project Stats Comparison][projectsbyviews]
![Project Stats Comparison by Colors][projectsbycolors]

### Tools

* Dataset: [Behance Developer API][2]
* Plotting Library: [Morris.js][3]
* Demo Color Picker: [Farbtastic Color Picker][6]
* JSON Visualiser: [Chrome JSONView][5]
* Python Framework: [Flask][6]
* K-Means Clustering Technique: [PIL and Scipy's Cluster Package][7]
* Javascript Color Manipulator: [xcolor][4]

[1]: https://www.behance.net/                                                                      "Behance.net"
[2]: https://www.behance.net/dev                                                                   "Behance Developer API"
[3]: http://www.oesmith.co.uk/morris.js/index.html                                                 "Morris.js"
[4]: http://www.xarg.org/project/jquery-color-plugin-xcolor/                                       "jQuery color plugin xcolor"
[5]: https://chrome.google.com/webstore/detail/jsonview/chklaanhfefbnpoihckbnefhakgolnmc?hl=en     "Chrome JSONView"
[6]: http://flask.pocoo.org/                                                                       "Flask Python Framework"
[7]: http://stackoverflow.com/questions/3241929/python-find-dominant-most-common-color-in-an-image "Extracting Image Clusters Using PIL and Scipy's cluster package."
[8]: http://acko.net/blog/farbtastic-jquery-color-picker-plug-in/                                  "Farbtastic Color Picker"
[9]: http://expbehance.devonhirth.com/                                                             "Behance Data Collection Results"

[queryresult]: queryresult.png                   "Results of the Query Analysis"
[projects]: projects.png                         "Thumbnail of Collected Projects"
[projectcoloranalysis]: projectcoloranalysis.png "Project Color Analysis"
[projectsbycolors]: projectsbycolors.png         "Project Stats Comparison by Colors"
[projectsbyviews]: projectsbyviews.png           "Project Stats Comparison"
[colordistribution]: colordistribution.png       "Color Distribution"
