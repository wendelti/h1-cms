<?php

class BaseModel extends CI_Model {
    // table name
    protected $tabela;	
    protected $camposBusca;
    
    public $IDTabela;
    public $orderby = null;
    public $select = "*";
    public $listaAlias = null;
    public $log = true;
	// get number of paginas in database
	public function count_all($where = NULL){
        $this->joins();
        if($where != NULL){
        	$whereArray = json_decode($where);
        	foreach($whereArray as $k => $v){
        		if(!empty($v) and  trim($v) != '' and  trim($v) != '0'){
	        		if($this->listaAlias != null){
						if(isset($this->listaAlias[$k])){
							$this->db->like($this->listaAlias[$k],$v);
		          		}else{
							$this->db->like($k,$v);
	          			}						
					} else {
	          			$this->db->like($k,$v);
					}
					
				}				
			}
        }
	$this->db->from($this->tabela);
	return $this->db->count_all_results();
	}
	// get persons with paging
	public function get_paged_list($limit = 20, $offset = 0, $where = NULL){
		
		$this->db->query('SET SQL_BIG_SELECTS=1');
        $this->db->select($this->select);
        $this->joins();
        if($where != NULL){
        	$whereArray = json_decode($where);
        	foreach($whereArray as $k => $v){
        		if(!empty($v) and  trim($v) != ''){
	        		if($this->listaAlias != null){
						if(isset($this->listaAlias[$k])){
							$this->db->like($this->listaAlias[$k],$v);
		          		}else{
							$this->db->like($k,$v);
	          			}						
					} else {
	          			$this->db->like($k,$v);
					}
					
				}				
			}
        }
        
		
		if($this->orderby != NULL)
			$this->db->order_by($this->orderby);
		else
			$this->db->order_by($this->IDTabela,'asc');
		
		//return 
		if($limit > 0)
			$dt = $this->db->get($this->tabela, $limit, $offset);
		else
			$dt = $this->db->get($this->tabela);
		
		/*die($this->db->last_query());
		print_r($dt);*/
		return $dt;
	}
	
	public function joins(){
		
	}
	// get person by id
	public function get_by_id($id){
		$this->db->where($this->IDTabela, $id);
		return $this->db->get($this->tabela);
	}




	// add new pagina
	public function save($registro){                                             
		$this->db->insert($this->tabela, $registro);
		$id = $this->db->insert_id();
		return $id;
	}
	// update pagina by id
	public function update($id, $registro){
		$this->db->where($this->IDTabela, $id);
		$this->db->update($this->tabela, $registro);
	}
	// delete pagina by id
	public function delete($id){
		$this->db->where($this->IDTabela, $id);
		$this->db->delete($this->tabela);
	}
	// delete pagina by id

}

?>