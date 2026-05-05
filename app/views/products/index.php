<?php require APP_ROOT . '/app/views/partials/header.php'; ?>

<?php if (!isset($products) || !is_array($products)): ?>
  <section class="section">
    <div class="container">
      <p>Nenhum produto cadastrado.</p>
    </div>
  </section>
  <?php require APP_ROOT . '/app/views/partials/footer.php'; ?>
  <?php return; ?>
<?php endif; ?>

<section class="section">
  <div class="container">
    <div class="section-title">
      <h2>Catalogo completo</h2>
      <p>Selecionados para experiencias gastronomicas inesqueciveis.</p>
    </div>
    <div class="cards">
      <?php foreach ($products as $product): ?>
        <?php
          $productImage = $product['imagem']
            ? base_path_url($product['imagem'])
            : 'https://images.unsplash.com/photo-1486297678162-eb2a19b0a32d?auto=format&fit=crop&w=900&q=80';
        ?>
        <div class="card">
          <img src="<?php echo $productImage; ?>" alt="<?php echo e($product['nome']); ?>">
          <div class="card-body">
            <span class="badge"><?php echo e($product['categoria']); ?></span>
            <h3><?php echo e($product['nome']); ?></h3>
            <p><?php echo e(substr($product['descricao'], 0, 90)); ?>...</p>
            <p class="price">R$ <?php echo number_format((float)$product['preco'], 2, ',', '.'); ?></p>
            <div class="cta-group">
              <a class="btn btn-primary" href="<?php echo base_path_url('/produto/' . $product['id']); ?>">Detalhes</a>
              <button
                class="btn btn-outline"
                type="button"
                data-cart-add
                data-cart-id="<?php echo e((string)$product['id']); ?>"
                data-cart-name="<?php echo e($product['nome']); ?>"
                data-cart-price="<?php echo e((string)$product['preco']); ?>"
                data-cart-image="<?php echo e($productImage); ?>"
              >Adicionar</button>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <?php if (empty($products)): ?>
        <p>Nenhum produto cadastrado.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php require APP_ROOT . '/app/views/partials/footer.php'; ?>
