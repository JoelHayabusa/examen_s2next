<?php
class Menu extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }
    public function Menu($params)
    {
        $data['tag_page']="Home";
        $data['tag_title']="Examen S2Next";
        $data['tag_Name']="Examen S2Next";
        $this->views->getView($this, "Menu", $data);
    }
}
?>