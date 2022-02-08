<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('Minify_Html'))
{
    function Minify_Html($Html)
    {
       $Search = array(
        '/(\n|^)(\x20+|\t)/',
        '/(\n|^)\/\/(.*?)(\n|$)/',
        '/\n/',
        //'/\<\!--.*?-->/',
        '/(\x20+|\t)/', # Delete multispace (Without \n)
        '/\>\s+\</', # strip whitespaces between tags
        '/(\"|\')\s+\>/', # strip whitespaces between quotation ("') and end tags
        '/=\s+(\"|\')/'); # strip whitespaces between = "'

       $Replace = array(
        "\n",
        "\n",
        " ",
        //"",
        " ",
        "><",
        "$1>",
        "=$1");

    $Html = preg_replace($Search,$Replace,$Html);
    return $Html;
    }
}

if(!function_exists('get_argv'))
{
    function get_argv()
    {
        return $_SERVER['argv'];
    }
}

if(!function_exists('ping'))
{
    function ping()
    {
        $do = '';

        $count = 0;

        echo "\r\n[\033[32mping\033[39m] ==> ";

        do {            

            $count++;

            echo ".";

            sleep(1);   

            $do = exec("ping -n 1 www.google.com");                 

        } while (strpos($do,"Average") <= 0);

        echo "online!\r\n";

        sleep(1);
    }
}


if(!function_exists('title_maker'))
{
    function title_maker($t)
    {
        $pre_t = strtolower($t);
        $pre_t = trim($pre_t);

        $prepend_arr    = array("cool","awasome","the best","famous","review of","list of","incredible");

        $arr1 = array_filter($prepend_arr, function($row) use ($pre_t) {
            return (substr_count($pre_t, $row) <= 0);
        });

        $k1    = array_rand($arr1);
        $front   = $arr1[$k1];

        $append_arr    = array("references","ideas",date('Y'));

        $arr2 = array_filter($append_arr, function($row) use ($pre_t) {
            return (substr_count($pre_t, $row) <= 0);
        });

        $k2    = array_rand($arr2);
        $back   = $arr2[$k2];
        
        //$t = "{$front} {$t} {$back}";
        $t = "{$t} {$back}";

        return ucwords($t);
    }
}

if(!function_exists('rand_num'))
{
    function rand_num()
    {
        $rand       = mt_rand(111111,9999999);
        return $rand;
    }
}

if(!function_exists('delete_0kb'))
{
    function delete_0kb($d='compiled')
    {
        foreach (glob("gudang/{$d}/*", GLOB_ONLYDIR) as $dir)
        {
            $path   = "{$dir}/{$niche}";
            $ext    = ($d === 'compiled')?'.srz.php':'.json';
            $p_arr  = glob("{$path}*{$ext}");

            echo "\r\n[\033[32mDIR\033[39m] ==> {$path}\r\n"; 

            if(!$p_arr){continue;}

            foreach ($p_arr as $key => $file)
            { 
                if(filesize($file) < 1000)
                {
                    echo "\r\n[\033[31mDELETE\033[39m] ==> {$file}\r\n"; 
                    unlink($file);
                }
            }

        }
    }
}

?>