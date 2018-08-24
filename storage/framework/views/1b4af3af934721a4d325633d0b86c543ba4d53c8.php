 <?php $__env->startSection('content'); ?>
<?php if(Session::has('flash_message')): ?>
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> <?php echo e(Session::get('flash_message')); ?>.
    </div>
<?php endif; ?>
<div class="admin-home">
    <!-- search bar-->
    <div class="search-section book-search">
        <div class="search-icon">
            <i class="fas fa-search"></i>
        </div>
        <input type="text" placeholder="Search by Title, Author, ISBN">
    </div>
    <!-- section three-->
    <div class="section-three">
        <div class="left">
            <div class="circle">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
            <div class="text" style="cursor: pointer;"><a data-toggle="modal" data-target="#creatcategoryModal">Add Category</a></div>
            <div class="listing-category">
                <ul>
                    <li <?php if($category_name == 'all-books'): ?> class="active" <?php endif; ?> ><a style="color:black;" href="/books/category/all-books">All Books</a></li>
                    <?php if(!$categories->isEmpty()): ?> <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if(!blank($optionValue->is_delete) && $optionValue->is_delete==0): ?>
                    <li <?php if($optionValue->category_slug == $category_name): ?> class="active" <?php endif; ?> ><a style="color:black;" href="/books/category/<?php echo e($optionValue->category_slug); ?>"><?php echo e($optionValue->name); ?></a></li>
                    <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php else: ?> Data not available ! <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="right">
            <div class="category-discription category-search">
                <div class="category-name">
                    <div class="name"><?php if(!blank($category_name)): ?> <?php echo e(ucwords(str_replace('-', ' ', $category_name))); ?><?php endif; ?> <?php if($category_name != 'all-books'): ?>
                        <i class="fas fa-pencil-alt" data-toggle="modal" data-target="#editCategoryModal"></i> <?php endif; ?>
                    </div>
                    <div class="number">12 books</div>
                </div>
                <?php if($category_name != 'all-books'): ?>
                <div class="category-action">
                <span>
                    <form method="POST" action="<?php echo e(url('admin/books/category' . '/' . $category->id)); ?>" accept-charset="UTF-8" enctype="multipart/form-data" style="display:inline">
                      <?php echo e(csrf_field()); ?>

                      <div style="text-align: right;cursor: pointer;" class="delete"  data-toggle = 'modal' data-target = '#confirmDelete' data-title = 'Delete Category' data-message = 'Are you sure you want to delete this Category ?'><i class="far fa-trash-alt"></i> Delete category</div>
                    </form>
                </span>
                </div>
                <?php endif; ?>
            </div>
            <select id="userSorting">
                <option>A-Z</option>
                <option>B-Z</option>
                <option>C-Z</option>
                <option>D-Z</option>
                <option>E-Z</option>
                <option>F-Z</option>
            </select>
            <div class="right-row-one">
                <div class="row add-banner">
                    <a href="<?php echo e(url('book/ebookupload')); ?>"><div class="plus-banner">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="text">Upload E-Book</div></a>
                </div>
                <?php if(!$records->isEmpty()): ?> <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row item">
                    <div class="edit-delete">
                        <div class="edit"><a href="<?php echo e(url('/book/' . $book->id . '/edit')); ?>" title="Edit Book"><i class="fas fa-pencil-alt"></i></a></div>
                        <form method="POST" action="<?php echo e(url('/book' . '/' . $book->id)); ?>" accept-charset="UTF-8" style="display:inline">
                            <?php echo e(method_field('DELETE')); ?> <?php echo e(csrf_field()); ?>

                            <div class="delete" data-toggle='modal' data-target='#confirmDelete' data-title='Delete Book' data-message='Are you sure you want to delete this e-Book ?'><i class="far fa-trash-alt"></i></div>
                        </form>
                    </div>
                    <div class="image">
                        <?php if(substr($book->ebook_logo, 0, 4) == "http"): ?>
                            <img src="<?php echo e($book->ebook_logo); ?>" alt="img1" />
                        <?php else: ?>
                            <img src="/uploads/ebook_logo/<?php echo e($book->ebook_logo); ?>" alt="img1" />
                        <?php endif; ?>
                    </div>
                    <div class="title"><?php echo e($book->ebooktitle); ?></div>
                    <div class="writer"><?php echo e($book->first_name); ?> <?php echo e($book->last_name); ?></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php else: ?> Data not available <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- modal -->
    <?php if($category_name != 'all-books'): ?>
    <div id="editCategoryModal" class="modal fade createbook-Modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-text">Category Info</div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="ample-login-signup">
                        <div class="ample-login-section">
                            <form method="POST" action="<?php echo e(url('/admin/categories/' . $category->id)); ?>" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                <?php echo e(method_field('PATCH')); ?> <?php echo e(csrf_field()); ?> <?php echo $__env->make('admin.categories.form', ['submitButtonText' => 'Update'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
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
</div>
</div>
<?php echo $__env->make('modals.modal-delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('footer_scripts'); ?> <?php echo $__env->make('scripts.delete-modal-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php $__env->stopSection(); ?>
<style type="text/css">
    .ample-login-signup { padding: 0px, 25px !important; }.createbook-Modal .modal-body .ample-login-section { margin-top: 0px !important }.createbook-Modal .modal-footer { border: 0px !important }
</style>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>