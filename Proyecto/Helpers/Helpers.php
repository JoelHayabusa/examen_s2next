<?php 
    //Regresa la url principal del proyecto
    function base_url()
    {
        return BASE_URL;
    }
    //Muestra array con formato
    function dep($data)
    {
        $format = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('</pre>');
        return $format;
    }
    function getMainModule(string $name_module, $data)
    {
        $main_module = "Views/Main/{$name_module}.php";
        require_once $main_module;
    }
    //Importa las ventanas modales usando su nombre
    function getModal(string $nameModal, $data){
        $view_modal = "Views/Modals/{$nameModal}.php";
        require_once $view_modal;
    }
    //Limpia cadenas para evitar inyección sql y datos con espacios innecesarios
    function strClean($strCadena)
    {
        $str = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
        $str = trim($str);
        $str = stripcslashes($str);
        $str = str_ireplace("<script>", "", $str);
        $str = str_ireplace("</script>", "", $str);
        $str = str_ireplace("<script src>", "", $str);
        $str = str_ireplace("<script type=>", "", $str);
        $str = str_ireplace("SELECT * FROM", "", $str);
        $str = str_ireplace("SELECT COUNT(*) FROM", "", $str);
        $str = str_ireplace("DELETE FROM", "", $str);
        $str = str_ireplace("INSERT INTO", "", $str);
        $str = str_ireplace("DROP TABLE", "", $str);
        $str = str_ireplace("OR '1' = '1'", "", $str);
        $str = str_ireplace("OR ´1´ = ´1´", "", $str);
        $str = str_ireplace('OR "1" = "1"', "", $str);
        $str = str_ireplace('LIKE "', "", $str);
        $str = str_ireplace("LIKE '", "", $str);
        $str = str_ireplace("LIKE ´", "", $str);
        $str = str_ireplace("OR 'a' = 'a'", "", $str);
        $str = str_ireplace("OR ´a´ = ´a´", "", $str);
        $str = str_ireplace('OR "a" = "a"', "", $str);
        $str = str_ireplace('--', "", $str);
        $str = str_ireplace('[', "", $str);
        $str = str_ireplace(']', "", $str);
        $str = str_ireplace('^', "", $str);
        $str = str_ireplace('==', "", $str);
        return $str;
        

    }
?>