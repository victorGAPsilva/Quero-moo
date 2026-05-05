<?php require APP_ROOT . '/app/views/partials/header.php'; ?>
<?php $featured = isset($featured) && is_array($featured) ? $featured : []; ?>

<section class="hero container">
  <div>
    <div class="hero-card">
      <span class="badge">Edicao limitada</span>
      <h1>Queijos artesanais com identidade brasileira.</h1>
      <p>Experiencia gourmet com selecao curada, maturacao precisa e origem certificada. Seu carrinho de sabores sofisticados em poucos cliques.</p>
      <div class="cta-group">
        <a class="btn btn-primary" href="<?php echo base_path_url('/catalogo'); ?>">Ver catalogo</a>
        <a class="btn btn-outline" href="<?php echo base_path_url('/sobre'); ?>">Conheca a marca</a>
      </div>
    </div>
  </div>
  <div>
    <img class="hero-banner" src="<?php echo base_path_url('assets/imgs/template.jpeg'); ?>" alt="Banner QUERO MOO">
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-title">
      <h2>Destaques da semana</h2>
      <a class="btn btn-outline" href="<?php echo base_path_url('/catalogo'); ?>">Ver todos</a>
    </div>
    <div class="cards">
      <?php foreach ($featured as $product): ?>
        <div class="card">
          <img src="<?php echo $product['imagem'] ? base_path_url($product['imagem']) : 'https://images.unsplash.com/photo-1486297678162-eb2a19b0a32d?auto=format&fit=crop&w=900&q=80'; ?>" alt="<?php echo e($product['nome']); ?>">
          <div class="card-body">
            <span class="badge"><?php echo e($product['categoria']); ?></span>
            <h3><?php echo e($product['nome']); ?></h3>
            <p class="price">R$ <?php echo number_format((float)$product['preco'], 2, ',', '.'); ?></p>
            <a class="btn btn-primary" href="<?php echo base_path_url('/produto/' . $product['id']); ?>">Ver detalhes</a>
          </div>
        </div>
      <?php endforeach; ?>
      <?php if (empty($featured)): ?>
        <p>Nenhum produto cadastrado ainda.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-title">
      <h2>Experiencia QUERO MOO</h2>
    </div>
    <div class="cards">
      <div class="card">
        <div class="card-body">
          <h3>Selecao premium</h3>
          <p>Curadoria de produtores artesanais com processos sustentaveis.</p>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h3>Entrega cuidadosa</h3>
          <p>Logistica com controle termico e embalagens de alta qualidade.</p>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h3>Atendimento humano</h3>
          <p>Consultoria para harmonizacao e escolhas personalizadas.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require APP_ROOT . '/app/views/partials/footer.php'; ?>
