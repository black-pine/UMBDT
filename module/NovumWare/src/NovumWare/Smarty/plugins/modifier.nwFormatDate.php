<?php
function smarty_modifier_nwFormatDate($mysqlDate)
{
	$phpDate = \NovumWare\NovumWareHelpers::dateMysqlToPHP($mysqlDate);
	return \NovumWare\NovumWareHelpers::formatPHPDate($phpDate);
}
?>
