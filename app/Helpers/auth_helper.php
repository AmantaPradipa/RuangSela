<?php

if (! function_exists('is_logged_in')) {
    function is_logged_in(): bool
    {
        return session()->get('isLoggedIn') ?? false;
    }
}

if (! function_exists('user_id')) {
    function user_id()
    {
        return session()->get('user_id');
    }
}

if (! function_exists('user_role')) {
    function user_role()
    {
        return session()->get('role');
    }
}
