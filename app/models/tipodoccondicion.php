<?php

class tipodoccondicion extends \Phalcon\Mvc\Model
{
    
    /**
     * 
     * @var integer
     */
    public $id;
    
    /**
     * 
     * @var integer
     */
    public $tipodocumento_id;
    
    /**
     * 
     * @var integer
     */
    public $condicion_id;
    
    /**
     * 
     * @var integer
     */
    public $baja_logica;
    
    /**
     * Initialize method for model.
     */
    public function initialize() {
        $this->setSchema("");
    }
    
    /**
     * Independent Column Mapping
     */
    public function columnMap() {
        return array(
            'id' => 'id',
            'tipodocumento_id' => 'tipodocumento_id',
            'condicion_id' => 'condicion_id',
            'baja_logica' => 'baja_logica'
        );
    }
    
    /**
     * Lista documentos presentados y no presentados por ci de persona
     */
    public function listaDocXPersona($ci) {
        $sql_query = "SELECT p.id AS per_id, c.condicion, td.id AS tipo_doc_id, td.tipo_documento, td.sexo , pd.id AS doc_presentado_id 
                      FROM personas p, relaborales rl, finpartidas fp, condiciones c, tipodoccondicion tdc, tipodocumento td 
                      LEFT JOIN presentaciondoc pd ON pd.tipodocumento_id = td.id
                      WHERE p.id = rl.persona_id AND fp.id = rl.finpartida_id AND c.id = fp.condicion_id AND c.id = tdc.condicion_id AND td.id = tdc.tipodocumento_id
                      AND p.baja_logica = 1 AND rl.baja_logica = 1 AND tdc.baja_logica = 1 AND td.baja_logica = 1
                      AND p.ci = '".$ci."'
                      ORDER BY tdc.tipodocumento_id";
        return new Resultset(null, $this->_db, $this->_db->getReadConnection()->query($sql_query));
    }
}
