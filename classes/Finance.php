<?php

class Finance
{
  // Properties

  public $id = null;
  public $date = null;
  public $sum = null;
  public $description = null;
  public $currency = null;


  public function __construct( $data = array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['date'] ) ) $this->publicationDate = (int) $data['date'];
    if ( isset( $data['sum'] ) ) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['sum'] );
    if ( isset( $data['description'] ) ) $this->summary = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['description'] );
    if ( isset( $data['currency'] ) ) preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['currency'] );;
  }


  public function storeFormValues ( $params ) {

    // Store all the parameters
    $this->__construct( $params );

    // Parse and store the date
    if ( isset($params['date']) ) {
      $date = explode ( '-', $params['date'] );

      if ( count($date) == 3 ) {
        list ( $y, $m, $d ) = $date;
        $this->publicationDate = mktime ( 0, 0, 0, $m, $d, $y );
      }
    }
  }

  public static function getById( $id, $table ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT *, UNIX_TIMESTAMP(date) AS date FROM :table WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->bindValue( ":table", $table, PDO::PARAM_STR);
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Article( $row );
  }

//  public static function getList( $numRows=1000000, $order="publicationDate DESC" ) {
//    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
//    $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM articles
//            ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";
//
//    $st = $conn->prepare( $sql );
//    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
//    $st->execute();
//    $list = array();
//
//    while ( $row = $st->fetch() ) {
//      $article = new Article( $row );
//      $list[] = $article;
//    }
//
//    // Now get the total number of articles that matched the criteria
//    $sql = "SELECT FOUND_ROWS() AS totalRows";
//    $totalRows = $conn->query( $sql )->fetch();
//    $conn = null;
//    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
//  }
//
//
//  /**
//  * Inserts the current Article object into the database, and sets its ID property.
//  */
//
//  public function insert() {
//
//    // Does the Article object already have an ID?
//    if ( !is_null( $this->id ) ) trigger_error ( "Article::insert(): Attempt to insert an Article object that already has its ID property set (to $this->id).", E_USER_ERROR );
//
//    // Insert the Article
//    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
//    $sql = "INSERT INTO articles ( publicationDate, title, summary, content ) VALUES ( FROM_UNIXTIME(:publicationDate), :title, :summary, :content )";
//    $st = $conn->prepare ( $sql );
//    $st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
//    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
//    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
//    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
//    $st->execute();
//    $this->id = $conn->lastInsertId();
//    $conn = null;
//  }
//
//
//  /**
//  * Updates the current Article object in the database.
//  */
//
//  public function update() {
//
//    // Does the Article object have an ID?
//    if ( is_null( $this->id ) ) trigger_error ( "Article::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR );
//
//    // Update the Article
//    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
//    $sql = "UPDATE articles SET publicationDate = FROM_UNIXTIME(:publicationDate), title=:title, summary=:summary, content=:content WHERE id = :id";
//    $st = $conn->prepare ( $sql );
//    $st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
//    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
//    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
//    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
//    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
//    $st->execute();
//    $conn = null;
//  }
//
//
//  /**
//  * Deletes the current Article object from the database.
//  */
//
//  public function delete() {
//
//    // Does the Article object have an ID?
//    if ( is_null( $this->id ) ) trigger_error ( "Article::delete(): Attempt to delete an Article object that does not have its ID property set.", E_USER_ERROR );
//
//    // Delete the Article
//    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
//    $st = $conn->prepare ( "DELETE FROM articles WHERE id = :id LIMIT 1" );
//    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
//    $st->execute();
//    $conn = null;
//  }

}

?>
