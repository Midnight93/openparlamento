parlamentare: <?php echo link_to(highlight_keywords($result->nominativo, $query, sfConfig::get('app_lucene_result_highlighter','<strong class="highlight">%s</strong>')), 
                     add_highlight_qs($result->getInternalUri(), $query)) ?> 

