<?php

namespace controllers;

class ErrorController extends Controller
{
    function __construct()
    {
        $this->layout = '_error';
    }

    function notFound()
    {
        $this->meta['title'] = '404 | Hải Triều';
        return $this->view('error/404');
    }

    function unauthorized()
    {
        $this->meta['title'] = '401 | Hải Triều';
        return $this->view('error/401');
    }
}
