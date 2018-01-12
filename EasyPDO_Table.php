<?php

namespace easypdo\EasyPDO_Table;

class EasyPDO_Table
{
    private $db;
    public $name  = NULL;
    public $cols  = NULL;
    public $limit = NULL;
    public $where = NULL;

    function __construct($DataBase)
    {
        $this->db = $DataBase;
    }

    public function totalPage(){

        if($this->where!=NULL){
            $where = 'WHERE '.$this->where;
        }
        else{
            $where = '';
        }

        if($this->limit!=NULL){
            $limit = $this->limit;
        }
        else{
            $limit = 0;
        }

        $data = $this->db->query("SELECT COUNT(*) as `totaldata` FROM `'.$this->name.'` ".$where)->fetch(PDO::FETCH_ASSOC);

        return ceil($data['totaldata']/$limit);

    }

    public function getPage($page){

        $colText = '';
        foreach ($this->cols as $data) {
            $colText = $colText . '`' . $data . '`';
        }

    }

    public function getData(){

        $colText = '';
        foreach ($this->cols as $data) {
            $colText = $colText . '`' . $data . '`';
        }

    }

    public function getConst(){

        if($this->where!=NULL){
            $where = 'WHERE '.$this->where;
        }
        else{
            $where = '';
        }

        $data = $this->db->query("SELECT COUNT(*) as `totaldata` FROM `'.$this->name.'` ".$where)->fetch(PDO::FETCH_ASSOC);

        return $data['totaldata'];// burada kaldım örenk veritabanı bulup denemeliyim

    }

    public function create(){

    }

    public function delete(){

    }

    public function update(){

    }

    public function query(){

    }

    public function yaz(){
        echo 'hello world';
    }
}