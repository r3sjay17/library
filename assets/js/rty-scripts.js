jQuery(function($) {

	//add book
	$('.main-panel').on('click', '.btn-add-book', function() {
		$('#rty_add_book_form')[0].reset();
		$('#rty_add_book_form #bk_mode').val(0);
		$('#add_book .modal-header .modal-title').html( '<strong>Book Information</strong>' );
		$('#add_book #rty_add_book_form .btn-add-book').html( 'Add Book' );
		$('#add_book .alert-success').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Book info added succesfully.<button class='close' data-close='alert'></button>" );
		$('#add_book .alert-danger').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Error adding book info!.<button class='close' data-close='alert'></button>" );
	});
	$('#rty_add_book_form').on('submit', function(e) {
		e.preventDefault();
		var formData = new FormData( $(this)['0'] );
		formData.append( 'is_ajax', 1 );
		$(this).find('.btn-add-book').prepend( '<i class="fa fa-spinner fa-spin"></i>' );

		$.ajax({
			method: "POST",
			url: siteurl + "/main_info/addBook",
            contentType: false,
            cache: false,
            processData: false,
			data: formData,
			success: function( output ) {
				var data = JSON.parse( output );
				if( data.status ) {
					$('#add_book .alert-success').removeClass( 'hide' );
					$('#add_book .alert-success').slideDown( 500 );
					setTimeout(function() {
						$('.rty-table-books table tbody').html('');
						$('.rty-table-books table tbody').html( data.results );
						$('#rty_add_book_form')[0].reset();
						$('#rty_add_book_form #bk_mode').val(0);
						$('#add_book .alert-success').addClass( 'hide' );
						$('#add_book .alert-success').slideUp( 500 );
						$('#add_book #rty_add_book_form .btn-add-book').html( 'Add Book' );
						$('#add_book .modal-header .modal-title').html( '<strong>Book Information</strong>' );
						$('#add_book').modal( 'hide' );
					}, 1000);
				} else {
					$('#rty_add_book_form')[0].reset();
					$('#rty_add_book_form #bk_mode').val(0);
					$('#add_book .alert-danger').removeClass( 'hide' );
					$('#add_book .alert-danger').slideDown( 500 );
					setTimeout(function() {
						$('#add_book .alert-danger').addClass( 'hide' );
						$('#add_book .alert-danger').slideUp( 500 );
						$('#add_book #rty_add_book_form .btn-add-book').html( 'Add Book' );
						$('#add_book .modal-header .modal-title').html( '<strong>Book Information</strong>' );
						$('#add_book').modal( 'hide' );
					}, 1000);
				}
			}
		});
	});

	//edit book
	$('.rty-table-books table').on('click', '.btn-edit-book', function(e) {
		e.preventDefault();
		var datas = $(this).attr( 'data-book' );
		var info = datas.split( ',' );
		$('#rty_add_book_form #bk_mode').val( info[0] );
		$('#rty_add_book_form #bk_title').val( info[1] );
		$('#rty_add_book_form #bk_author').val( info[2] );
		$('#rty_add_book_form #bk_genre').val( parseInt( info[3] ) );
		$('#rty_add_book_form #bk_section').val( parseInt( info[4] ) );
		$('#rty_add_book_form #bk_copies').val( parseInt( info[5] ) );
		$('#add_book .alert-success').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Book info updated succesfully.<button class='close' data-close='alert'></button>" );
		$('#add_book .alert-danger').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Error updating book info!.<button class='close' data-close='alert'></button>" );
		$('#add_book .modal-header .modal-title').html( '<strong><i class="fa fa-pencil"></i> Edit Book Information</strong>' );
		$('#add_book #rty_add_book_form .btn-add-book').html( 'Update' );
		$('#add_book').modal( 'show' );
	});

	//delete book
	$('.rty-table-books table').on('click', '.btn-delete-book', function(e) {
		e.preventDefault();
		var datas = $(this).attr( 'data-book' );
		var info = datas.split( ',' );
		$('#rty_delete_form #del_table').val( info[0] );
		$('#rty_delete_form #del_target').val( info[1] );
		$('#rty_delete_form #del_pass').val( info[2] );
		$('#delete_modal #rty_delete_form .btn-del-book').html( 'Delete' );
		$('#delete_modal').modal( 'show' );
	});

	$('#rty_delete_form').on('submit', function(e) {
		e.preventDefault();
		var formData = new FormData( $(this)['0'] );
		formData.append( 'is_ajax', 1 );
		$(this).find('.btn-del-book').prepend( '<i class="fa fa-spinner fa-spin"></i>' );

		$.ajax({
			method: "POST",
			url: siteurl + "/main_info/deleteData",
            contentType: false,
            cache: false,
            processData: false,
			data: formData,
			success: function( output ) {
				var data = JSON.parse( output );
				if( data.status) {
					$('#delete_modal .alert-success').removeClass( 'hide' );
					$('#delete_modal .alert-success').slideDown( 500 );
					setTimeout(function() {
						$(data.table + ' table tbody').html('');
						$(data.table + ' table tbody').html( data.results );
						$('#rty_delete_form')[0].reset();
						$('#delete_modal .alert-success').addClass( 'hide' );
						$('#delete_modal .alert-success').slideUp( 500 );
						$('#delete_modal #rty_delete_form .btn-del-book').html( 'Delete' );
						$('#delete_modal').modal( 'hide' );
					}, 1000);
				} else {
					$('#rty_delete_form')[0].reset();
					$('#delete_modal .alert-danger').removeClass( 'hide' );
					$('#delete_modal .alert-danger').slideDown( 500 );
					setTimeout(function() {
						$('#delete_modal .alert-danger').addClass( 'hide' );
						$('#delete_modal .alert-danger').slideUp( 500 );
						$('#delete_modal #rty_delete_form .btn-del-book').html( 'Delete' );
						$('#delete_modal').modal( 'hide' );
					}, 1000);
				}
			}
		});
	});

	//add genre
	$('.main-panel').on('click', '.btn-add-genre', function() {
		$('#rty_add_genre_form')[0].reset();
		$('#rty_add_genre_form #gr_mode').val(0);
		$('#add_genre .modal-header .modal-title').html( '<strong>genre Information</strong>' );
		$('#add_genre #rty_add_genre_form .btn-add-genre').html( 'Add Genre' );
		$('#add_genre .alert-success').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Genre added succesfully.<button class='close' data-close='alert'></button>" );
		$('#add_genre .alert-danger').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Error adding genre!.<button class='close' data-close='alert'></button>" );
	});
	$('#rty_add_genre_form').on('submit', function(e) {
		e.preventDefault();
		var formData = new FormData( $(this)['0'] );
		formData.append( 'is_ajax', 1 );
		$(this).find('.btn-add-genre').prepend( '<i class="fa fa-spinner fa-spin"></i>' );

		$.ajax({
			method: "POST",
			url: siteurl + "/main_info/addGenre",
            contentType: false,
            cache: false,
            processData: false,
			data: formData,
			success: function( output ) {
				var data = JSON.parse( output );
				if( data.status ) {
					$('#add_genre .alert-success').removeClass( 'hide' );
					$('#add_genre .alert-success').slideDown( 500 );
					setTimeout(function() {
						$('.rty-table-genre table tbody').html('');
						$('.rty-table-genre table tbody').html( data.results );
						$('#rty_add_genre_form')[0].reset();
						$('#rty_add_genre_form #gr_mode').val(0);
						$('#add_genre .alert-success').addClass( 'hide' );
						$('#add_genre .alert-success').slideUp( 500 );
						$('#add_genre #rty_add_genre_form .btn-add-genre').html( 'Add Genre' );
						$('#add_genre .modal-header .modal-title').html( '<strong>Genre Information</strong>' );
						$('#add_genre').modal( 'hide' );
					}, 1000);
				} else {
					$('#rty_add_genre_form')[0].reset();
					$('#rty_add_genre_form #gr_mode').val(0);
					$('#add_genre .alert-danger').removeClass( 'hide' );
					$('#add_genre .alert-danger').slideDown( 500 );
					setTimeout(function() {
						$('#add_genre .alert-danger').addClass( 'hide' );
						$('#add_genre .alert-danger').slideUp( 500 );
						$('#add_genre #rty_add_genre_form .btn-add-genre').html( 'Add Genre' );
						$('#add_genre .modal-header .modal-title').html( '<strong>Genre Information</strong>' );
						$('#add_genre').modal( 'hide' );
					}, 1000);
				}
			}
		});
	});

	//edit genre
	$('.rty-table-genre table').on('click', '.btn-edit-genre', function(e) {
		e.preventDefault();
		var datas = $(this).attr( 'data-genre' );
		var info = datas.split( ',' );
		$('#rty_add_genre_form #gr_mode').val( info[0] );
		$('#rty_add_genre_form #gr_genre').val( info[1] );
		$('#add_genre .alert-success').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Genre updated succesfully.<button class='close' data-close='alert'></button>" );
		$('#add_genre .alert-danger').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Error updating genre!.<button class='close' data-close='alert'></button>" );
		$('#add_genre .modal-header .modal-title').html( '<strong><i class="fa fa-pencil"></i> Edit Genre Information</strong>' );
		$('#add_genre #rty_add_genre_form .btn-add-genre').html( 'Update' );
		$('#add_genre').modal( 'show' );
	});

	//delete genre
	$('.rty-table-genre table').on('click', '.btn-delete-genre', function(e) {
		e.preventDefault();
		var datas = $(this).attr( 'data-genre' );
		var info = datas.split( ',' );
		$('#rty_delete_form #del_table').val( info[0] );
		$('#rty_delete_form #del_target').val( info[1] );
		$('#rty_delete_form #del_pass').val( info[2] );
		$('#delete_modal #rty_delete_form .btn-del-genre').html( 'Delete' );
		$('#delete_modal').modal( 'show' );
	});

	//add section
	$('.main-panel').on('click', '.btn-add-section', function() {
		$('#rty_add_section_form')[0].reset();
		$('#rty_add_section_form #sc_mode').val(0);
		$('#add_section .modal-header .modal-title').html( '<strong>Section Information</strong>' );
		$('#add_section #rty_add_section_form .btn-add-section').html( 'Add Section' );
		$('#add_section .alert-success').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Section added succesfully.<button class='close' data-close='alert'></button>" );
		$('#add_section .alert-danger').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Error adding section!.<button class='close' data-close='alert'></button>" );
	});
	$('#rty_add_section_form').on('submit', function(e) {
		e.preventDefault();
		var formData = new FormData( $(this)['0'] );
		formData.append( 'is_ajax', 1 );
		$(this).find('.btn-add-section').prepend( '<i class="fa fa-spinner fa-spin"></i>' );

		$.ajax({
			method: "POST",
			url: siteurl + "/main_info/addSection",
            contentType: false,
            cache: false,
            processData: false,
			data: formData,
			success: function( output ) {
				var data = JSON.parse( output );
				if( data.status ) {
					$('#add_section .alert-success').removeClass( 'hide' );
					$('#add_section .alert-success').slideDown( 500 );
					setTimeout(function() {
						$('.rty-table-section table tbody').html('');
						$('.rty-table-section table tbody').html( data.results );
						$('#rty_add_section_form')[0].reset();
						$('#rty_add_section_form #gr_mode').val(0);
						$('#add_section .alert-success').addClass( 'hide' );
						$('#add_section .alert-success').slideUp( 500 );
						$('#add_section #rty_add_section_form .btn-add-section').html( 'Add Section' );
						$('#add_section .modal-header .modal-title').html( '<strong>Section Information</strong>' );
						$('#add_section').modal( 'hide' );
					}, 1000);
				} else {
					$('#rty_add_section_form')[0].reset();
					$('#rty_add_section_form #gr_mode').val(0);
					$('#add_section .alert-danger').removeClass( 'hide' );
					$('#add_section .alert-danger').slideDown( 500 );
					setTimeout(function() {
						$('#add_section .alert-danger').addClass( 'hide' );
						$('#add_section .alert-danger').slideUp( 500 );
						$('#add_section #rty_add_section_form .btn-add-section').html( 'Add Section' );
						$('#add_section .modal-header .modal-title').html( '<strong>Section Information</strong>' );
						$('#add_section').modal( 'hide' );
					}, 1000);
				}
			}
		});
	});

	//edit section
	$('.rty-table-section table').on('click', '.btn-edit-section', function(e) {
		e.preventDefault();
		var datas = $(this).attr( 'data-section' );
		var info = datas.split( ',' );
		$('#rty_add_section_form #sc_mode').val( info[0] );
		$('#rty_add_section_form #sc_section').val( info[1] );
		$('#add_section .alert-success').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Section updated succesfully.<button class='close' data-close='alert'></button>" );
		$('#add_section .alert-danger').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Error updating section!.<button class='close' data-close='alert'></button>" );
		$('#add_section .modal-header .modal-title').html( '<strong><i class="fa fa-pencil"></i> Edit Section Information</strong>' );
		$('#add_section #rty_add_section_form .btn-add-section').html( 'Update' );
		$('#add_section').modal( 'show' );
	});

	//delete section
	$('.rty-table-section table').on('click', '.btn-delete-section', function(e) {
		e.preventDefault();
		var datas = $(this).attr( 'data-section' );
		var info = datas.split( ',' );
		$('#rty_delete_form #del_table').val( info[0] );
		$('#rty_delete_form #del_target').val( info[1] );
		$('#rty_delete_form #del_pass').val( info[2] );
		$('#delete_modal #rty_delete_form .btn-del-section').html( 'Delete' );
		$('#delete_modal').modal( 'show' );
	});

	//add borrowed
	$('.main-panel').on('click', '.btn-add-borrowed', function() {
		$('#rty_add_borrowed_form')[0].reset();
		$('#rty_add_borrowed_form #br_mode').val(0);
		$('#add_borrowed .modal-header .modal-title').html( '<strong>Borrowed Book Information</strong>' );
		$('#add_borrowed #rty_add_borrowed_form .btn-add-borrowed').html( 'Add' );
		$('#add_borrowed .alert-success').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Borrowed book added succesfully.<button class='close' data-close='alert'></button>" );
		$('#add_borrowed .alert-danger').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Error adding borrowed book!.<button class='close' data-close='alert'></button>" );
	});
	$('#rty_add_borrowed_form').on('submit', function(e) {
		e.preventDefault();
		var formData = new FormData( $(this)['0'] );
		formData.append( 'is_ajax', 1 );
		$(this).find('.btn-add-borrowed').prepend( '<i class="fa fa-spinner fa-spin"></i>' );

		$.ajax({
			method: "POST",
			url: siteurl + "/main_info/addBorrowed",
            contentType: false,
            cache: false,
            processData: false,
			data: formData,
			success: function( output ) {
				var data = JSON.parse( output );
				if( data.status ) {
					$('#add_borrowed .alert-success').removeClass( 'hide' );
					$('#add_borrowed .alert-success').slideDown( 500 );
					setTimeout(function() {
						$('.rty-table-borrowed table tbody').html('');
						$('.rty-table-borrowed table tbody').html( data.results );
						$('#rty_add_borrowed_form')[0].reset();
						$('#rty_add_borrowed_form #br_mode').val(0);
						$('#add_borrowed .alert-success').addClass( 'hide' );
						$('#add_borrowed .alert-success').slideUp( 500 );
						$('#add_borrowed #rty_add_borrowed_form .btn-add-borrowed').html( 'Add' );
						$('#add_borrowed .modal-header .modal-title').html( '<strong>Borrowed Book Information</strong>' );
						$('#add_borrowed').modal( 'hide' );
					}, 1000);
				} else {
					$('#rty_add_borrowed_form')[0].reset();
					$('#rty_add_borrowed_form #br_mode').val(0);
					$('#add_borrowed .alert-danger').removeClass( 'hide' );
					$('#add_borrowed .alert-danger').slideDown( 500 );
					setTimeout(function() {
						$('#add_borrowed .alert-danger').addClass( 'hide' );
						$('#add_borrowed .alert-danger').slideUp( 500 );
						$('#add_borrowed #rty_add_borrowed_form .btn-add-borrowed').html( 'Add' );
						$('#add_borrowed .modal-header .modal-title').html( '<strong>Borrowed Book Information</strong>' );
						$('#add_borrowed').modal( 'hide' );
					}, 1000);
				}
			}
		});
	});

	//edit borrowed
	$('.rty-table-borrowed table').on('click', '.btn-edit-borrowed', function(e) {
		e.preventDefault();
		var datas = $(this).attr( 'data-borrowed' );
		var info = datas.split( ',' );
		$('#rty_add_borrowed_form #br_mode').val( info[0] );
		$('#rty_add_borrowed_form #br_book').val( parseInt( info[1] ) );
		$('#rty_add_borrowed_form #br_date_borrowed').val( info[2] );
		$('#rty_add_borrowed_form #br_date_returned').val( info[3] );
		$('#rty_add_borrowed_form #br_status').val( info[4] );
		$('#add_borrowed .alert-success').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Borrowed book info updated succesfully.<button class='close' data-close='alert'></button>" );
		$('#add_borrowed .alert-danger').html( "<i class='fa fa-check-square-o' aria-hidden='true'></i> Error updating borrowed book info!.<button class='close' data-close='alert'></button>" );
		$('#add_borrowed .modal-header .modal-title').html( '<strong><i class="fa fa-pencil"></i> Edit Borrowed Book Information</strong>' );
		$('#add_borrowed #rty_add_borrowed_form .btn-add-borrowed').html( 'Update' );
		$('#add_borrowed').modal( 'show' );
	});

	//delete borrowed
	$('.rty-table-borrowed table').on('click', '.btn-delete-borrowed', function(e) {
		e.preventDefault();
		var datas = $(this).attr( 'data-borrowed' );
		var info = datas.split( ',' );
		$('#rty_delete_form #del_table').val( info[0] );
		$('#rty_delete_form #del_target').val( info[1] );
		$('#rty_delete_form #del_pass').val( info[2] );
		$('#delete_modal #rty_delete_form .btn-del-borrowed').html( 'Delete' );
		$('#delete_modal').modal( 'show' );
	});

	//search books
	$('#rty_search_form').on('submit', function(e) {
		e.preventDefault();
		var formData = new FormData( $(this)['0'] );
		formData.append( 'is_ajax', 1 );
		$(this).find('.btn-search-book').html( '<i class="fa fa-spinner fa-spin"></i> Searching' );

		$.ajax({
			method: "POST",
			url: siteurl + "/main_info/books",
            contentType: false,
            cache: false,
            processData: false,
			data: formData,
			success: function( output ) {
				var data = JSON.parse( output );
				if( data.status ) {
					$('.rty-table-books table tbody').html('');
					$('.rty-table-books table tbody').html( data.results );
					$('#rty_search_form .btn-search-book').html( '<i class="fa fa-search"></i> Search' );
				} else {
					$('.rty-table-books table tbody').html('');
					$('.rty-table-books table tbody').html( data.results );
					$('#rty_search_form .btn-search-book').html( '<i class="fa fa-search"></i> Search' );
				}
			}
		});
	});

});