<?php require APP_ROOT . '/app/views/partials/header.php'; ?>

<?php if (!isset($product) || !$product): ?>
  <section class="section">
    <div class="container">
      <p>Produto nao encontrado.</p>
    </div>
  </section>
  <?php require APP_ROOT . '/app/views/partials/footer.php'; ?>
  <?php return; ?>
<?php endif; ?>

<section class="section">
  <div class="container">
    <div class="hero">
      <div>
        <?php
          $productImage = $product['imagem']
            ? base_path_url($product['imagem'])
            : 'https://images.unsplash.com/photo-1452195100486-9cc805987862?auto=format&fit=crop&w=900&q=80';
        ?>
        <img src="<?php echo $productImage; ?>" alt="<?php echo e($product['nome']); ?>">
      </div>
      <div class="hero-card">
        <span class="badge"><?php echo e($product['categoria']); ?></span>
        <h1><?php echo e($product['nome']); ?></h1>
        <p><?php echo e($product['descricao']); ?></p>
        <p class="price">R$ <?php echo number_format((float)$product['preco'], 2, ',', '.'); ?></p>
        <p>Estoque disponivel: <?php echo e($product['estoque']); ?></p>
        <?php
          $text = urlencode('Ola, quero comprar ' . $product['nome']);
          $whats = 'https://wa.me/' . e(config('whatsapp_phone')) . '?text=' . $text;
        ?>
        <div class="cta-group">
          <button
            class="btn btn-outline"
            type="button"
            data-cart-add
            data-cart-id="<?php echo e((string)$product['id']); ?>"
            data-cart-name="<?php echo e($product['nome']); ?>"
            data-cart-price="<?php echo e((string)$product['preco']); ?>"
            data-cart-image="<?php echo e($productImage); ?>"
          >Adicionar ao carrinho</button>
          <a class="btn btn-primary" href="<?php echo $whats; ?>" target="_blank" rel="noopener">Pedir pelo WhatsApp</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require APP_ROOT . '/app/views/partials/footer.php'; ?>
