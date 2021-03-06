<?php

/**
 * Subclass for representing a row from the 'opp_esito_seduta' table.
 *
 * 
 *
 * @package lib.model
 */ 
class OppEsitoSeduta extends BaseOppEsitoSeduta
{

  public function getURL()
  {
    if (strpos($this->url, "http://") === false) {
      $url = sfConfig::get('app_url_sito_camera', 'http://nuovo.camera.it/') . $this->url;
    } else
      $url = $this->url;
    
    return $url;
  }
  

  /**
   * torna l'oggetto Apache_Solr_Document da indicizzare
   *
   * @return Apache_Solr_Document
   * @author Guglielmo Celata
   */
  public function intoSolrDocument()
  {
    $document = new Apache_Solr_Document();

    $id = $this->getId();
    $document->id = md5('OppEsitoSeduta' . $id);
    $document->sfl_model = 'OppEsitoSeduta';
    $document->sfl_type = 'model';

    $document->propel_id = $id;

    $document->testo = $this->getEsito();

    if ($this->getData())
      $document->data_dt = $this->getData('%Y-%m-%dT%H:%M:%SZ');

    $document->created_at_dt = $this->getCreatedAt('%Y-%m-%dT%H:%M:%SZ');

    // ritorna il documento da aggiungere
    return $document;
  }

}

sfPropelBehavior::add(
  'OppEsitoSeduta',
  array('deppPropelActAsNewsGeneratorBehavior' =>
        array('monitorable_models' => array( 'OppAtto' => 'getOppAtto'),
              'date_method'        => 'Data',
              'priority'           => '2',
        )));

// disattivato (#383)        
// sfSolrPropelBehavior::getInitializer()->setupModel('OppEsitoSeduta');

