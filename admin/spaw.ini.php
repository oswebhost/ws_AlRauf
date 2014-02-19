<?
include("spaw2/spaw.inc.php"); 

SpawConfig::setStaticConfigValue('default_height',$Height);
$spaw = new SpawEditor($CONTENT, $_content); 
if ($toolbar=="1"):
	$spaw->addToolbars("font","edit","format","insert","table"); 
else:
	$spaw->addToolbars("format","insert"); 
endif;

// must change dir = '/ /' according to server setting

$spaw->setConfigItem('PG_SPAWFM_DIRECTORIES',array(array('dir' => 'paw5/images/', 'caption' => 'Images','params' => array('allowed_filetypes' => array('images','flash','documents'))),),SPAW_CFG_TRANSFER_SECURE);


$spaw->show();
?>