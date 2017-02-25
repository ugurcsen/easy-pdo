<?php $db=new PDO(
"mysql:host=localhost;
dbname=tl;
charset=utf8;
","root","");
/************************************************************\
*
\************************************************************/
function query($sorgu,$deger=array(),$db="")
{
    if($db=="")
    {
        global $db;
    }
    if(empty($deger))
    {
        $koruma=false;
    }
    else
    {
        $koruma=true;
    }
    if($koruma)
    {
        switch(substr($sorgu,0,6))
        {
            case "SELECT":$d = $db->prepare($sorgu);
            $d->execute($deger);
            return $d;
            break;
            default:$d=$db->prepare($sorgu);
            $r=$d->execute($deger);
            return $r;
            break;
        }
    }
    else
    {
        switch(substr($sorgu,0,6))
        {
            case "SELECT":$d=$db->query($sorgu);
            return $d;
            break;
            default:$d=$db->exec($sorgu);
            return $d;
            break;
        }
    }
}
?>