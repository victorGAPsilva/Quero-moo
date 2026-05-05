<?php

class ProductController extends Controller
{
    public function index()
    {
        $productModel = new Product();
        $products = $productModel->all();

        $this->view('products/index', [
            'title' => 'Catalogo',
            'products' => $products,
        ]);
    }

    public function show($params)
    {
        $productModel = new Product();
        $product = $productModel->find($params['id'] ?? null);

        if (!$product) {
            http_response_code(404);
            echo 'Produto nao encontrado.';
            return;
        }

        $this->view('products/show', [
            'title' => $product['nome'],
            'product' => $product,
        ]);
    }
}
