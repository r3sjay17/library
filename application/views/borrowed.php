<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

        <div class="content">
            <div class="container-fluid">

            	<div class="row">
            		<div class="col-md-12">
            			<div class="pull-right">
            				<button type="button" class="btn btn-primary btn-add-borrowed" data-toggle="modal" data-target="#add_borrowed"><i class="fa fa-plus"></i> Add Borrowed</button>
            			</div>
            		</div>
            	</div>

                <div class="row">
                    <div class="col-md-12 rty-table-borrowed">
                        <table class="table table-striped table-bordered table-hover">
						  	<thead>
						    	<tr>
						      		<th scope="col">#</th>
                                    <th scope="col">Book</th>
                                    <th scope="col">Date Borrowed</th>
						      		<th scope="col">Date Returned</th>
                                    <th scope="col">Status</th>
						      		<th scope="col">Action</th>
						    	</tr>
						  	</thead>
						  	<tbody>
						  		<?php echo $borrowed; ?>
						  	</tbody>
						</table>
                    </div>

                </div>
            </div>
        </div>