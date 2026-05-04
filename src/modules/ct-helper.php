<?php 
namespace ct;

// Constants

define('CT_SHRT_SHOWTYPE', 'all');
define('CT_SHRT_CATEGORY', 'na');
define('CT_SHRT_STYLE', 'grid');
define('CT_SHRT_NUMCLIENTS', '-1');
define('CT_SHRT_NUMCOLUMNS', '3');


function ctGetCheckBoxVal($Value)
{
	if($Value == 'on')
	{
		return 1;
	}
	
	return 0;
}

function ctExplodeFields($Data)
{
    $Data = preg_replace('/\W/',' ', $Data);
    $Data = preg_replace('/\s+/', ' ', $Data);
    $Data = trim($Data);

    $Data = explode(' ', $Data);
    $Data = array_unique($Data);      

    return $Data;
}

function ctGetFormFieldsData($Data)
{
    $FieldData = array();
    $FieldInnData = array();

    foreach ($Data['name'] as $key => $value) 
    {
       $FieldInnData['name'] = $value;
       array_push($FieldData, $FieldInnData);
    }

    return json_encode($FieldData);
}

function ctGetInputFields($Fields)
{
    foreach ($Fields as $value) 
    {
        $field .= $value;
    }

    return $field;
}

function ctRedirectTo($url)
{
    if (headers_sent())
    {
      die('<script type="text/javascript">window.location.href="' . $url . '";</script>');
    }
    else
    {
      header('Location: ' . $url);
      die();
    }    
}

function ctRedirectBack()
{
    return die('<script type="text/javascript">history.go(-1);</script>');      
}

function addhttp($url) 
{
    if($url == '#')
    {
        return $url;
    }

    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) 
    {
        $url = "http://" . $url;
    }
    
    return $url;
}

function getClientCatList($SetValue = null)
{
    $Categories = CTData::getCategories();
    ?>
    <select name="category">
      <option value="na">No Specific</option>  
    <?php
    if(is_array($Categories))
    {
        foreach ($Categories as $key => $value) 
        {
            ?>
            <option value="<?php echo $key;?>" <?php selected( $SetValue , $key, true);?>><?php echo $value; ?></option>
            <?php
        }
    }
    ?>
</select>
<?php
}

?>