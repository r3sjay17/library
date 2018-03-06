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
            				<button type="button" class="btn btn-primary btn-add-section" data-toggle="modal" data-target="#add_section"><i class="fa fa-plus"></i> Add Section</button>
            			</div>
            		</div>
            	</div>

                <div class="row">
                    <div class="col-md-12 rty-table-section">
                        <table class="table table-striped table-bordered table-hover">
						  	<thead>
						    	<tr>
						      		<th scope="col">#</th>
						      		<th scope="col">Section</th>
						      		<th scope="col">Action</th>
						    	</tr>
						  	</thead>
						  	<tbody>
						  		<?php echo $section; ?>
						  	</tbody>
						</table>
                    </div>

                </div>
            </div>
        </div>