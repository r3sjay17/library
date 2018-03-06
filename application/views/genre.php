<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><?php echo $header; ?></a>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">

            	<div class="row">
            		<div class="col-md-12">
            			<div class="pull-right">
            				<button type="button" class="btn btn-primary btn-add-genre" data-toggle="modal" data-target="#add_genre"><i class="fa fa-plus"></i> Add Genre</button>
            			</div>
            		</div>
            	</div>

                <div class="row">
                    <div class="col-md-12 rty-table-genre">
                        <table class="table table-striped table-bordered table-hover">
						  	<thead>
						    	<tr>
						      		<th scope="col">#</th>
						      		<th scope="col">Genre</th>
						      		<th scope="col">Action</th>
						    	</tr>
						  	</thead>
						  	<tbody>
						  		<?php echo $genre; ?>
						  	</tbody>
						</table>
                    </div>

                </div>
            </div>
        </div>