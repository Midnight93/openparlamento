<table id="disegni-decreti" class="column-table">
  <thead>
    <tr>
      <th scope="col">parlamentare:</th>
      <th scope="col">gruppo:</th>
      <th scope="col">circoscrizione:</th>				
      <th scope="col" class="evident">presenze:</th>			
      <th scope="col" class="evident">assenze:</th>
      <th scope="col" class="evident">missioni:</th>
      <th scope="col">indice di attivit&agrave;&nbsp;<br />(min 0 / max 10) :</th>
      <th scope="col">voti ribelli:</th>
    </tr>
  </thead>

  <tbody>				  
    <?php while($parlamentari->next()): ?>
      <tr>
        <th scope="row">
          <p class="politician-id">
              
            <img width="40" height="55" src="http://openpolis.depplab.net/politician/picture?content_id=<?php echo $parlamentari->getInt(2) ?>" />     
            <?php //echo image_tag('no-avatar40.png') ?>	
            <?php echo link_to($parlamentari->getString(3).' '.$parlamentari->getString(4), '@parlamentare?id='.$parlamentari->getInt(2)) ?>
          </p>
        </th>
	    <td>
          <p>	        	
	        <?php $gruppi = OppCaricaHasGruppoPeer::doSelectGruppiPerCarica($parlamentari->getInt(1)) ?>  	
	        <?php $rib_count=0 ?>
	        <?php $presenze_totali = 0 ?>
	        <?php foreach($gruppi as $nome => $gruppo): ?>
	          <?php $presenze = OppCaricaPeer::doSelectPresenzePerGruppo($parlamentari->getInt(1), format_date($gruppo['data_inizio'], 'yyyy-MM-dd'), format_date($gruppo['data_fine'], 'yyyy-MM-dd')) ?>
	          <?php $rib_count = $rib_count + $gruppo['ribelle'] ?>
              <?php if($gruppo['data_fine']): ?>
                <?php printf('(dal %s al %s: %s)', format_date($gruppo['data_inizio'], 'dd/MM/yyyy'), format_date($gruppo['data_fine'], 'dd/MM/yyyy'), $nome ) ?>
	          <?php else: ?>
		        <?php print $nome ?>
	          <?php endif; ?>
	            <?php print '<br />' ?>
	          <?php $presenze_totali = $presenze_totali + $presenze ?>
	        <?php endforeach; ?>
          </p>  				
        </td>
        <td><p><?php echo $parlamentari->getString(5) ?></p></td>
        <td class="evident">
          <?php printf('<b>%01.2f</b> %% (%d su %d)', number_format($presenze_totali/$numero_votazioni *100,2), $presenze_totali, $numero_votazioni) ?>
        </td>
        <td class="evident"></td>
        <td class="evident"></td>
        <td>
          <?php printf('<b>%01.2f</b> (%d° su %d)', $parlamentari->getFloat(7), $parlamentari->getInt(8), $numero_parlamentari) ?>  
        </td>

        <td>
          <?php if($presenze_totali!=0): ?>
            <?php printf('<b>%01.2f</b> %% (%d su %d)', number_format($rib_count/$presenze_totali *100,2), $rib_count, $presenze_totali) ?>
	      <?php else: ?>
	        <?php print('<b>0</b>% (0 su 0)') ?>
	      <?php endif; ?>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>    
</table>