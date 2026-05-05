<?php

class AuthController extends Controller
{
    public function showLogin()
    {
        $this->view('admin/login', ['title' => 'Login']);
    }

    public function login()
    {
        if (!csrf_verify()) {
            http_response_code(403);
            echo 'CSRF token invalid.';
            return;
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (Auth::attempt($email, $password)) {
            $this->redirect('/admin');
            return;
        }

        $_SESSION['flash'] = 'Login invalido.';
        $this->redirect('/admin/login');
    }

    public function logout()
    {
        if (!csrf_verify()) {
            http_response_code(403);
            echo 'CSRF token invalid.';
            return;
        }

        Auth::logout();
        $this->redirect('/admin/login');
    }
}
