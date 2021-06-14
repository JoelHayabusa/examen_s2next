<?php
class HomeModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }
    public function setMenu(string $nombre, string $descripcion, int $idPadre)
    {
       // $query_insert = "INSERT INTO cat_menu (nombre, descripcion, fch_modificacion, fch_creacion, id_menu_padre) VALUES (?,?,NOW(),NOW(),?)";
        if($idPadre!==0){
            $query_insert = "INSERT INTO cat_menu (nombre, descripcion, fch_modificacion, fch_creacion, id_menu_padre) VALUES (?,?,NOW(),NOW(),?)";
            $arrData = array($nombre, $descripcion, $idPadre);
        }else{
            $query_insert = "INSERT INTO cat_menu (nombre, descripcion, fch_modificacion, fch_creacion) VALUES (?,?,NOW(),NOW())";
            $arrData = array($nombre, $descripcion);
        }
        $reques_insert = $this->insert($query_insert, $arrData);
        return $reques_insert;
    }
    public function  updateMenu(int $id, string $nombre ,string $descripcion, int $idPadre)
    {
        if($idPadre!==0){
            $query_update = "UPDATE cat_menu SET nombre = ?, descripcion = ?, fch_modificacion = NOW(), id_menu_padre = ? WHERE id=?";
            $arrData = array($nombre, $descripcion, $idPadre, $id );
        }else{
            $query_update = "UPDATE cat_menu SET nombre = ?, descripcion = ?, fch_modificacion = NOW(),id_menu_padre = NULL WHERE id=?";
            $arrData = array($nombre, $descripcion, $id);
        }
        
        $request = $this->update($query_update, $arrData);
        return $request;
    }
    public function deleteMenu(int $id)
    {
        $query_delete = "DELETE FROM cat_menu WHERE id=?";
        $arrData = array($id);
        $request = $this->delete($query_delete, $arrData);
        return $request;
    }
    public function getMenusList()
    {
        $query = "SELECT cat.id, cat.nombre, cat.descripcion, cat.fch_modificacion, cat_menu.nombre as nombrePadre  FROM cat_menu RIGHT JOIN  cat_menu as cat ON cat_menu.Id = cat.id_menu_padre;";
        $request = $this->select_all($query);
        return $request;
    }
    public function getMenu(int $idMenu)
    {
        $query = "SELECT * FROM cat_menu WHERE id=".$idMenu;
        $request = $this->select_all($query);
        return $request;
    }
}   
?>