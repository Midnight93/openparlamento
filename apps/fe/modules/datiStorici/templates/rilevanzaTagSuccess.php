<?php include_partial('tabs', array('current' => 'rilevanzaTag')) ?>

<div id="content" class="tabbed float-container">
  <a name="top"></a>
  <div id="main">

    <?php include_partial('filtersTag',
                          array('date' => $all_dates,
                                'tags_categories' => $all_tags_categories,
                                'active' => deppFiltersAndSortVariablesManager::arrayHasNonzeroValue(array_values($filters)),
                                'selected_tags_category' => array_key_exists('tags_category', $filters)?$filters['tags_category']:0,
                                'selected_data' => array_key_exists('data', $filters)?$filters['data']:0)) ?>
                                
    <?php include_partial('rilevanzaTagSort') ?>
                                

    <?php echo include_partial('default/listNotice', 
                               array('filters' => $filters, 'results' => $pager->getNbResults())); ?>

    <?php include_partial('rilevanzaTagList', array('pager' => $pager)) ?>
    
    <div style="clear: both; text-align: center">
      <?php echo link_to('scarica in formato CSV', '@dati_storici_rilevanza_tag_export') ?>
    </div>

  </div>
  
  
</div>

<?php slot('breadcrumbs') ?>
    <?php echo link_to("home", "@homepage") ?> / dati storici su indice attivit&agrave;
<?php end_slot() ?>
