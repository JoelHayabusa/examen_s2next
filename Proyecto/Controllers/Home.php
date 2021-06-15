<?php
    class Home extends Controllers
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function home($params)
        {
            $data['tag_page']="Home";
            $data['tag_title']="Examen S2Next";
            $data['tag_Name']="Examen S2Next";
            //$data['tag_page']="Home";
            $this->views->getView($this, "home", $data);
        }
        public function listar_menus(){
            $arrData = $this->model->getMenusList();
            for ($i=0; $i <count($arrData) ; $i++) { 
                $arrData[$i]['opciones']='<div class="text-center">
                <button class="btn btn-primary btn-sm btnEditMenu" rl="'.$arrData[$i]['id'].'" title="Editar"><i class="fas fa-pencil-alt"></i></button>
                <button class="btn btn-danger btn-sm btnDelMenu" rl="'.$arrData[$i]['id'].'" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                </div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function get_menu(int $idMenu){
            $intIdMenu = intval(strClean($idMenu));
            if($intIdMenu>0){
                $arrData = $this->model->getMenu($intIdMenu);
                if(empty($arrData)){
                    $arrResponse = array('status'=>false, 'msg'=>'Datos No Encontrados');
                }else{
                    $arrResponse = array('status'=>true, 'data'=>$arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();

        }
        public function listar_padres()
        {
            $arrData = $this->model->getPadres();
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function setMenu()
        {
            $strMenuNombre = strClean($_POST['strNombre']);
            $strDescripcion = strClean($_POST['strDescripcion']);
            $strPadre = intval($_POST['idPadre']);
            $idMenu = intval($_POST['idMenu']);
            if($idMenu==-1)
            {   
                $data = $this->model->setMenu($strMenuNombre,$strDescripcion,$strPadre);
            }else{
                $data = $this->model->updateMenu($idMenu,$strMenuNombre,$strDescripcion,$strPadre);
            }
            
            if($data > 0){
                $arrResponse = array ('status'=>true,'msg'=>'Datos Guardados');
            }else{
                $arrResponse = array ('status'=>false,'msg'=>'Los datos No se guardaron');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
            
        }
        public function delMenu()
        {
            $idMenu = intval($_POST['idMenu']);
            $data = $this->model->deleteMenu($idMenu);
            if($data > 0){
                $arrResponse = array ('status'=>true,'msg'=>'Datos Eliminados' );
            }else{
                $arrResponse = array ('status'=>false,'msg'=>'Los datos No se eliminaron' );
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
            
        }
    }

?>
