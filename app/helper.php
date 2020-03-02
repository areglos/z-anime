<?php


if (! function_exists('str_limit')) {
    function str_limit($value, $limit = 50, $end = '...') {
        return Str::limit($value, $limit, $end);
    }
}

if (! function_exists('get_drive_id')) {
	function get_drive_id ($drive_url) {
		preg_match('/https:\/\/drive.google.com\/file\/d\/(.*)\/.*/', $drive_url, $matches);
		if (count($matches) < 2) {
			return false;
		}
		return $matches[1];
	}
}