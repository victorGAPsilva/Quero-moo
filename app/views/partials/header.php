<?php
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$basePath = rtrim(config('base_path', ''), '/');
$path = $basePath ? str_replace($basePath, '', $currentPath) : $currentPath;
$path = rtrim($path, '/') ?: '/';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Queijos artesanais premium e experiencias gastronomicas.">
  <title><?php echo e($title ?? 'QUERO MOO'); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@400;600;700&family=Manrope:wght@300;500;600;700&display=swap" rel="stylesheet">
  <link rel="icon" href="<?php echo base_path_url('assets/imgs/logo.jpeg'); ?>" type="image/jpeg">
  <link rel="stylesheet" href="<?php echo base_path_url('assets/css/style.css'); ?>">
</head>
<body>
  <header class="site-header">
    <div class="container navbar">
      <a href="<?php echo base_path_url('/'); ?>" class="logo">
        <img src="<?php echo base_path_url('assets/imgs/logo.jpeg'); ?>" alt="Logo QUERO MOO">
        <span>QUERO MOO</span>
      </a>
      <nav class="nav-links">
        <a href="<?php echo base_path_url('/'); ?>" class="<?php echo $path === '/' ? 'active' : ''; ?>">Home</a>
        <a href="<?php echo base_path_url('/catalogo'); ?>" class="<?php echo $path === '/catalogo' ? 'active' : ''; ?>">Catalogo</a>
        <a href="<?php echo base_path_url('/sobre'); ?>" class="<?php echo $path === '/sobre' ? 'active' : ''; ?>">Sobre</a>
        <a href="<?php echo base_path_url('/contato'); ?>" class="<?php echo $path === '/contato' ? 'active' : ''; ?>">Contato</a>
      </nav>
      <button class="btn btn-outline cart-toggle" type="button" aria-label="Abrir carrinho">
        Carrinho
        <span class="cart-count" aria-live="polite">0</span>
      </button>
    </div>
  </header>
  <div class="cart-overlay" data-cart-close></div>
  <aside class="cart-sidebar" aria-hidden="true" data-whatsapp-phone="<?php echo e(config('whatsapp_phone')); ?>">
    <div class="cart-header">
      <h3>Seu carrinho</h3>
      <button class="cart-close" type="button" aria-label="Fechar carrinho" data-cart-close>Fechar</button>
    </div>
    <div class="cart-items" data-cart-items></div>
    <div class="cart-footer">
      <div class="cart-total">
        <span>Total</span>
        <strong data-cart-total>R$ 0,00</strong>
      </div>
      <a class="btn btn-primary cart-whatsapp" data-cart-whatsapp target="_blank" rel="noopener">Enviar pelo WhatsApp</a>
    </div>
  </aside>
  <div class="cart-toast" role="status" aria-live="polite"></div>
  <main>
