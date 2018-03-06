<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Books_info extends CI_Model {

	public function books( $title = null, $author = null, $genre = null, $section = null, $is_ajax = null ) {
		//$this->db->select( 'book_info.id, book_info.title, book_info.author, book_info.genre, book_info.section, genre.genre as gr_genre, section.section as sc_section' );
		$this->db->select( '*' );
		$this->db->from( 'book_info' );
		/*$this->db->join( 'genre', 'genre.id = book_info.genre', 'INNER' );
		$this->db->join( 'section', 'section.id = book_info.section', 'INNER' );*/

		if( $is_ajax == 1 ) {
			if( !empty( $title ) ) {
				$this->db->where( 'book_info.title', $title );
			}
			if( !empty( $author ) ) {
				$this->db->where( 'book_info.author', $author );
			}
			if( !empty( $genre ) ) {
				$this->db->where( 'book_info.genre', $genre );
			}
			if( !empty( $section ) ) {
				$this->db->where( 'book_info.section', $section );
			}
		}

		$this->db->order_by( 'book_info.title', 'ASC' );
		$qry = $this->db->get();
		if( $qry->num_rows() > 0 ) {
			$books = array();
			foreach( $qry->result() as $row ) {
				$gr_genre = $this->getRow( 'genre', 'genre', 'id', $row->genre );
				$sc_section = $this->getRow( 'section', 'section', 'id', $row->section );
				if( $this->checkBook( $row->id ) != $row->id ) {
					$books[] = array( $row->id, $row->title, $row->author, $gr_genre, $sc_section, $row->genre, $row->section );
				}
			}
			return $books;
		} else {
			return false;
		}
	}

	public function checkBook( $id ) {
		$qry = $this->db->query( "SELECT borrowed.book as book_id FROM borrowed INNER JOIN book_info ON borrowed.book = book_info.id WHERE borrowed.status = 0 AND borrowed.book = " . $id );
		if( $qry->num_rows() > 0 ) {
			$book = 0;
			foreach( $qry->result() as $row ) {
				$book = $row->book_id;
			}
			return $book;
		} else {
			return 0;
		}
	}

	public function borrowed() {
		$qry = $this->db->query( "SELECT borrowed.id, borrowed.date_borrowed, borrowed.date_returned, borrowed.status, book_info.title, book_info.id as book_id FROM borrowed INNER JOIN book_info ON borrowed.book = book_info.id ORDER BY book_info.title ASC" );
		if( $qry->num_rows() > 0 ) {
			$books = array();
			foreach( $qry->result() as $row ) {
				$books[] = array( $row->id, $row->title, $row->date_borrowed, $row->date_returned, $row->status, $row->book_id );
			}
			return $books;
		} else {
			return false;
		}
	}

	public function insertData( $table, $data ) {
		$this->db->trans_begin();
		$this->db->set( $data );
		$this->db->insert( $table );

		if( $this->db->trans_status() == FALSE ) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}

	public function updateData( $table, $data, $condition ) {
		$this->db->trans_begin();
		$this->db->where( $condition );
		$this->db->update( $table, $data );

		if( $this->db->trans_status() == FALSE ) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}

	public function deleteData( $table, $target, $pass ) {
		$this->db->trans_begin();
		$this->db->where( $target, $pass );
		$this->db->delete( $table );

		if( $this->db->trans_status() == FALSE ) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}

	public function getData( $table, $get = null, $order = null, $by = null ) {
		if( empty( $order ) || empty( $by ) || empty( $get ) ) {
			$qry = $this->db->query( "SELECT * FROM $table" );
		} else {
			$qry = $this->db->query( "SELECT $get FROM $table ORDER BY $order $by" );
		}

		if( $qry->num_rows() > 0 ) {
			return $qry->result();
		} else {
			return false;
		}
	}

	public function getRow( $table, $get, $target, $pass ) {
		$res = '';
		$qry = $this->db->query( "SELECT $get FROM $table WHERE $target = $pass" );
		if( $qry->num_rows() > 0 ) {
			foreach( $qry->result() as $row ) {
				$res = $row->$get;
			}
		}
		return $res;
	} 

}