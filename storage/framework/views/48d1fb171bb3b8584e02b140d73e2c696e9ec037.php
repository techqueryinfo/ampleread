 <?php $__env->startSection('content'); ?> <?php if(Session::has('flash_message')): ?>
<div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> <?php echo e(Session::get('flash_message')); ?>.
</div>
<?php endif; ?>
<!-- heading -->
<div class="admin-home">
    <!-- section one  -->
    <div class="heading">Main Slider</div>
    <div class="row-one">
        <div class="row add-banner">
            <div class="plus-banner">
                <i class="fas fa-plus" data-toggle="modal" data-target="#createHomeBannerModal"></i>
            </div>
            <div class="text">Add banner</div>
        </div>
        <?php if(!$banner_images->isEmpty()): ?> <?php $image_name = "../images/bg-img.jpg"; ?> <?php $__currentLoopData = $banner_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if(!blank($banner_image->image_name)): ?> <?php $image_name = $banner_image->image_name; ?> <?php endif; ?>
        <div class="row">
            <div class="edit-delete image">
                <form method="POST" action="<?php echo e(url('/admin/homepage' . '/' . $banner_image->id)); ?>" accept-charset="UTF-8" style="display:inline">
                    <?php echo e(method_field('DELETE')); ?> <?php echo e(csrf_field()); ?>

                    <div class="delete" data-toggle='modal' data-target='#confirmDelete' data-title='Delete Book' data-message='Are you sure you want to delete this banner image ?'><i class="far fa-trash-alt"></i></div>
                </form>
            </div>
            <img src="/uploads/ebook_logo/<?php echo $image_name ; ?>" />
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
    </div>
    <!-- section two -->
    <div class="heading">Special Feature</div>
    <div class="row-two">
        <div class="row add-banner">
            <div class="plus-banner">
                <i class="fas fa-plus" data-toggle="modal" data-target="#createSpecialFeatureModal"></i>
            </div>
            <div class="text">Add banner</div>
        </div>
        <?php if(isset($home_books)): ?> <?php $__currentLoopData = $home_books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $home_book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="slot-1">
            <div class="e-book1">
                <?php if(isset($home_book->home_books->ebook_logo)): ?> 
                    <?php if(substr($home_book->home_books->ebook_logo, 0, 4) == "http"): ?>
                        <img src="<?php echo e($home_book->home_books->ebook_logo); ?>" alt="img1" />
                    <?php else: ?>
                        <img src="/uploads/ebook_logo/<?php echo e($home_book->home_books->ebook_logo); ?>" alt="img1" />
                    <?php endif; ?> 
                <?php endif; ?>
            </div>
            <?php if(isset($home_book->home_books->ebooktitle)): ?>
            <div class="heading"><?php echo e(str_limit($home_book->home_books->ebooktitle, 20)); ?></div>
            <?php endif; ?> <?php if(isset($home_book->home_books->subtitle)): ?>
            <div class="sub-text"><?php echo e(str_limit($home_book->home_books->subtitle, 50)); ?></div>
            <?php endif; ?>
            <div class="edit-delete">
                <div class="edit">
                    <?php if(isset($home_book->home_books->id)): ?>
                    <a href="<?php echo e(url('/book/' . $home_book->home_books->id . '/edit')); ?>" title="Edit Book">
                    <?php endif; ?>
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                </div>
                <form method="POST" action="<?php echo e(url('/admin/homepage/special_feature'. '/' . $home_book->id)); ?>" accept-charset="UTF-8" style="display:inline">
                    <?php echo e(csrf_field()); ?>

                    <div class="delete" data-toggle='modal' data-target='#confirmDelete' data-title='Delete Book' data-message='Are you sure you want to delete this e-Book from homepage ?'><i class="far fa-trash-alt"></i></div>
                </form>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
    </div>
    <!-- section three-->
    <div class="section-three">
        <div class="left">
            <div class="circle">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <div class="text" data-toggle="modal" data-target="#creatcategoryModal" style="cursor: pointer;">Add Category</div>
            <div class="listing-category">
                <ul>
                    <li <?php if(isset($category_name) && $category_name=='new_releases' ): ?> class="active" <?php elseif(!isset($category_name)): ?> class="active" <?php endif; ?>><a href="/admin/homepage/new_releases">New Releases</a></li>
                    <li <?php if(isset($category_name) && $category_name=='bestsellers' ): ?> class="active" <?php endif; ?>><a href="/admin/homepage/bestsellers">Bestsellers</a></li>
                    <li <?php if(isset($category_name) && $category_name=='classics' ): ?> class="active" <?php endif; ?>><a href="/admin/homepage/classics">Classics</a></li>
                </ul>
            </div>
        </div>
        <div class="right">
            <div class="category-discription">
                <div class="category-name">
                    <div class="name">
                        <?php if(isset($category_name)): ?> <?php echo e(ucwords(str_replace("_", " ", $category_name))); ?> <?php else: ?> New Releases <?php endif; ?>
                    </div>
                    <div class="number"><?php if(isset($count)): ?><?php echo e($count); ?> books <?php endif; ?></div>
                </div>
                <div class="category-action">
                    <i class="far fa-trash-alt"></i>
                    <span>Delete category</span>
                </div>
            </div>
            <div class="right-row-one">
                <div class="row add-banner">
                    <div class="plus-banner">
                        <i class="fas fa-plus" data-toggle="modal" data-target="#uploadBook"></i>
                    </div>
                    <div class="text">Upload Book</div>
                </div>
                <?php if(!$new_releases->isEmpty()): ?> <?php $__currentLoopData = $new_releases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($key
                <=1 ): ?> <div class=" row item">
                    <div class="edit-delete">
                        <div class="edit"><a href="<?php echo e(url('/book/' . $val->home_books->id . '/edit')); ?>" title="Edit Book"><i class="fas fa-pencil-alt"></i></a></div>
                        <div class="delete">
                            <form method="POST" action="<?php echo e(url('/admin/homepage/special_feature'. '/' . $val->id)); ?>" accept-charset="UTF-8" style="display:inline">
                                <?php echo e(csrf_field()); ?>

                                <div class="delete" data-toggle='modal' data-target='#confirmDelete' data-title='Delete Book' data-message='Are you sure you want to delete this e-Book from homepage list ?'><i class="far fa-trash-alt"></i></div>
                            </form>
                        </div>
                    </div>
                    <div class="image">
                        <?php if(isset($val->home_books->ebook_logo)): ?> 
                            <?php if(substr($val->home_books->ebook_logo, 0, 4) == "http"): ?>
                                <img src="<?php echo e($val->home_books->ebook_logo); ?>" alt="img1" />
                            <?php else: ?>
                                <img src="/uploads/ebook_logo/<?php echo e($val->home_books->ebook_logo); ?>" alt="img1" />
                            <?php endif; ?> 
                        <?php endif; ?>
                    </div>
                    <div class="title"><?php echo e(str_limit($val->home_books->ebooktitle, 10)); ?></div>
                    <div class="writer"><?php echo e(str_limit($val->home_books->subtitle, 20)); ?></div>
            </div>
            <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php else: ?> Data not available ! <?php endif; ?>
        </div>
        <div class="right-row-one">
            <?php if(!$new_releases->isEmpty()): ?> <?php $__currentLoopData = $new_releases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($key >= 2): ?>
            <div class=" row item">
                <div class="edit-delete">
                    <div class="edit"><a href="<?php echo e(url('/book/' . $val->home_books->id . '/edit')); ?>" title="Edit Book"><i class="fas fa-pencil-alt"></i></a></div>
                    <div class="delete">
                        <form method="POST" action="<?php echo e(url('/admin/homepage/special_feature'. '/' . $val->id)); ?>" accept-charset="UTF-8" style="display:inline">
                            <?php echo e(csrf_field()); ?>

                            <div class="delete" data-toggle='modal' data-target='#confirmDelete' data-title='Delete Book' data-message='Are you sure you want to delete this e-Book from homepage list ?'><i class="far fa-trash-alt"></i></div>
                        </form>
                    </div>
                </div>
                <div class="image">
                    <?php if(isset($val->home_books->ebook_logo)): ?> 
                        <?php if(substr($val->home_books->ebook_logo, 0, 4) == "http"): ?>
                            <img src="<?php echo e($val->home_books->ebook_logo); ?>" alt="img1" />
                        <?php else: ?>
                            <img src="/uploads/ebook_logo/<?php echo e($val->home_books->ebook_logo); ?>" alt="img1" />
                        <?php endif; ?> 
                    <?php endif; ?>
                </div>
                <div class="title"><?php echo e($val->home_books->ebooktitle); ?></div>
                <div class="writer"><?php echo e($val->home_books->subtitle); ?></div>
            </div>
            <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php else: ?> Data not available ! <?php endif; ?>
        </div>
    </div>
</div>
<!-- section three-->
<!-- modal for adding home banner image -->
<div id="createHomeBannerModal" class="modal fade createbook-Modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-text">Add Home Banner</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="ample-login-signup">
                    <div class="ample-login-section">
                        <form action="<?php echo e(url('/admin/homepage')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="unit1">
                                <div class="form-group">
                                    <input type="file" name="home_logo">
                                    <br/>
                                    <div class="col-md-2">
                                    </div>
                                    <button type="submit" class="submit-button">Upload Banner Image</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- modal for adding home special feature books -->
<div id="createSpecialFeatureModal" class="modal fade createbook-Modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-text">Add Special Feature Books</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="ample-login-signup">
                    <div class="ample-login-section">
                        <form action="<?php echo e(url('/admin/homepage/special_feature')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <div class="unit1">
                                <div class="form-group">
                                    <div class="form-unit">
                                        <div class="heading">Books</div>
                                        <div class="content">
                                            <input type="hidden" value="special_feature" name="type">
                                            <select name="book_id" class="form-control" id="selectbook">
                                                <option value="">Please select Book</option>
                                                <?php if(isset($books)): ?> <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option data-value="<?php echo e($optionValue->id); ?>" value="<?php echo e($optionValue->id); ?>"> <?php echo e($optionValue->ebooktitle); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                    <br/>
                                    <button type="submit" class="submit-button">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div id="uploadBook" class="modal fade createbook-Modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- <div class="modal-text">Add Special Feature Books</div> -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="ample-login-signup">
                    <div class="ample-login-section">
                        <form action="<?php echo e(url('/admin/homepage/add_book')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <div class="unit1">
                                <div class="form-group">
                                    <div class="form-unit">
                                        <div class="heading">Books</div>
                                        <div class="content">
                                            <select name="book_id" class="form-control" id="selectbook">
                                                <option value="">Please select Book</option>
                                                <?php if(isset($books)): ?> <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option data-value="<?php echo e($optionValue->id); ?>" value="<?php echo e($optionValue->id); ?>"> <?php echo e($optionValue->ebooktitle); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
                                            </select>
                                            <select name="type" class="form-control" id="book_tag">
                                                <option value="new_releases">New Releases</option>
                                                <option value="bestsellers">Bestsellers</option>
                                                <option value="classics">Classics</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br/>
                                    <button type="submit" class="submit-button">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div id="creatcategoryModal" class="modal fade createbook-Modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-text">Add Category</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="ample-login-signup">
                    <div class="ample-login-section">
                        <form method="POST" action="<?php echo e(url('/admin/categories')); ?>" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="unit1" style="width: 30%">
                                <div class="form-group">
                                    <div class="heading">Name</div>
                                </div>
                            </div>
                            <div class="unit2">
                                <div class="form-group">
                                    <input class="form-control" name="status" type="hidden" id="status" value="Active" required="required">
                                    <input class="form-control" name="name" type="text" id="name" required="required"> <?php echo $errors->first('name', '
                                    <p class="help-block">:message</p>'); ?>

                                </div>
                            </div>
                            <div class="unit1">
                                <div class="form-group">
                                    <button type="submit" class="submit-button">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('modals.modal-delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('footer_scripts'); ?> <?php echo $__env->make('scripts.delete-modal-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>