
<?php

///    NUEVO ARCHIVO UPLOAD.PHP
echo '<pre>';
$img = $_FILES['img'];

if(!empty($img))
{
    $img_desc = reArrayFiles($img);
    // print_r($img_desc);

    foreach($img_desc as $val)
    {
        $newname = 'nery_'.mt_rand().'.jpg';
        echo $newname ."<br>";
        move_uploaded_file($val['tmp_name'],'./almacen_digital/'.$newname);
    }
}

function reArrayFiles($file)
{
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);

    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}

?>
