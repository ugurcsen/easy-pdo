<?php

class EasyPDO_Table
{
    private $db;
    private $name  = NULL;
    public  $cols  = NULL;

    function __construct($DataBase,$table)
    {
        $this->db   = $DataBase;
        $this->name = $table;
    }

    public function all(){
        return $this->db->query("SELECT * FROM `".$this->name."` ")->fetch();
    }

    public function select($where=null,$vals=null){
        $cols = '*';
        if ($this->cols != NULL) {
            $cols = '';
            $comma = '';
            foreach ($this->cols as $cols2) {
                $cols .= '`' . $cols2 . '`' . $comma;
                $comma = ',';
            }
        }
        if (where != NULL) {
            $where = ' WHERE ' . $this->where;
        }
        if($vals!=null){
            $d = $this->db-prepare("SELECT " . $cols . " FROM `" . $this->name . "`" . $where);
            $r = $d->execute($vals);
        }
        else{
            $r = $this->db->query("SELECT " . $cols . " FROM `" . $this->name . "`" . $where);
        }
        return $r;
    }

    public function insert($cols,$vals,$security=false){
        if($security) {
            $comma='';
            $colsText='';
            $valLoc = '';
            foreach ($cols as $cols2) {
                $colsText .= '`' . $cols2 . '`' . $comma;
                $valLoc .= '?' . $comma;
                $comma = ',';
            }
            $d = $this->db->prepare("INSERT INTO " . $this->name . "(" . $colsText . ") VALUES(" . $valLoc . ")");
            $r = $d->execute($vals);
        }
        else{
            $comma='';
            $colsText='';
            $valsText='';
            $i=0;
            foreach ($cols as $cols2) {
                $colsText .= '`' . $cols2 . '`' . $comma;
                $valsText .= '"'.$vals[$i].'"'.$comma;
                $i++;
                $comma = ',';
            }
            $r = $this->db->query("INSERT INTO " . $this->name . "(" . $colsText . ") VALUES(" . $valsText . ")");
        }
        return $r;
    }

    public function delete($where=null,$vals=null){
        if (where != NULL) {
            $where = ' WHERE ' . $this->where;
        }
        if($vals!=null){
            $d = $this->db-prepare("DELETE FROM `" . $this->name . "`" . $where);
            $r = $d->execute($vals);
        }
        else{
            $r = $this->db->query("DELETE FROM `" . $this->name . "`" . $where);
        }
        return $r;
    }

    public function update($where=null,$cols,$vals,$security=false){
        if (where != NULL) {
            $where = ' WHERE ' . $this->where;
        }
        if($security) {
            $comma='';
            $colsText='';
            foreach ($cols as $cols2) {
                $colsText .= '`' . $cols2 . '`=?' . $comma;
                $comma = ',';
            }
            $d = $this->db->prepare("UPDATE " . $this->name . " SET " . $colsText . $where);
            $r = $d->execute($vals);
        }
        else{
            $comma='';
            $colsText='';
            $i=0;
            foreach ($cols as $cols2) {
                $colsText .= "`" . $cols2 . "`='" . $vals[$i] . "'" . $comma;
                $i++;
                $comma = ',';
            }
            $r = $this->db->query("UPDATE " . $this->name . " SET " . $colsText . $where);
        }
        return $r;
    }

    /*
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
    */
}