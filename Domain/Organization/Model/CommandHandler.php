<?php

namespace lwOrganizations\Domain\Organization\Model;

class CommandHandler
{
    private $table;
    private $db;
    private $type;
    
    public function __construct($db)
    {
        $this->table = "lw_master";
        $this->db = $db;
        $this->type = "lw_organisation";
    }
        
    /**
     * Creation of a new Event
     * @param \LWddd\ValueObject $entity
     * @return true/exception
     */
    public function addEntity($array)
    {
        $this->db->setStatement("INSERT INTO t:".$this->table." ( lw_object, category_id, name, opt1text, lw_first_date, lw_last_date ) VALUES ( :lw_object, :category, :name, :shortcut, :first_date, :last_date ) ");
        $this->db->bindParameter("lw_object", "s", $this->type);
        $this->db->bindParameter("category", "s", $array['category_id']);
        $this->db->bindParameter("name", "s", htmlentities($array['name'], ENT_QUOTES, "ISO-8859-1"));
        $this->db->bindParameter("shortcut", "s", htmlentities($array['opt1text'], ENT_QUOTES, "ISO-8859-1"));
        $this->db->bindParameter("first_date", "s", date("YmdHis"));
        $this->db->bindParameter("last_date", "s", date("YmdHis"));
        return $this->db->pdbinsert($this->table);
    }
    
    /**
     * An Event with certain id will be updated
     * @param int $id
     * @param \LWddd\ValueObject $entity
     * @return true/exception
     */
    public function saveEntity($id, $array)
    {
        $this->db->setStatement("UPDATE t:".$this->table." SET name = :name, opt1text = :shortcut, lw_last_date = :last_date WHERE id = :id AND lw_object = :lw_object ");
        $this->db->bindParameter("lw_object", "s", $this->type);
        $this->db->bindParameter("id", "i", $id);
        $this->db->bindParameter("name", "s", htmlentities($array['name'], ENT_QUOTES, "ISO-8859-1"));
        $this->db->bindParameter("shortcut", "s", htmlentities($array['opt1text'], ENT_QUOTES, "ISO-8859-1"));
        $this->db->bindParameter("last_date", "s", date("YmdHis"));
        return $this->db->pdbquery();
    }
    
    public function deleteEntityById($id)
    {
        $this->db->setStatement("DELETE FROM t:".$this->table." WHERE id = :id AND lw_object = :lw_object ");
        $this->db->bindParameter("lw_object", "s", $this->type);
        $this->db->bindParameter("id", "i", $id);
        return $this->db->pdbquery();
    }
}