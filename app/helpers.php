<?php
function hp(array $perms)
{
    $user = Sentry::getUser();
    return $user->hasAnyAcess($perms);
}

function softTrim($text, $count, $wrapText='...')
{
    if(strlen($text)>$count)
    {
        preg_match('/^.{0,' . $count . '}(?:.*?)\b/siu', $text, $matches);
        $text = $matches[0];
    }else
    {
        $wrapText = '';
    }
    return $text . $wrapText;
}

function hardTrim($str, $end, $wrap = '...', $begin = 0)
{
    if (strlen($str) < ($end - $begin)) return $str;
    return substr($str, $begin, $end) . $wrap;
}

function statusClass($status)
{
    switch ($status){
        case '0':
            return 'default';
        case '1':
            return 'success';
        case '2':
            return 'info';
        case '-1':
            return 'danger';
        default:
            return 'default';
    }
}
