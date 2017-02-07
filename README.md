# MuseumProject

This project has for goal to get the informations of a specific museum with his address, number phone, city from a database that we have found on <a href="https://www.data.gouv.fr/fr/datasets/liste-et-localisation-des-musees-de-france/">there</a>. 

The file from <a href="http://gouv.fr">gouv.fr</a> is made in the XLSX format and reconverted into CSV with <a href="https://convertio.co/fr/">Convertio</a>.

<strong>Note:</strong> Please read the "<a href="#important">important</a>" part before doing any actions with this project.
<h1>Setup</h1>
You don't know where to start ? No problem, we are here for it.

You may have to edit the <strong>index.php</strong> and <strong>search.php</strong> files for the database connection with your informations which are located on the main foler and run it on your browser.
```
$db = new Connection("localhost", "root", "", "musees");
```
<strong>localhost</strong>: Your host name <br />
<strong>root </strong>: Your username<br />
<strong>blank space </strong>: Your password<br />
<strong>musees </strong>: Your main database

<h1>Features</h1>
We have added some options on search.php to search depending on:
<ul>
  <li>The city</li>
  <li>The museum name (if you don't click the checkbox)</li>
  <li>The department</li>
  <li>Postal code</li>
</ul>

<h1>Technologies</h1>
We are using these technologies :
<ul>
  <li><a href="http://materializecss.com/">Material Design</a></li>
  <li><a href="http://php.net">PHP</a></li>
  <li><a href="https://jquery.com/">JQuery</a></li>
  <li><a href="https://developers.google.com/maps/?hl=fr">Google Map API</a></li>
  <li><a href="http://tilotiti.github.io/jQuery-Google-Map/">Google Map JQuery (Embed map)</a></li>
</ul>

<h1 id="important">Important...</h1>

All files needed are uploaded on this Github. (Even the .sql ^_^)

The current SQL is not fully updated (last update: 2015) with new regions/departments/museum name so feel free to update and do a pull request on there.

About the registered images in the database; It may be under <a href="https://en.wikipedia.org/wiki/Copyright">COPYRIGHT</a> so be careful if you are going to use it on a server. And of course, we are <span style="color:#ff0000;font-weight: bold;">NOT</span> responsible for future actions.

<em>"Did you get the images from Google?" - Yes, we got the images from <a href="http://google.com">Google</a> for testing purpose.</em>

<h1>Questions? Issues? Bugs?</h1>

If you have any questions or issues, feel free to open a new issue on the top.
