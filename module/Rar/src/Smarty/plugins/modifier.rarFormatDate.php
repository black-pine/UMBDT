<?php
function smarty_modifier_rarFormatDate($date) {
	return \NovumWare\NovumWareHelpers::formatPHPDate($date, 'D H:i');
}