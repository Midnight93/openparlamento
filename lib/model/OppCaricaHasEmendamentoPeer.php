<?php

/**
 * Subclass for performing query and update operations on the 'opp_carica_has_emendamento' table.
 *
 * 
 *
 * @package lib.model
 */ 
class OppCaricaHasEmendamentoPeer extends BaseOppCaricaHasEmendamentoPeer
{

  /**
   * estrae tutte le firme per un determinato emendamento, prima di una determinata data
   *
   * @param string $emendamento_id 
   * @param string $data 
   * @return array di hash ('carica_id' => ID, 'data' => DATA)
   * @author Guglielmo Celata
   */
  public static function getFirme($emendamento_id, $data)
  {
    $con = Propel::getConnection(self::DATABASE_NAME);
    $sql = sprintf("select ce.carica_id, ce.data from opp_carica_has_emendamento ce where ce.emendamento_id=%d and ce.data < '%s';",
                   $emendamento_id, $data);
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);
    
    $firme = array();
    while ($rs->next()) {
      $row = $rs->getRow();
      $firme []= array('carica_id' => $row['carica_id'], 'data' => $row['data']);
    }
		return $firme;		
  }

  
  public static function countSignedByAtDate($carica_id, $date)
  {
    $c = new Criteria();
    $c->add(self::CARICA_ID, $carica_id);
    $c->add(self::DATA, $date);
    return self::doCount($c);
  }
  

  /**
   * torna i ddl collegati agli emendamenti firmati dalle cariche
   *
   * @param string $cariche_ids 
   * @return array di OppAtto
   * @author Guglielmo Celata
   */
  public static function getDDLCollegatiCariche($cariche_ids)
  {
		$con = Propel::getConnection(self::DATABASE_NAME);
    $sql = sprintf("select ae.atto_id, count(ae.atto_id) n_emendamenti from opp_carica_has_emendamento ce, opp_emendamento e, opp_atto_has_emendamento ae where ae.emendamento_id=e.id and e.id=ce.emendamento_id and ce.carica_id in (%s) and ae.portante=1 group by ae.atto_id order by n_emendamenti desc",
                   implode(",", $cariche_ids));
    $stm = $con->createStatement(); 
    $rs = $stm->executeQuery($sql, ResultSet::FETCHMODE_ASSOC);
    
    $ddl = array();
    while ($rs->next()) {
      $row = $rs->getRow();
      $ddl [] = OppAttoPeer::retrieveByPK($row['atto_id']);
    }
    
    return $ddl;
    
  }
  
}
