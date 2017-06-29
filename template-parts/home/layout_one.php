<?php $preview_set = get_query_var('preview_set'); ?>
<div class="tile is-ancestor">
  <div class="tile is-vertical">
    <div class="tile">
      <div class="tile is-parent is-vertical">
        <div class="tile is-child content">
          <?php echo $preview_set['top_left']; ?>
        </div>
        <div class="tile is-child content">
          <?php echo $preview_set['middle_left']; ?>
        </div>
      </div>
      <div class="tile is-parent">
        <div class="tile is-child content">
          <?php echo $preview_set['top_right']; ?>
        </div>
      </div>
    </div>
    <div class="tile is-parent">
      <div class="tile is-child content">
        <?php echo $preview_set['bottom']; ?>
      </div>
    </div>
  </div>
</div>
