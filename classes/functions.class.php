<?php

class Functions {

    public function getFourMusees() {
        global $db;
        $query  = $db->pdo->query("SELECT * FROM musee ORDER BY id desc LIMIT 0,4");
        $fetch  = $query->fetchAll();
        return $fetch;
    }

    public function getImage($musee) {
        include_once("html/simple_html_dom.php");
        $html = file_get_html('https://www.google.fr/search?q=' . urlencode($musee) . '&biw=1366&bih=659&source=lnms&tbm=isch&sa=X&ved=0ahUKEwjg5829t_vRAhWLwBQKHWKMAfIQ_AUIBygC');
        $image = $html->find('img', 0)->src;
        echo '<img src="' . $image . '" style="float: right;" />';
    }

    public function text2Link($string) {
        if (substr($string, 0, 4) == "www") {
            $string = "http://{$reg}";
        }
        $reg  = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $string);
        return $reg;
    }
}
