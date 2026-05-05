<?php

class AdminController extends Controller
{
    private function requireAuth()
    {
        if (!Auth::check()) {
            $this->redirect('/admin/login');
        }
    }

    public function dashboard()
    {
        $this->requireAuth();
        $productModel = new Product();
        $products = $productModel->all();

        $this->view('admin/dashboard', [
            'title' => 'Dashboard',
            'products' => $products,
        ]);
    }

    public function productsIndex()
    {
        $this->requireAuth();
        $productModel = new Product();
        $products = $productModel->all();

        $this->view('admin/products/index', [
            'title' => 'Produtos',
            'products' => $products,
        ]);
    }

    public function productsCreate()
    {
        $this->requireAuth();
        $this->view('admin/products/create', ['title' => 'Novo produto']);
    }

    public function productsStore()
    {
        $this->requireAuth();
        if (!csrf_verify()) {
            http_response_code(403);
            echo 'CSRF token invalid.';
            return;
        }

        $productModel = new Product();

        $imagem = upload_image($_FILES['imagem'] ?? [], null);
        $data = [
            'nome' => trim($_POST['nome'] ?? ''),
            'descricao' => trim($_POST['descricao'] ?? ''),
            'preco' => (float)($_POST['preco'] ?? 0),
            'imagem' => $imagem ?? '',
            'categoria' => trim($_POST['categoria'] ?? ''),
            'estoque' => (int)($_POST['estoque'] ?? 0),
        ];

        $productModel->create($data);
        $_SESSION['flash'] = 'Produto criado com sucesso.';
        $this->redirect('/admin/produtos');
    }

    public function productsEdit($params)
    {
        $this->requireAuth();
        $productModel = new Product();
        $product = $productModel->find($params['id'] ?? null);

        if (!$product) {
            $_SESSION['flash'] = 'Produto nao encontrado.';
            $this->redirect('/admin/produtos');
            return;
        }

        $this->view('admin/products/edit', [
            'title' => 'Editar produto',
            'product' => $product,
        ]);
    }

    public function productsUpdate($params)
    {
        $this->requireAuth();
        if (!csrf_verify()) {
            http_response_code(403);
            echo 'CSRF token invalid.';
            return;
        }

        $productModel = new Product();
        $product = $productModel->find($params['id'] ?? null);

        if (!$product) {
            $_SESSION['flash'] = 'Produto nao encontrado.';
            $this->redirect('/admin/produtos');
            return;
        }

        $imagem = upload_image($_FILES['imagem'] ?? [], $product['imagem']);

        $data = [
            'nome' => trim($_POST['nome'] ?? ''),
            'descricao' => trim($_POST['descricao'] ?? ''),
            'preco' => (float)($_POST['preco'] ?? 0),
            'imagem' => $imagem ?? '',
            'categoria' => trim($_POST['categoria'] ?? ''),
            'estoque' => (int)($_POST['estoque'] ?? 0),
        ];

        $productModel->update($product['id'], $data);
        $_SESSION['flash'] = 'Produto atualizado com sucesso.';
        $this->redirect('/admin/produtos');
    }

    public function productsDelete($params)
    {
        $this->requireAuth();
        if (!csrf_verify()) {
            http_response_code(403);
            echo 'CSRF token invalid.';
            return;
        }

        $productModel = new Product();
        $product = $productModel->find($params['id'] ?? null);

        if ($product && !empty($product['imagem']) && file_exists(APP_ROOT . '/public/' . $product['imagem'])) {
            @unlink(APP_ROOT . '/public/' . $product['imagem']);
        }

        $productModel->delete($params['id'] ?? null);
        $_SESSION['flash'] = 'Produto removido.';
        $this->redirect('/admin/produtos');
    }
}
