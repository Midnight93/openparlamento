<?php

/**
 * Subclass for performing query and update operations on the 'opp_alert_term' table.
 *
 * 
 *
 * @package lib.model
 */ 
class OppAlertTermPeer extends BaseOppAlertTermPeer
{
  
  /**
   * if a term is not in the op_alert_term table, then insert it, fetch and return it
   *
   * @param string $term 
   * @return OppAlertTerm
   * @author Guglielmo Celata
   */
  public static function fetchOrInsert($term)
  {
    $term_obj = self::retrieveByTerm($term);

    if ($term_obj == null)
      $term_obj = self::addTerm($term);
      
    return $term_obj;
  }
  
  /**
   * add a term to the op_alert_term table
   *
   * @param string $term 
   * @return void
   * @author Guglielmo Celata
   */
  public static function addTerm($term)
  {
    $term_obj = new OppAlertTerm();
    $term_obj->setTerm($term);
    $term_obj->save();
    return $term_obj;
  }
  
  public static function retrieveByTerm($term)
  {
    $c = new Criteria();
    $c->add(self::TERM, $term);
    return self::doSelectOne($c);
  }
}
