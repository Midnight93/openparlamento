emendamento: <?php echo link_to(highlight_keywords($result->titolo, $query, sfConfig::get('app_lucene_result_highlighter', '<strong class="highlight">%s</strong>')), add_highlight_qs($result->getInternalUri(), $query)) ?>
