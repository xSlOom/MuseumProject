<?php

class Functions {

    public function getFourMusees() {
        global $db;
        $query  = $db->pdo->query("SELECT * FROM musee ORDER BY  rand() LIMIT 0,4");
        $fetch  = $query->fetchAll();
        return $fetch;
    }

    public function text2Link($string) {
        if (substr($string, 0, 3) == "www") {
            $string = "http://{$string}";
        }
        $reg  = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $string);
        return $reg;
    }

    public function searchByDep($string) {
        global $db;
        $query  = $db->pdo->query("SELECT * FROM musee WHERE nom_dep LIKE '%{$string}%'");
        $fetch  = $query->fetchAll();
        return $fetch;
    }

    public function searchByCdp($string) {
        global $db;
        $array  = [];
        $query  = $db->pdo->query("SELECT * FROM musee;");
        $fetch  = $query->fetchAll();
        for ($i = 0; $i < sizeof($fetch); $i++) {
            if (substr($fetch[$i]["cp"], 0, 2) == substr($string, 0, 2)) {
                array_push($array, $fetch[$i]);
            }
        }
        return $array;
    }

    public function searchAll($string) {
        global $db;
        $query  = $db->pdo->query("SELECT * FROM musee WHERE nom_du_musee LIKE '%{$string}%'");
        $fetch  = $query->fetchAll();
        return $fetch;
    }
}
