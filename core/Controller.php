<?php

class Controller
{
    protected function view($view, array $data = [])
    {
        extract($data);
        $viewPath = APP_ROOT . '/app/views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            http_response_code(404);
            echo 'View not found.';
            return;
        }

        require $viewPath;
    }

    protected function redirect($path)
    {
        header('Location: ' . base_path_url($path));
        exit;
    }
}
