<?php

    /*
        Simplify getting videos from lefresnoy's channel
        Cache VIMEO from the web

        param
        uri
        paging
        page
    */



    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);


    $uri = isset($_POST['uri']) ? $_POST['uri'] : ""; // "/me/videos/";
    $paging = isset($_POST['paging']) ? $_POST['paging'] : 1;
    $paging = intval($paging);

    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $page = intval($page);


    require_once '../../config.php';
    require '../../vendor/autoload.php';

    use Vimeo\Vimeo;


    function vimeo_connection($client_id, $client_secret, $access_token){


        $client = new Vimeo($client_id, $client_secret, $access_token);

        return $client;
    }

    function get_or_create_temp_file($client, $uri, $arg = []){


        $str_arg=implode(" ",$arg);
        $file_name = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $uri.$str_arg)));
        $file_path = "../../data/".$file_name.".json";
        $file_exist = file_exists($file_path);

        if(!$file_exist) {
            $req = $client->request($uri, $arg, "GET");

            // no save file if quota exceded
            if ($req->status != 429){

              file_put_contents($file_path, json_encode($req));

            }

        }
        else{
            $req = file_get_contents($file_path);
            $req = json_decode($req, true);

            // delete file if quota exceded (old version file)
            if ($req["status"] == 429){

              unlink($file_path);

            }


        }


        return $req;

    }

    $client = vimeo_connection($client_id, $client_secret, $access_token);

    $arg = ['per_page' => $paging, 'page' => $page];

    $req = get_or_create_temp_file($client, $uri, $arg);

    echo json_encode($req);

?>
