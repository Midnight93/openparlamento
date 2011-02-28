<?php use_helper('Date', 'Number') ?>

<ul class="float-container tools-container" id="content-tabs">
	<li class="current"><h2><?php echo ($carica ? ($ramo=='camera' ? 'On. ' : 'Sen. '):'') ?><?php echo $parlamentare->getNome() ?>&nbsp;<?php echo $parlamentare->getCognome() ?></h2></li>
</ul>



<div class="tabbed float-container" id="content">
  <div id="main">
   <div class="W25_100 float-right">
			

			<div id="monitor-n-vote" style="margin-bottom:1px;">
      	<h6>monitora questo politico</h6>
      	<p class="tools-container"><a class="ico-help" href="#">che significa monitorare</a></p>

  		<div style="display: none;" class="help-box float-container">
  			<div class="inner float-container">

  				<a class="ico-close" href="#">chiudi</a><h5>che significa monitorare ?</h5>
  				<p>Registrandoti e entrando nel sito puoi attivare il monitoraggio per atti, parlamentari e argomenti. Da quel momento nella tua pagina personale e nella tua email riceverai tutti gli aggiornamenti riferiti agli elementi che stai monitorando.<br />
  				</p>
  			</div>
  		</div>

        <!-- partial per la gestione del monitoring di questo politico -->
        <?php echo include_component('monitoring', 'manageItem', 
                                     array('item' => $parlamentare, 'item_type' => 'politico')); ?>



        <?php echo include_component('parlamentare', 'monitoringalso', array('item' => $parlamentare)); ?>

  		</div>
      
   
   </div>
			
   <div class="W73_100 float-left">
	    <?php echo include_partial('secondlevelmenu', 
	                               array('current' => 'cosa', 
	                                     'parlamentare_id' => $parlamentare->getId())); ?>
    	                                     
    	                                     
    <?php if ($sf_flash->has('subscription_promotion')): ?>
      <div class="flash-messages">
        <?php echo $sf_flash->get('subscription_promotion') ?>
      </div>
    <?php endif; ?>
    	                                     	
    <div class="W100_100 float-left">
    <div class="W25_100 float-right" style="width:37%"> 
  		    
  		  <?php echo link_to('la sua pagina su ' . image_tag('/images/op_logo_small.png', 
  		                                                    array('alt' => 'vai al sito openpolis')), 
  		                                                    'http://openpolis.it/politico/'.$parlamentare->getId(),
  		                                                    array('class' => 'jump-to-camera')) ?>                 
  		   
  		  <?php if ($carica) : ?>                   
                   <?php if ($ramo=='camera') : ?> 
                     <?php $url='http://www.camera.it/cartellecomuni/leg16/include/contenitore_dati.asp?tipopagina=&deputato=d'.$carica->getParliamentId().'&source=%2Fdeputatism%2F240%2Fdocumentoxml.asp&position=Deputati\La%20Scheda%20Personale&Pagina=Deputati/Composizione/SchedeDeputati/SchedeDeputati.asp%3Fdeputato=d'.$carica->getParliamentId() ?> 
                     <?php echo link_to('la sua pagina su ' . image_tag('/images/logo-camera-deputati.png', 
  		                                                    array('alt' => 'vai al sito della camera dei deputati')), 
  		                                                    $url,
  		                                                    array('class' => 'jump-to-camera')) ?>   
                   <?php else : ?>
                     <?php $url='http://www.senato.it/loc/link.asp?tipodoc=sattsen&leg=16&id='.$carica->getParliamentId() ?>
                     <?php echo link_to('la sua pagina su ' . image_tag('/images/logo-senato.png', 
  		                                                    array('alt' => 'vai al sito del senato')), 
  		                                                    $url,
  		                                                    array('class' => 'jump-to-camera')) ?>   
                   <?php endif ?>
        <?php endif ?> 
                 
      </div>
      <div class="W73_100 float-left" style="width:60%">
  			<div class="float-container">
  			  <?php echo image_tag(OppPoliticoPeer::getPictureUrl($parlamentare->getId()), 
                               array('class' => 'portrait-91x126 float-left', 
   			                             'alt' => $parlamentare->getNome() . ' ' . $parlamentare->getCognome(),
   			                             'width' => '91', 'height' => '126')) ?>	
          
  				<div class="politician-more-info">
  				    <?php if ($carica) : ?>	
  				    	<p><label>
  				    	<?php echo ($carica->getTipoCaricaId()!=5 ? $carica->getLegislatura()."&#186; legislatura: " :"come Senatore a vita: ") ?>in carica dal <?php echo $carica->getDataInizio('d/m/Y') ?>
  				    	</label></p>
  				    	<p> 
  				    	<?php echo 'in carriera è stato parlamentare per '.link_to($durata,'http://openpolis.it/politico/'.$parlamentare->getId()."#carriera")?> 
  				    	</p>
  					<p><label>gruppo:</label>  
  					
					     <?php echo link_to($acronimo_gruppo_corrente,  
					                        '@parlamentari?ramo='.$ramo.'&filter_group='.$id_gruppo_corrente) ?>
  					  <?php if (count($gruppi) > 1): ?>
  					   (
  					  <?php endif ?>
  					  <?php foreach ($gruppi as $acronimo => $gruppo): ?>
  					   <?php if ($acronimo != $acronimo_gruppo_corrente): ?>
  					     dal <?php echo format_date($gruppo['data_inizio'],'dd/MM/yyyy') ?>
  					     al <?php echo format_date($gruppo['data_fine'],'dd/MM/yyyy') ?>:
  					     <?php echo link_to($acronimo, 
  					                        '@parlamentari?ramo='.$ramo.'&filter_group='.$gruppo['gruppo_id']) ?>
  					   <?php endif ?>
  					  <?php endforeach ?>
  					  <?php if (count($gruppi) > 1): ?>
  					   )
  					  <?php endif ?>
  					</p>
  					 <?php if ($circoscrizione=="") : ?>
  					   <p><label>Senatore a vita</label></p>  
  					 <?php else : ?>
  					   <p><label>circoscrizione:</label> 
  					      <?php echo link_to($circoscrizione, '@parlamentari?ramo='.$ramo.'&filter_const='.$circoscrizione) ?>
  					    </p>
  					 <?php endif ?> 
  				    <?php endif ?>	 
  					
  					
  					   <?php echo include_partial('altreCariche',array('descrizione_cariche' => $descrizione_cariche)); ?>
  					
  				</div>
  	</div>
   </div>	
</div>  
</div>
<div class="W100_100 float-left">	
<div class="W35_100 float-right" style="width:45%">
                   
	<?php if ($carica) : ?>		
	  
	   <!-- BOX ATTI POLITICO_UTENTE FAVOREVOLE -->
         <?php if ($carica && $sf_user->isAuthenticated()) { 
          
  echo include_component('monitoring', 'userVspolitician', 
                   array('user' => $sf_user, 
                         'num'=> 10, 
                         'ambient' =>'politico', 
                         'parlamentare' => $parlamentare,
                          'legislatura' => 16));
                    
          } ?>
	 
	   <?php echo include_partial('news/newsbox',
                                 array('title' => 'Parlamentare',
                                
                                       'all_news_url' => '@news_parlamentare?id='.$parlamentare->getId(), 
                                       'news'   => oppNewsPeer::getNewsForItem('OppPolitico', $parlamentare->getId(), 3),
                                       'context' => 2,
                                       'rss_link' => '@feed_politico?id='.$parlamentare->getId())); ?> 
                                       
                                       
            <?php echo include_component('parlamentare', 'sioccupadi', array('carica' => $carica)); ?>

           <?php if ($nvoti_validi>0): ?>
             <?php echo include_component('parlamentare','comparaQuesto', 
                                        array('parlamentare' => $parlamentare,
                                              'select2'=>'',
                                              'ramo' => ($carica->getTipoCaricaId()=='1'?'1':'2'))); ?>                        
                                              
             <?php echo include_component('parlamentare', 'votacome', 
                                       array('carica' => $carica,
                                             'parlamentare' => $parlamentare,
                                             'acronimo' => $acronimo_gruppo_corrente)); ?>          
           <?php endif ?>

           <?php echo include_component('parlamentare', 'firmacon', 
                                     array('carica' => $carica,
                                           'acronimo' => $acronimo_gruppo_corrente)); ?>
         <?php endif ?>  
         
                 

</div>
<div class="W73_100 float-left" style="width:50%">
		
  		
  			
		    <?php if ($carica) : ?>
		    
		    <!-- INCARICHI PARLAMENTARI -->
		    <?php echo include_component('parlamentare','incarichiParlamentare', array('carica_id' => $carica->getId(), 'ramo' => $ramo)) ?>  
		    
		    <!-- INDICE DI PRODUTTIVITA' -->
		    <h5 class="subsection-alt">
		      Nuovo indice di produttività parlamentare <?php echo image_tag('/images/ico-new.png') ?>
		    </h5>

  			<p class="tools-container"><a class="ico-help" href="#">come viene calcolato</a></p>
  			<div style="display: none;" class="help-box float-container">
  				<div class="inner float-container">		
  					<a class="ico-close" href="#">chiudi</a><h5>Che cos'&egrave; l'indice di produttivit&agrave; ?</h5>
  					<p>&Egrave; il nuovo indice che prende in esame il numero, la tipologia, il consenso e l'iter degli atti presentati dai parlamentari in modo da poterli confrontare tra di loro.<br /> <strong>Per la descrizione dettagliata della metodologia di valutazione <a href="http://indice.openpolis.it/info.html">vai qui</a>.</strong></p>
  				</div>
  			</div>

  			<div class="float-container" style="padding:5px 10px 10px 20px;">
  				<label style="color:#888888; font-weight:bold; font-size:16px;">indice di produttivit&agrave;:</label>
  				  <span style="text-align:left; color:#4E8480;  font-weight:bold; font-size:24px;"><?php echo number_format($carica->getIndice(), 1,',','.') ?></span>
  			</div>
  			<div class="float-container" style="padding:2px 10px 10px 20px;">
  				<label style="color:#888888; font-weight:bold; font-size:16px;">classifica:</label>
  				<span style="text-align:left; color:#4E8480;  font-weight:bold; font-size:20px;"><?php echo $carica->getPosizione()."&deg;" ?></span> su <?php echo ($ramo=='camera' ? '630 deputati' : '322 senatori') ?>
  				  <?php if($carica->getDataInizio('d/m/Y')>"29/04/2008") echo "(N.B. in carica dal ".$carica->getDataInizio('d/m/Y').")"; ?>
  				   | <?php echo link_to('vai alla classifica completa', 
  				                     'http://indice.openpolis.it') ?>
  				  </span>
  				
  				<span style="font-weight:normal; padding-top:7px; float:left; text-align:left;">L'indice di produttivit&agrave; non prende in considerazione il lavoro, anche rilevante, che alcuni parlamentari svolgono per gli incarichi necessari al funzionamento della macchina politica e amministrativa del Parlamento (Commissioni, Gruppi, Comitati, Giunte, Collegi e Uffici di Camera e Senato).
  				  Per una spiegazione dettagliata della metodologia di valutazione <a href="http://indice.openpolis.it/info.html"><strong>vai qui</strong></a>.
  				  </span>
  			</div>
		    
		    <!-- BOX PRESENZE -->
  			<h5 class="subsection-alt" style="margin:0">Presenze in <?php echo $nvotazioni ?> votazioni elettroniche</h5>
  			<p class="float-right">ultima votazione: <strong>
  			<?php if ($ramo=='camera') : ?>
  			   <?php echo format_date(OppVotazionePeer::doSelectDataUltimaVotazione('','','16','C'), 'dd/MM/yyyy') ?>
  			<?php elseif($ramo=='senato') : ?>
  			   <?php echo format_date(OppVotazionePeer::doSelectDataUltimaVotazione('','','16','S'), 'dd/MM/yyyy') ?>
  			<?php endif; ?>   
  			</strong></p> 
  			<p class="tools-container"><a class="ico-help" href="#">come sono calcolate</a></p>
  			<div style="display: none;" class="help-box float-container">
  				<div class="inner float-container">		
  					<a class="ico-close" href="#">chiudi</a><h5>come sono calcolate le presenze ?</h5>
  					<p>I dati sulle presenze si riferiscono alle votazioni elettroniche che si svolgono nell'Assemblea di Camera e Senato dall'inizio della legislatura. Le presenze dunque non si riferiscono a tutte le possibili attivit&agrave; parlamentari (lavori preparatori nelle Commissioni) ma solo al totale delle presenze nelle votazioni elettroniche in Aula.</p>
  				</div>
  			</div>
			
  			<!-- usare &nbsp; invece dello spazio, e' importante per il layout  !!  -->
  			<div class="meter-bar float-container">
  			<div class="meter-bar-container">
  			   <div class="meter-label"><strong class="green"><?php echo number_format($presenze_perc, 2) ?>%</strong>&nbsp;(<?php echo number_format($presenze, 0) ?>)</div>
  				<label>presenze:</label>
  				<div class="green-meter-bar">
  					<div style="left: <?php echo number_format($presenze_media_perc, 2) ?>%;" class="meter-average"><label>valore medio: <?php echo number_format($presenze_media_perc, 2) ?>%</label>&nbsp;</div>
  					<div style="width: <?php echo number_format($presenze_perc, 2) ?>%;" class="meter-value">&nbsp;</div>
  				</div> 
  			   </div>
  			   <div class="meter-bar-container">
  			     <label>assenze:</label>
  			     <div class="meter-label"><strong class="red"><?php echo number_format($assenze_perc, 2) ?>%</strong>&nbsp;(<?php echo number_format($assenze, 0) ?>)</div>
  				<div class="red-meter-bar">
  					<div style="left: <?php echo number_format($assenze_media_perc, 2) ?>%;" class="meter-average"><label>valore medio: <?php echo number_format($assenze_media_perc,2) ?>%</label>&nbsp;</div>								
  					<div style="width: <?php echo number_format($assenze_perc, 2) ?>%;" class="meter-value">&nbsp;</div>
  				</div>
  			    </div>
  			    <div class="meter-bar-container">	
  				<label>missioni:</label>
  				 <div class="meter-label"><strong class="blue"><?php echo number_format($missioni_perc, 2) ?>%</strong>&nbsp;(<?php echo number_format($missioni, 0) ?>)</div>
  				<div class="blue-meter-bar">
  					<div style="left: <?php echo number_format($missioni_media_perc, 2) ?>%;" class="meter-average"><label>valore medio: <?php echo number_format($missioni_media_perc, 2) ?>%</label>&nbsp;</div>
  					<div style="width: <?php echo $missioni_perc ?>%;" class="meter-value">&nbsp;</div>
  				</div>
  			    </div>	
  				<p class="float-right">
  				  <?php echo link_to('vai alla classifica', 
  				                     '@parlamentari?ramo=' . $ramo .
  				                      '&sort=presenze&type=desc') ?> 
  				</p>
  				<span style="font-weight:normal; padding-top:5px; float:left; text-align:left;">I regolamenti non prevedono la registrazione del motivo dell'assenza al voto del parlamentare. Non si può distinguere, pertanto, l'assenza ingiustificata da quella, ad esempio, per ragioni di salute.</span>
  			</div>
  			
  			<!-- BOX PER I VOTI CHIAVE -->
  			   <?php echo include_component('parlamentare','keyvote', array('carica' => $carica, 'ramo' => $ramo)) ?>
  			<!-- FINE VOTI CHIAVE -->
		 
  			<h5 class="subsection-alt">Voti ribelli: <?php echo number_format($ribelli, 0) ?> su <?php echo $nvoti_validi ?> votazioni nominali</h5>
			
  			<p class="tools-container"><a class="ico-help" href="#">quando un parlamentare &egrave; ribelle</a></p>
  			<div style="display: none;" class="help-box float-container">
  				<div class="inner float-container">		
  					<a class="ico-close" href="#">chiudi</a><h5>quando un parlamentare &egrave; ribelle ?</h5>
  					<p>Un parlamentare &egrave; considerato ribelle quando esprime un voto diverso da quello del gruppo parlamentare a cui appartiene. Si tratta di un indicatore puramente quantitativo del grado di ribellione alla "disciplina" del gruppo.</p>
  				</div>
  			</div>
			
  			<div class="meter-bar float-container"> 
  			  <div class="meter-bar-container">
  				<label>voti ribelli:</label>
  				<div class="meter-label"><strong class="violet"><?php echo number_format($ribelli_perc, 2) ?>%&nbsp</strong>(<?php echo link_to(number_format($ribelli, 0),'@parlamentare_voti?id='.$parlamentare->getId().'&filter_vote_rebel=1') ?>)</div>   
  				<div class="violet-meter-bar">
  					<div style="left: <?php echo number_format($ribelli_media_perc, 2) ?>%;" class="meter-average"><label>valore medio: <?php echo number_format($ribelli_media_perc, 2) ?>%</label>&nbsp;</div>									
  					<div style="width: <?php echo number_format($ribelli_perc, 2) ?>%;" class="meter-value">&nbsp;</div>
  				</div>
  			   </div>	
  				<?php if (count($gruppi) > 1): ?>
    				<div class="evidence-box">
    				 <div class="meter-bar-container">
    				  <?php foreach ($gruppi as $acronimo => $gruppo): ?>
      					<label>nel gruppo <?php echo $acronimo ?>:</label>
      					<div class="meter-label-long"><?php echo number_format(100*$gruppo['ribelle']/$gruppo['presenze'], 2) ?>%&nbsp;(<?php echo $gruppo['ribelle'] ?>&nbsp;su&nbsp;<?php echo $gruppo['presenze'] ?>&nbsp;votazioni)</div>
      					<div class="violet-meter-bar-short">
      					   <div style="left: <?php echo number_format($ribelli_media_perc, 2) ?>%;" class="meter-average"><label>valore medio: <?php echo number_format($ribelli_media_perc, 2) ?>%</label>&nbsp;</div>
      					   <div style="width: <?php echo number_format(100*$gruppo['ribelle']/$gruppo['presenze'], 2) ?>%;" class="meter-value">&nbsp;</div>		    
    				           </div>
    				  <?php endforeach ?>
    				 </div>
    				</div>   				  
  				<?php endif ?>
  				<p class="float-right">
  				  <?php echo link_to('vai alla lista dei voti ribelli', 
  				                     '@parlamentare_voti?id='.$parlamentare->getId().'&filter_vote_rebel=1') ?> | 
  				  <?php echo link_to('vai alla classifica', 
  				                     '@parlamentari?ramo=' . $ramo .
  				                      '&sort=ribelle&type=desc') ?>
  				</p>
  			</div>  			
                  <?php include_component('parlamentare', 'attiPresentati', 
                                array('parlamentare' => $parlamentare)) ?>
                 
                 <?php endif ?>             
              
                               

		 
  		</div>
	  </div>
  </div>

    <div class="clear-both"></div>
		
  </div>
</div>

<?php slot('breadcrumbs') ?>
  <?php echo link_to("home", "@homepage") ?> /
  <?php if ($carica) : ?>
   <?php if($ramo =='senato' ): ?>
    <?php echo link_to('senatori', '@parlamentari?ramo=senato') ?> /
    Sen. 
   <?php else: ?>
    <?php echo link_to('deputati', '@parlamentari?ramo=camera') ?> /
    On.
   <?php endif; ?>
   <?php endif; ?> 
  <?php echo $parlamentare->getNome() ?>&nbsp;<?php echo $parlamentare->getCognome() ?>
<?php end_slot() ?>