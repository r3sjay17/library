<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="add_book" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                <h4 class="modal-title"><strong>Book Information</strong></h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    <div class="alert alert-success hide">
                        <i class='fa fa-check-square-o' aria-hidden='true'></i> Book info added succesfully. 
                        <button class="close" data-close="alert"></button>
                    </div>
                    <div class="alert alert-danger hide">
                        <i class="fa fa-exclamation-triangle" aria-hidden='true'></i> Error adding book info!
                        <button class="close" data-close="alert"></button>
                    </div>
                    <!-- BEGIN FORM-->
                    <form method="POST"  accept-charset="UTF-8" class="form-horizontal" id="rty_add_book_form">
                        <div class="form-body">
                            <input type="hidden" id="bk_mode" name="bk_mode" value="0">
                            <div class="rty-form-group">
                                <label>Title</label>
                                <input type="text" id="bk_title" name="bk_title" class="form-control">
                            </div>
                            <div class="rty-form-group">
                                <label>Author</label>
                                <input type="text" id="bk_author" name="bk_author" class="form-control">
                            </div>
                            <div class="rty-form-group">
                                <label>Genre</label>
                                <select id="bk_genre" name="bk_genre" class="form-control">
                                    <option value="0"></option>
                                    <?php
                                        if( !empty( $genres ) ) {
                                            foreach( $genres as $genre ) {
                                    ?>
                                                <option value="<?php echo $genre->id ?>"><?php echo $genre->genre ?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="rty-form-group">
                                <label>Section</label>
                                <select id="bk_section" name="bk_section" class="form-control">
                                    <option value="0"></option>
                                    <?php
                                        if( !empty( $sections ) ) {
                                            foreach( $sections as $section ) {
                                    ?>
                                                <option value="<?php echo $section->id ?>"><?php echo $section->section ?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="rty-form-group">
                                <label>Copies</label>
                                <input type="number" id="bk_copies" name="bk_copies" class="form-control">
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3-XXX col-md-12 text-center">
                                    <button type="submit"  class="btn btn-add-book"></i>Add Book</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>

<div id="add_genre" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                <h4 class="modal-title"><strong>Genre Information</strong></h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    <div class="alert alert-success hide">
                        <i class='fa fa-check-square-o' aria-hidden='true'></i> Genre added succesfully. 
                        <button class="close" data-close="alert"></button>
                    </div>
                    <div class="alert alert-danger hide">
                        <i class="fa fa-exclamation-triangle" aria-hidden='true'></i> Error adding genre!
                        <button class="close" data-close="alert"></button>
                    </div>
                    <!-- BEGIN FORM-->
                    <form method="POST"  accept-charset="UTF-8" class="form-horizontal" id="rty_add_genre_form">
                        <div class="form-body">
                            <input type="hidden" id="gr_mode" name="gr_mode" value="0">
                            <div class="rty-form-group">
                                <label>Genre</label>
                                <input type="text" id="gr_genre" name="gr_genre" class="form-control">
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3-XXX col-md-12 text-center">
                                    <button type="submit"  class="btn btn-add-genre"></i>Add Genre</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>

<div id="add_section" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                <h4 class="modal-title"><strong>Section Information</strong></h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    <div class="alert alert-success hide">
                        <i class='fa fa-check-square-o' aria-hidden='true'></i> Section added succesfully. 
                        <button class="close" data-close="alert"></button>
                    </div>
                    <div class="alert alert-danger hide">
                        <i class="fa fa-exclamation-triangle" aria-hidden='true'></i> Error adding section!
                        <button class="close" data-close="alert"></button>
                    </div>
                    <!-- BEGIN FORM-->
                    <form method="POST"  accept-charset="UTF-8" class="form-horizontal" id="rty_add_section_form">
                        <div class="form-body">
                            <input type="hidden" id="sc_mode" name="sc_mode" value="0">
                            <div class="rty-form-group">
                                <label>Section</label>
                                <input type="text" id="sc_section" name="sc_section" class="form-control">
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3-XXX col-md-12 text-center">
                                    <button type="submit"  class="btn btn-add-section"></i>Add Section</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>

<div id="add_borrowed" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                <h4 class="modal-title"><strong>Borrowed Book Information</strong></h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    <div class="alert alert-success hide">
                        <i class='fa fa-check-square-o' aria-hidden='true'></i> Book borrowed succesfully. 
                        <button class="close" data-close="alert"></button>
                    </div>
                    <div class="alert alert-danger hide">
                        <i class="fa fa-exclamation-triangle" aria-hidden='true'></i> Error adding borrowed book!
                        <button class="close" data-close="alert"></button>
                    </div>
                    <!-- BEGIN FORM-->
                    <form method="POST"  accept-charset="UTF-8" class="form-horizontal" id="rty_add_borrowed_form">
                        <div class="form-body">
                            <input type="hidden" id="br_mode" name="br_mode" value="0">
                            <div class="rty-form-group">
                                <label>Book</label>
                                <select class="form-control" id="br_book" name="br_book" required>
                                    <option value=""></option>
                                    <?php
                                        if( !empty( $book_info ) ) {
                                            foreach( $book_info as $info ) {
                                    ?>
                                                <option value="<?php echo $info->id ?>"><?php echo $info->title ?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="rty-form-group">
                                <label>Date Borrowed</label>
                                <input type="date" id="br_date_borrowed" name="br_date_borrowed" class="form-control">
                            </div>
                            <div class="rty-form-group">
                                <label>Date Returned</label>
                                <input type="date" id="br_date_returned" name="br_date_returned" class="form-control">
                            </div>
                            <div class="rty-form-group">
                                <label>Status</label>
                                <select class="form-control" id="br_status" name="br_status">
                                    <option value=""></option>
                                    <option value="0">Borrowed</option>
                                    <option value="1">Returned</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3-XXX col-md-12 text-center">
                                    <button type="submit"  class="btn btn-add-borrowed"></i>Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>

<div id="delete_modal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                <h4 class="modal-title"><strong><i class="fa fa-trash"></i> Delete</strong></h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    <div class="alert alert-success hide">
                        <i class='fa fa-check-square-o' aria-hidden='true'></i> Deleted succesfully. 
                        <button class="close" data-close="alert"></button>
                    </div>
                    <div class="alert alert-danger hide">
                        <i class="fa fa-exclamation-triangle" aria-hidden='true'></i> Error deleting!
                        <button class="close" data-close="alert"></button>
                    </div>
                    <!-- BEGIN FORM-->
                    <form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" id="rty_delete_form">
                        <div class="form-body">
                            <input type="hidden" id="del_table" name="del_table">
                            <input type="hidden" id="del_target" name="del_target">
                            <input type="hidden" id="del_pass" name="del_pass">
                            <h3>Are you sure you want to delete this data?</h3><br>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3-XXX col-md-12 text-right">
                                    <button type="submit"  class="btn btn-del-book"></i>Delete</button>
                                    <button type="button" class="btn btn-cancel-book" data-dismiss="modal" aria-hidden="true">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>