<?php

class HomeController extends Controller
{
    public function index()
    {
        $productModel = new Product();
        $featured = $productModel->latest(6);

        $this->view('home/index', [
            'title' => 'Home',
            'featured' => $featured,
        ]);
    }

    public function about()
    {
        $this->view('pages/about', ['title' => 'Sobre']);
    }

    public function contact()
    {
        $this->view('pages/contact', ['title' => 'Contato']);
    }
}
