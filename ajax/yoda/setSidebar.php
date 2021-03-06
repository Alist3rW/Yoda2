<?php 

require_once "../ajaxDatabaseInit.php";

$select= $bdd->queryObj('SELECT * FROM CFG_PREFERENCES '
        . 'WHERE CPR_ID_USR = "'.$_REQUEST['idUser'].'"');

if(count($select) > 0){
    
    $update = $bdd->prepare('UPDATE CFG_PREFERENCES '
        . 'SET CPR_SIDEBAR = :sidebar, '
        . 'CPR_THEME = :theme, '
        . 'CPR_COLOR_PLANNING = :color, '
        . 'CPR_LABEL_PLANNING = :label '
        . 'WHERE CPR_ID_USR = :id ');
    
    $update ->execute(array(
        'sidebar' => $_REQUEST['value'],
        'theme' => $select[0]->CPR_THEME,
        'color' => $select[0]->CPR_COLOR_PLANNING,
        'label' => $select[0]->CPR_LABEL_PLANNING,
        'id' => $_REQUEST['idUser']
        
    ));

} else {
    $update = $bdd->prepare('INSERT INTO CFG_PREFERENCES '
        . '(CPR_SIDEBAR, CPR_ID_USR) VALUES '
        . '(:sidebar, :id)');
    
    $update ->execute(array(
        'sidebar' => $_REQUEST['value'],
        'id' => $_REQUEST['idUser']
        
        ));

} 

?>