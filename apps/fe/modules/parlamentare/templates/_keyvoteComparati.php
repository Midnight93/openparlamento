<div class="W73_100 float-left">
<?php if (count($lanci)>0) : ?>  
<h4 class="subsection">In <?php echo count($lanci) ?> voti chiave hanno votato:</h4>
<p class="tools-container"><a class="ico-help" href="#">cosa sono i voti chiave</a></p>
  			<div style="display: none;" class="help-box float-container">
  				<div class="inner float-container">		
  					<a class="ico-close" href="#">chiudi</a><h5>cosa sono i voti chiave ?</h5>
  					<p>Sono le votazioni pi&ugrave; importanti della legislatura sia per la rilevanza della materia trattata, sia per il valore politico del voto.</p>
  				</div>
  			</div>
  	<br />
<table class="disegni-decreti column-table">
  <thead>
    <tr>
      <th scope="col">Voto chiave:</th>
      <th scope="col"><?php echo $parlamentare1->getOppPolitico()->getNome().' '.$parlamentare1->getOppPolitico()->getCognome().':' ?></th> 	
      <th scope="col"><?php echo $parlamentare2->getOppPolitico()->getNome().' '.$parlamentare2->getOppPolitico()->getCognome().':' ?></th>
       <th scope="col">Esito della votazione:</th>			
    </tr>
  </thead>

  <tbody>
  <?php foreach ($lanci as $lancio) : ?>
<tr>
        <th scope="row">
          <p>
          <?php echo link_to(($lancio[0]->getTitoloAggiuntivo()) ? $lancio[0]->getTitoloAggiuntivo() : $lancio[0]->getTitolo(),       '@votazione?'.$lancio[0]->getUrlParams()) ?>
          </p>         
       </th>
       <?php if ($lancio[2]!=$lancio[3]) : ?>
          <td class="evident"><p><?php echo $lancio[2] ?></p></td>
          <td class="evident"><p><?php echo $lancio[3] ?></p></td>
       <?php else : ?>   
          <td><p><?php echo $lancio[2] ?></p></td>
          <td><p><?php echo $lancio[3] ?></p></td>
       <?php endif ?>  
       <td>
		  <?php if($lancio[0]->getEsito()=='APPROVATA'): ?>
		    <?php $class = "green thumb-approved"; ?>
		  <?php elseif($lancio[0]->getEsito()=='RESPINTA'): ?>
		    <?php $class = "red thumb-rejected"; ?>
		  <?php else: ?>
		    <?php $class = ""; ?>
                  <?php endif; ?>
            <span class="<?php echo $class ?>"><?php echo $lancio[0]->getEsito() ?></span>      	
        </td>   

</tr>
<?php endforeach ?>
</tbody>
</table>
<?php else : ?>
  <?php echo "i due parlamentari non erano in carica contemporaneamente alla data  di nessun voto chiave"?>
<?php endif; ?>  
</div>