<ul class="float-container tools-container" id="content-tabs">
  <li class="current"><h2>Ricerca per "<?php echo $query ?>"</h2></li>
</ul>

<div class="tabbed float-container" id="content">
	<div id="main">
	  <div class="W73_100 float-left">

      <p style="height: 300px; margin-top: 50px; margin-left: auto; margin-right: auto; font-size: 14px; font-weight: bold">La tua ricerca non ha prodotto alcun risultato</p>

    </div>
  </div>
</div>

<?php slot('breadcrumbs') ?>
  <?php echo link_to('Home', '@homepage') ?> /
  Ricerca per <i><?php echo $query ?></i>
<?php end_slot() ?>
