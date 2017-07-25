<!-- Layout Four -->

<?php $preview_set = get_query_var('preview_set'); ?>
<div class="tile is-ancestor">
  <div class="tile is-vertical">
    <div class="tile">
      <div class="tile is-parent is-8">
        <div class="tile is-child">
          <div class="card">
            <?php if (! empty($preview_set['top_left_header'])): ?>
              <header class="card-header">
                <h4 class="card-header-title"><?php echo $preview_set['top_left_header']; ?></h4>
              </header>
            <?php endif; ?>
            <div class="card-content content">
              <?php echo $preview_set['top_left_content']; ?>
            </div>
            <?php if (! empty($preview_set['top_left_footer'])): ?>
              <footer class="card-footer">
                <div class="card-footer-item">
                  <a class="has-arrow-icon" href="<?php echo $preview_set['top_left_footer']; ?>">
                    <span>Read more</span>
                    <span class="icon"><i class="fa fa-arrow-right"></i></span>
                  </a>
                </div>
              </footer>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="tile is-parent is-4">
        <div class="tile is-child">
          <div class="card">
            <?php if (! empty($preview_set['top_right_header'])): ?>
              <header class="card-header">
                <h4 class="card-header-title"><?php echo $preview_set['top_right_header']; ?></h4>
              </header>
            <?php endif; ?>
            <div class="card-content content">
              <?php echo $preview_set['top_right_content']; ?>
            </div>
            <?php if (! empty($preview_set['top_right_footer'])): ?>
              <footer class="card-footer">
                <div class="card-footer-item">
                  <a class="has-arrow-icon" href="<?php echo $preview_set['top_right_footer']; ?>">
                    <span>Read more</span>
                    <span class="icon"><i class="fa fa-arrow-right"></i></span>
                  </a>
                </div>
              </footer>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
