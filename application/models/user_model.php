<?php
class User_model extends CI_Model {

    function add_user($name, $alias, $email, $password, $dob) {
        $query = "INSERT INTO users (name, alias, email, password, dob) VALUES (?,?,?,?,?)";
        $values = array($name, $alias, $email, $password, $dob); 
        return $this->db->query($query, $values);
    }

    function log_in($email, $password){
        $query = "SELECT users.id, users.name, users.email
                  FROM users
                  WHERE email = ?
                  AND password = ?";
        $values = array($email, $password);
        return $this->db->query($query, $values)->row_array();
    }

    function add_quote($userID, $author, $quote){
        $query = "INSERT INTO quotes (users_id, author, quote) VALUES (?,?,?)";
        $values = array($userID, $author, $quote); 
        return $this->db->query($query, $values);
    }

    public function get_quotes($id) {
        $query =    "Select quotes.id, quotes.author, quotes.quote, users.alias
                     FROM quotes
                     LEFT JOIN users ON quotes.users_id = users.id
                     ORDER BY quotes.created_at DESC" ;
        return $this->db->query($query, array($id))->result_array();
    }

    public function add_favorite($userID, $quote_id){
        $query = "INSERT INTO favorites (users_id, quotes_id) VALUES (?,?)";
        $values = array($userID, $quote_id); 
        return $this->db->query($query, $values);
    }

    public function get_favorites($id) {
        $query =    "Select favorites.quotes_id, quotes.author, quotes.quote, users.alias
                     FROM favorites
                     LEFT JOIN quotes ON favorites.quotes_id = quotes.id
                     LEFT JOIN users ON favorites.users_id = users.id
                     WHERE favorites.users_id = ?
                     ORDER BY quotes.created_at DESC;";
        return $this->db->query($query, array($id))->result_array();
    }

    public function remove_favorite($userID, $quoteID) {
        $query  = "DELETE FROM favorites WHERE users_id = ? AND quotes_id = ?";
        $values = array($userID, $quoteID);
        return $this->db->query($query, $values);  
    }
}
?>