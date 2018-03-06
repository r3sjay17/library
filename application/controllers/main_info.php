<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main_info extends CI_Controller {

	public function __construct( $config = 'rest' ) {
	    header('Access-Control-Allow-Origin: *');
	    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	    parent::__construct();
	}

	public function books() {
		$status = FALSE;
		$is_ajax = 0;
		$output = '';
		$title = '';
		$author = '';
		$genre = '';
		$section = '';
		if( isset( $_POST['s_title'] ) ) {
			$title = $_POST['s_title'];
		}
		if( isset( $_POST['s_author'] ) ) {
			$author = $_POST['s_author'];
		}
		if( isset( $_POST['s_genre'] ) ) {
			$genre = $_POST['s_genre'];
		}
		if( isset( $_POST['s_section'] ) ) {
			$section = $_POST['s_section'];
		}
		if( isset( $_POST['is_ajax'] ) ) {
			$is_ajax = $_POST['is_ajax'];
		}

		$this->load->model( 'books_info' );
		$books = $this->books_info->books( $title, $author, $genre, $section, $is_ajax );
		if( !empty( $books ) ) {
			foreach( $books as $book ) {
					$output .= '<tr>';
						$output .= '<td>'.$book[1].'</td>';
						$output .= '<td>'.$book[2].'</td>';
						$output .= '<td>'.$book[3].'</td>';
						$output .= '<td>'.$book[4].'</td>';
						$output .= '<td>';
							$output .= '<a href="#" class="btn btn-edit-book" data-book="'.$book[0].','.$book[1].','.$book[2].','.$book[5].','.$book[6].'"><i class="fa fa-pencil-square-o"></i></a>';
							$output .= '<a href="#" class="btn btn-delete-book" data-book="book_info,id,'.$book[0].'"><i class="fa fa-trash-o"></i></a>';
						$output .= '</td>';
					$output .= '</tr>';
			}
			$status = TRUE;
		} else {
			$output .= '<tr>';
				$output .= '<td></td>';
				$output .= '<td></td>';
				$output .= '<td></td>';
				$output .= '<td></td>';
				$output .= '<td></td>';
			$output .= '</tr>';
			$status = FALSE;
		}

		if( $is_ajax == 1 ) {
			$response['status'] = $status;
			$response['results'] = $output;
			echo json_encode( $response );
			exit;
		} else {
			return $output;
		}
	}

	public function allGenre() {
		$output = '';
		$x = 0;
		$this->load->model( 'books_info' );
		$genres = $this->books_info->getData( 'genre', '*', 'genre', 'ASC' );
		if( !empty( $genres ) ) {
			foreach( $genres as $genre ) {
				$x++;
				$output .= '<tr>';
					$output .= '<td>'.$x.'</td>';
					$output .= '<td>'.$genre->genre.'</td>';
					$output .= '<td>';
						$output .= '<a href="#" class="btn btn-edit-genre" data-genre="'.$genre->id.','.$genre->genre.'"><i class="fa fa-pencil-square-o"></i></a>';
						$output .= '<a href="#" class="btn btn-delete-genre" data-genre="genre,id,'.$genre->id.'"><i class="fa fa-trash-o"></i></a>';
					$output .= '</td>';
				$output .= '</tr>';
			}
		} else {
			$output = '<tr>';
				$output .= '<td></td>';
				$output .= '<td></td>';
				$output .= '<td></td>';
			$output .= '</tr>';
		}
		return $output;
	}

	public function allSection() {
		$output = '';
		$x = 0;
		$this->load->model( 'books_info' );
		$sections = $this->books_info->getData( 'section', '*', 'section', 'ASC' );
		if( !empty( $sections ) ) {
			foreach( $sections as $section ) {
				$x++;
				$output .= '<tr>';
					$output .= '<td>'.$x.'</td>';
					$output .= '<td>'.$section->section.'</td>';
					$output .= '<td>';
						$output .= '<a href="#" class="btn btn-edit-section" data-section="'.$section->id.','.$section->section.'"><i class="fa fa-pencil-square-o"></i></a>';
						$output .= '<a href="#" class="btn btn-delete-section" data-section="section,id,'.$section->id.'"><i class="fa fa-trash-o"></i></a>';
					$output .= '</td>';
				$output .= '</tr>';
			}
		} else {
			$output = '<tr>';
				$output .= '<td></td>';
				$output .= '<td></td>';
				$output .= '<td></td>';
			$output .= '</tr>';
		}
		return $output;
	}

	public function allBorrowed() {
		$output = '';
		$x = 0;
		$this->load->model( 'books_info' );
		$borroweds = $this->books_info->borrowed();
		if( !empty( $borroweds ) ) {
			foreach( $borroweds as $borrowed ) {
				$x++;
				$status = ( $borrowed[4] == 0 ) ? "---" : "Returned";
				$dt_borrowed = ( $borrowed[2] == "0000-00-00" ) ? "---" : date( 'M j, Y', strtotime( $borrowed[2] ) );
				$dt_returned = ( $borrowed[3] == "0000-00-00" ) ? "---" : date( 'M j, Y', strtotime( $borrowed[3] ) );
				$output .= '<tr>';
					$output .= '<td>'.$x.'</td>';
					$output .= '<td>'.$borrowed[1].'</td>';
					$output .= '<td>'.$dt_borrowed.'</td>';
					$output .= '<td>'.$dt_returned.'</td>';
					$output .= '<td>'.$status.'</td>';
					$output .= '<td>';
						$output .= '<a href="#" class="btn btn-edit-borrowed" data-borrowed="'.$borrowed[0].','.$borrowed[5].','.$borrowed[2].','.$borrowed[3].','.$borrowed[4].'"><i class="fa fa-pencil-square-o"></i></a>';
						$output .= '<a href="#" class="btn btn-delete-borrowed" data-borrowed="borrowed,id,'.$borrowed[0].'"><i class="fa fa-trash-o"></i></a>';
					$output .= '</td>';
				$output .= '</tr>';
			}
		} else {
			$output = '<tr>';
				$output .= '<td></td>';
				$output .= '<td></td>';
				$output .= '<td></td>';
				$output .= '<td></td>';
				$output .= '<td></td>';
				$output .= '<td></td>';
			$output .= '</tr>';
		}
		return $output;
	}

	public function index() {
		$data['title'] = "Rio's Library";
		$data['header'] = "Books Information";

		$this->load->model( 'books_info' );
		$data['books'] = $this->books();
		$data['active'] = "books";
		$data['book_info'] = $this->books_info->books();
		$data['genres'] = $this->books_info->getData( 'genre' );
		$data['sections'] = $this->books_info->getData( 'section' );

		$this->load->view( 'layouts/header', $data );
		$this->load->view( 'layouts/sidebar', $data );
		$this->load->view( 'books', $data );
		$this->load->view( 'layouts/footer' );
		$this->load->view( 'layouts/modals', $data );
	}

	public function genre() {
		$data['title'] = "Rio's Library";
		$data['header'] = "Genres";
		$data['active'] = "genre";
		$data['genre'] = $this->allGenre();

		$this->load->view( 'layouts/header', $data );
		$this->load->view( 'layouts/sidebar', $data );
		$this->load->view( 'genre', $data );
		$this->load->view( 'layouts/footer' );
		$this->load->view( 'layouts/modals', $data );
	}

	public function section() {
		$data['title'] = "Rio's Library";
		$data['header'] = "Sections";
		$data['active'] = "section";
		$data['section'] = $this->allSection();

		$this->load->view( 'layouts/header', $data );
		$this->load->view( 'layouts/sidebar', $data );
		$this->load->view( 'section', $data );
		$this->load->view( 'layouts/footer' );
		$this->load->view( 'layouts/modals', $data );
	}

	public function borrowed() {
		$data['title'] = "Rio's Library";
		$data['header'] = "Borrowed Books";
		$data['active'] = "borrowed";
		$data['borrowed'] = $this->allBorrowed();
		$data['book_info'] = $this->books_info->getData( 'book_info' );

		$this->load->view( 'layouts/header', $data );
		$this->load->view( 'layouts/sidebar', $data );
		$this->load->view( 'borrowed', $data );
		$this->load->view( 'layouts/footer' );
		$this->load->view( 'layouts/modals', $data );
	}

	public function addBook() {
		$response = array();
		$table = 'book_info';
		$mode = $_POST['bk_mode'];
		$title = $_POST['bk_title'];
		$author = $_POST['bk_author'];
		$genre = $_POST['bk_genre'];
		$section = $_POST['bk_section'];
		$is_ajax = $_POST['is_ajax'];

		$data = array(
			'title' => $title,
			'author' => $author,
			'genre' => $genre,
			'section' => $section
		);
		if( $is_ajax == 1 ) {
			$this->load->model( 'books_info' );

			if( $mode == 0 ) {
				$result = $this->books_info->insertData( $table, $data );
			} else {
				$condition = array( 'id' => $mode );
				$result = $this->books_info->updateData( $table, $data, $condition );
			}

			if( $result ) {
				$response['status'] = TRUE;
				$response['results'] = $this->books();
			} else {
				$output = '<tr>';
					$output .= '<td></td>';
					$output .= '<td></td>';
					$output .= '<td></td>';
					$output .= '<td></td>';
					$output .= '<td></td>';
				$output .= '</tr>';
				$response['status'] = FALSE;
				$response['results'] = $output;
			} 
		}
		echo json_encode( $response );
		exit;
	}

	public function addGenre() {
		$response = array();
		$table = 'genre';
		$mode = $_POST['gr_mode'];
		$genre = $_POST['gr_genre'];
		$is_ajax = $_POST['is_ajax'];

		$data = array(
			'genre' => $genre
		);
		if( $is_ajax == 1 ) {
			$this->load->model( 'books_info' );

			if( $mode == 0 ) {
				$result = $this->books_info->insertData( $table, $data );
			} else {
				$condition = array( 'id' => $mode );
				$result = $this->books_info->updateData( $table, $data, $condition );
			}

			if( $result ) {
				$response['status'] = TRUE;
				$response['results'] = $this->allGenre();
			} else {
				$output = '<tr>';
					$output .= '<td></td>';
					$output .= '<td></td>';
					$output .= '<td></td>';
				$output .= '</tr>';
				$response['status'] = FALSE;
				$response['results'] = $output;
			} 
		}
		echo json_encode( $response );
		exit;
	}

	public function addSection() {
		$response = array();
		$table = 'section';
		$mode = $_POST['sc_mode'];
		$section = $_POST['sc_section'];
		$is_ajax = $_POST['is_ajax'];

		$data = array(
			'section' => $section
		);
		if( $is_ajax == 1 ) {
			$this->load->model( 'books_info' );

			if( $mode == 0 ) {
				$result = $this->books_info->insertData( $table, $data );
			} else {
				$condition = array( 'id' => $mode );
				$result = $this->books_info->updateData( $table, $data, $condition );
			}

			if( $result ) {
				$response['status'] = TRUE;
				$response['results'] = $this->allSection();
			} else {
				$output = '<tr>';
					$output .= '<td></td>';
					$output .= '<td></td>';
					$output .= '<td></td>';
				$output .= '</tr>';
				$response['status'] = FALSE;
				$response['results'] = $output;
			} 
		}
		echo json_encode( $response );
		exit;
	}

	public function addBorrowed() {
		$response = array();
		$table = 'borrowed';
		$mode = $_POST['br_mode'];
		$book = $_POST['br_book'];
		$date_borrowed = $_POST['br_date_borrowed'];
		$date_returned = $_POST['br_date_returned'];
		$status = $_POST['br_status'];
		$is_ajax = $_POST['is_ajax'];

		$data = array(
			'book' => $book,
			'date_borrowed' => $date_borrowed,
			'date_returned' => $date_returned,
			'status' => $status
		);
		if( $is_ajax == 1 ) {
			$this->load->model( 'books_info' );
			if( $mode == 0 ) {
				$result = $this->books_info->insertData( $table, $data );
			} else {
				$condition = array( 'id' => $mode );
				$result = $this->books_info->updateData( $table, $data, $condition );
			}

			if( $result ) {
				$response['status'] = TRUE;
				$response['results'] = $this->allBorrowed();
			} else {
				$output = '<tr>';
					$output .= '<td></td>';
					$output .= '<td></td>';
					$output .= '<td></td>';
					$output .= '<td></td>';
					$output .= '<td></td>';
					$output .= '<td></td>';
				$output .= '</tr>';
				$response['status'] = FALSE;
				$response['results'] = $output;
			} 
		}
		echo json_encode( $response );
		exit;
	}

	public function deleteData() {
		$response = array();
		$tbl = $_POST['del_table'];
		$target = $_POST['del_target'];
		$pass = $_POST['del_pass'];
		$is_ajax = $_POST['is_ajax'];

		if( $is_ajax == 1 ) {
			$this->load->model( 'books_info' );
			$result = $this->books_info->deleteData( $tbl, $target, $pass );
			if( $result ) {
				$response['status'] = TRUE;
				if( $tbl == 'book_info' ) {
					$response['table'] = '.rty-table-books';
					$response['results'] = $this->books();
				} elseif( $tbl == 'genre' ) {
					$response['results'] = $this->allGenre();
					$response['table'] = '.rty-table-genre';
				} elseif( $tbl == 'section' ) {
					$response['results'] = $this->allSection();
					$response['table'] = '.rty-table-section';
				} elseif( $tbl == 'borrowed' ) {
					$response['results'] = $this->allBorrowed();
					$response['table'] = '.rty-table-borrowed';
				} else {
					$response['results'] = $this->books();
					$response['table'] = '.rty-table-books';
				}
			} else {
				$response['status'] = FALSE;
			}
		}
		echo json_encode( $response );
		exit;
	}

}