<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <!-- <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button> -->
                    <a class="navbar-brand" href="#"><?php echo $header; ?></a>
                </div>
                <!-- <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
								<p>Stats</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <p class="notification">5</p>
									<p>Notifications</p>
									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
						<li>
                            <a href="#">
								<i class="ti-settings"></i>
								<p>Settings</p>
                            </a>
                        </li>
                    </ul>

                </div> -->
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">

            	<div class="row">
            		<div class="col-md-12">
            			<div class="pull-right">
            				<button type="button" class="btn btn-primary btn-add-book" data-toggle="modal" data-target="#add_book"><i class="fa fa-plus"></i> Add Book</button>
            			</div>
            		</div>
            	</div>

                <div class="row">
                	<div class="col-md-12">
                		<div class="search-wrapper">
                			<form action="#" method="POST" class="search-form" id="rty_search_form">

                				<div class="col-md-12">
                					<div class="title-holder">
                						<h4>Search:</h4>
                					</div>
                				</div>

                				<div class="col-md-12 rty-input-holder">
                					<div class="col-md-3">
                						<div class="form-group">
                							<label>Title</label>
                							<select class="form-control" id="s_title" name="s_title">
                								<option value="">All</option>
                                                <?php
                                                    if( !empty( $book_info ) ) {
                                                        foreach( $book_info as $info ) {
                                                ?>
                                                            <option value="<?php echo $info[1] ?>"><?php echo $info[1] ?></option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                							</select>
                						</div>
                					</div>
                					<div class="col-md-3">
                						<div class="form-group">
                							<label>Author</label>
                							<select class="form-control" id="s_author" name="s_author">
                								<option value="">All</option>
                                                <?php
                                                    if( !empty( $book_info ) ) {
                                                        foreach( $book_info as $info ) {
                                                ?>
                                                            <option value="<?php echo $info[2] ?>"><?php echo $info[2] ?></option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                							</select>
                						</div>
                					</div>
                					<div class="col-md-3">
                						<div class="form-group">
                							<label>Genre</label>
                							<select class="form-control" id="s_genre" name="s_genre">
                								<option value="">All</option>
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
                					</div>
                					<div class="col-md-3">
                						<div class="form-group">
                							<label>Section</label>
                							<select class="form-control" id="s_section" name="s_section">
                								<option value="">All</option>
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
                					</div>
                				</div>

                				<div class="col-md-12">
                					<div class="button-holder">
                						<button type="submit" class="btn btn-search-book"><i class="fa fa-search"></i> Search</button>
                					</div>
                				</div>

                			</form>         			
                		</div>
                	</div>
                </div>

                <div class="row">
                    <div class="col-md-12 rty-table-books">
                        <table class="table table-striped table-bordered table-hover">
						  	<thead>
						    	<tr>
						      		<th scope="col">Title</th>
						      		<th scope="col">Author</th>
						      		<th scope="col">Genre</th>
                                    <th scope="col">Section</th>
						      		<th scope="col">Action</th>
						    	</tr>
						  	</thead>
						  	<tbody>
						  		<?php echo $books; ?>
						  	</tbody>
						</table>
                    </div>

                </div>
            </div>
        </div>