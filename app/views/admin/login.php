<?php require APP_ROOT . '/app/views/partials/header.php'; ?>

<section class="section">
  <div class="container" style="max-width: 520px;">
    <div class="hero-card">
      <h2>Login administrativo</h2>
      <?php if (!empty($_SESSION['flash'])): ?>
        <div class="alert"><?php echo e($_SESSION['flash']); unset($_SESSION['flash']); ?></div>
      <?php endif; ?>
      <form class="form-grid" method="post" action="<?php echo base_path_url('/admin/login'); ?>">
        <?php echo csrf_field(); ?>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Senha" required>
        <button class="btn btn-primary" type="submit">Entrar</button>
      </form>
    </div>
  </div>
</section>

<?php require APP_ROOT . '/app/views/partials/footer.php'; ?>
