<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Books_info extends CI_Model {

	public function books( $title = null, $author = null, $genre = null, $section = null, $is_ajax = null ) {
		$books = array();
		$this->db->select( '*' );
		$this->db->from( 'book_info' );

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
			foreach( $qry->result() as $row ) {
				$gr_genre = $this->getRow( 'genre', 'genre', 'id', $row->genre );
				$sc_section = $this->getRow( 'section', 'section', 'id', $row->section );
				$copies = $this->checkBook( $row->id );
				if( $copies > 0 ) {
					$books[] = array( $row->id, $row->title, $row->author, $gr_genre, $sc_section, $row->genre, $row->section, $copies, $row->copies );
				}
			}
		}
		return $books;
	}

	public function checkBook( $id ) {
		$b_book = 0;
		$c_book = 0;
		$qry = $this->db->query( "SELECT COUNT(*) as books FROM borrowed INNER JOIN book_info ON borrowed.book = book_info.id WHERE borrowed.status = 0 AND borrowed.book = " . $id );
		if( $qry->num_rows() > 0 ) {
			foreach( $qry->result() as $row ) {
				$b_book = $row->books;
			}
		} else {
			$b_book = 0;
		}

		$qry2 = $this->db->query( "SELECT copies FROM book_info WHERE id = " . $id );
		if( $qry2->num_rows() > 0 ) {
			foreach( $qry2->result() as $row2 ) {
				$c_book = $row2->copies;
			}
		} else {
			$c_book = 0;
		}

		return ( $c_book - $b_book );
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