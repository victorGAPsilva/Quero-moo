<?php require APP_ROOT . '/app/views/partials/header.php'; ?>
<?php $products = isset($products) && is_array($products) ? $products : []; ?>

<section class="section">
  <div class="container">
    <div class="admin-header">
      <div>
        <h2>Painel administrativo</h2>
        <p>Bem-vindo, <?php echo e($_SESSION['admin_name'] ?? 'Admin'); ?></p>
      </div>
      <div class="cta-group">
        <a class="btn btn-outline" href="<?php echo base_path_url('/admin/produtos'); ?>">Gerenciar produtos</a>
        <form method="post" action="<?php echo base_path_url('/admin/logout'); ?>">
          <?php echo csrf_field(); ?>
          <button class="btn btn-primary" type="submit">Sair</button>
        </form>
      </div>
    </div>
    <div class="hero">
      <div class="hero-card">
        <h3>Total de produtos</h3>
        <p style="font-size: 2rem; margin: 0;"><?php echo count($products); ?></p>
      </div>
      <div class="hero-card">
        <h3>Ultimas atualizacoes</h3>
        <p>Revise produtos, estoque e precos com frequencia.</p>
      </div>
    </div>
  </div>
</section>

<?php require APP_ROOT . '/app/views/partials/footer.php'; ?>
