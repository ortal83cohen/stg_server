<a></a>
<?php

/**
 * Created by PhpStorm.
 * User: ortal
 * Date: 2/7/2016
 */
class ViewStgHome extends ViewStg
{

    public function display()
    {

        echo "<br><br>";

        echo "


<form action=\"records\" method=\"po\">
  lang:<br>
  <input type=\"text\" name=\"lang\" value=\"en\">
  <br>
  lat:<br>
  <input type=\"text\" name=\"lat\" value=\"32.104016\">
  <br>
  lon:<br>
  <input type=\"text\" name=\"lon\" value=\"34.877146\">
  <br>
    <input type=\"submit\" value=\"Submit\">
</form>

";
    }

}
