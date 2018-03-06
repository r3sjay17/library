<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="sidebar" data-background-color="white" data-active-color="danger">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    <?php echo $title; ?>
                </a>
            </div>

            <ul class="nav">
                <li class="<?php echo $active == 'books' ? 'active' : '' ?>">
                    <a href="<?php echo base_url(); ?>">
                        <i class="fa fa-book"></i>
                        <p>Books</p>
                    </a>
                </li>
                <li class="<?php echo $active == 'genre' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('/main_info/genre'); ?>">
                        <i class="fa fa-tags"></i>
                        <p>Genres</p>
                    </a>
                </li>
                <li class="<?php echo $active == 'section' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('/main_info/section'); ?>">
                        <i class="fa fa-th"></i>
                        <p>Sections</p>
                    </a>
                </li>
                <li class="<?php echo $active == 'borrowed' ? 'active' : '' ?>">
                    <a href="<?php echo site_url('/main_info/borrowed'); ?>">
                        <i class="fa fa-bookmark"></i>
                        <p>Borrowed</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>