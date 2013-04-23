function trim(str) {
	'use strict';
	str = str.replace(/^\s\s*/, '');
	var ws = /\s/,
		 i = str.length;
	while (ws.test(str.charAt(--i))) {}
	return str.slice(0, i + 1);
}