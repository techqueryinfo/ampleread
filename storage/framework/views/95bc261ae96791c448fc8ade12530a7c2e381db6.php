 <?php $__env->startSection('content'); ?>
<form action="<?php echo e(url('/book/'.$book->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo e(method_field('PATCH')); ?> <?php echo e(csrf_field()); ?>

    <div class="admin-edit">
        <div class="edit-three">
            <?php if($book->ebook_logo): ?>
            <div class="image">
                <?php if(substr($book->ebook_logo, 0, 4) == "http"): ?>
                    <img src="<?php echo e($book->ebook_logo); ?>" width="180px" />
                <?php else: ?>
                    <img src="/uploads/ebook_logo/<?php echo e($book->ebook_logo); ?>" width="180px" />
                <?php endif; ?>
            </div>
            <div class="button">
                <input type="button" value="CHANGE COVER" onclick="document.getElementById('fileInput').click();">
                <input type="file" id="fileInput" name="ebook_logo" style="display: none;">
            </div>
            <?php endif; ?>
        </div>
        <div class="edit-two">
            <div class="unit-1">
                <div class="form-unit">
                    <div class="heading">eBook Type</div>
                    <div class="content">
                        <input type="text" name="type" value="<?php echo e(ucwords($book->type)); ?>" disabled="disabled">
                    </div>
                </div>
            </div>
            <div class="unit-2">
                <div class="form-unit">
                    <div class="heading">Category</div>
                    <div class="content">
                        <select name="category" id="ebookcategory" data-select2-id="ebookcategory" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($item->id === $book->category): ?>
                            <option value="<?php echo e($item->id); ?>" selected="selected"><?php echo e($item->name); ?></option>
                            <?php else: ?>
                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                            <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="unit-3">
                <div class="form-unit">
                    <div class="heading">eBook Title</div>
                    <div class="content">
                        <input type="text" id="ebook" name="ebooktitle" required="required" placeholder="E-Book title" value="<?php echo e($book->ebooktitle); ?>">
                    </div>
                </div>
            </div>
            <div class="unit-1">
                <div class="form-unit">
                    <div class="heading">Sub Title</div>
                    <div class="content">
                        <input type="text" id="subtitle" name="subtitle" required="required" placeholder="Free e-Book" value="<?php echo e($book->subtitle); ?>">
                    </div>
                </div>
            </div>
            <div class="unit-2">
                <div class="form-unit">
                    <div class="heading">Author</div>
                    <div class="content">
                        <input type="text" name="publisher" id="publish" class="form-control" value="<?php echo e($username); ?>" disabled="disabled">
                    </div>
                </div>
            </div>
            <div class="unit-3">
                <div class="form-unit">
                    <div class="heading">Description</div>
                    <div class="content">
                        <textarea id="desc" name="desc" placeholder="Enter Description..."><?php echo e($book->desc); ?></textarea>
                    </div>
                </div>
            </div>
            <div class="unit-1">
                <div class="form-unit">
                    <div class="heading">Print Pages</div>
                    <div class="content">
                        <input type="number" name="print_page" id="printPages" min="1" placeholder="Print Pages">
                    </div>
                </div>
            </div>
            <div class="unit-2">
                <div class="form-unit">
                    <div class="heading">Publisher</div>
                    <div class="content">
                        <input type="text" name="publisher" id="publish" class="form-control" value="<?php echo e($username); ?>" disabled="disabled">
                    </div>
                </div>
            </div>
            <div class="unit-1">
                <div class="form-unit">
                    <div class="heading">Publication Date</div>
                    <div class="content">
                        <input type="text" name="created_at" class="form-control" id="publishDate" value="<?php echo e($book->created_at->format('M-d-Y')); ?>" disabled="disabled">
                    </div>
                </div>
            </div>
            <div class="unit-2">

                <div class="form-unit">
                    <div class="heading">Publication Date</div>
                    <div class="content">
                        <input type="text" name="created_at" class="form-control" id="publishDate" value="<?php echo e($book->created_at->format('M-d-Y')); ?>" disabled="disabled">
                    </div>
                </div>
            </div>
            <div class="unit-3">
                <div class="form-unit">
                    <div class="heading">ASIN</div>
                    <div class="content">
                        <input type="text" name="asin" id="asin">
                    </div>
                </div>
            </div>
            <div class="unit-1">
                <div class="form-unit">
                    <div class="heading">eBook Status Type</div>
                    <div class="content">
                        <select id="status" name="status" data-select2-id="ebooktype" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
                            <option value="1" <?php if($book->status === 1): ?> selected="selected" <?php endif; ?>>Active</option>
                            <option value="0" <?php if($book->status === 0): ?> selected="selected" <?php endif; ?>>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="save-cancel-btn edit" style="display: none;">
        <div class="save">
            <input type="submit" value="Save" id="editBookBtn" />
        </div>
        <div class="cancel">
            <label>Cancel</label>
        </div>
    </div>    
</form>
<?php if($book->type == 'paid'): ?>
<div class="book-compare-price">
    <div class="heading">Store</div>
    <div class="add-section"  data-toggle="modal" data-target="#storeModal"><img src="/images/plus-icon.png" alt=""/> <span>ADD STORE<span></div>
    <div class="row-compare-one">
        <div class="unit-compare">Store</div>
        <div class="unit-compare">Rating</div>
        <div class="unit-compare">Availability</div>
        <div class="unit-compare">Price</div>
     </div>
    <?php $__currentLoopData = $paid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
    <div class="row-compare-one sec-two">
        <div class="unit-compare-sec">
            <div class="image-box">
                <img src="/uploads/storeimage/<?php echo e($val->store_logo); ?>" alt="image" width="100%">
            </div>
        </div>
        <div class="unit-compare-sec">
            <div class="star-container">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
            </div>
        </div>
        <div class="unit-compare-sec">
            <div class="stock">In Stock</div>
            <div class="days">Free shipping 5 - 7 days</div>
        </div>
        <div class="unit-compare-sec">
            <div class="price"><?php echo e($val->price); ?></div>
        </div>
        <div class="unit-compare-delete">
            <form method="POST" action="<?php echo e(url('/paid' . '/' . $val->id)); ?>" accept-charset="UTF-8" style="display:inline">
                <?php echo e(method_field('DELETE')); ?> <?php echo e(csrf_field()); ?>

                <div class="delete" data-toggle='modal' data-target='#confirmDelete' data-title='Delete Store' data-message='Are you sure you want to delete this Store ?'><i class="far fa-trash-alt"></i></div>
            </form>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="book-compare-price">
    <div class="heading">Discount</div>
    <div class="add-section" data-toggle="modal" data-target="#discountModal"><img src="/images/plus-icon.png" alt=""/> <span>ADD DISCOUNT</span></div>
    <?php $__currentLoopData = $paidDiscount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="row-compare-one sec-two">
        <div class="unit-compare-sec">
            <div class="image-box">
                <img src="/uploads/storeimage/<?php echo e($val->store_logo); ?>" width="100%" alt="image" />
            </div>
        </div>
        <div class="unit-compare-sec-three">
            <div class="heading"><?php echo e($val->discount); ?> % OFF & Free shipping</div>
            <div class="content"><?php echo e($val->desc); ?></div>
        </div>
        <div class="unit-compare-delete">
            <form method="POST" action="<?php echo e(url('/paid/deleteDiscount' . '/' . $val->id)); ?>" accept-charset="UTF-8" style="display:inline">
                <!-- <?php echo e(method_field('DELETE')); ?> -->
                <?php echo e(csrf_field()); ?>

                <div class="delete" data-toggle='modal' data-target='#confirmDelete' data-title='Delete Discount' data-message='Are you sure you want to delete this discount ?'><i class="far fa-trash-alt"></i></div>
            </form>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<!-- Modal -->
<div id="storeModal" class="modal fade createbook-Modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-text">Add Store</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="ample-login-signup">
                    <div class="ample-login-section">
                        <form action="<?php echo e(url('/paid')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <!-- <div class="unit-compare-sec">
                                <div class="image-box">
                                    <img src="/uploads/storeimage/amaz.png" alt="amazon">
                                </div>
                            </div> -->
                            <div class="button-paid-book"><input type="submit" value="CHANGE LOGO" onclick="document.getElementById('fileInputStore').click();"></div>
                            <input type="file" id="fileInputStore" name="store_logo" style="display: none;">
                            <div class="form-group">
                                <div class="heading">STORE NAME</div>
                                <input type="text" name="store_name" id="store_name" required="required" placeholder="Enter store name">
                            </div>
                            <div class="unit1">
                                <div class="form-group">
                                    <div class="heading">PRICE</div>
                                    <input type="number" name="price" min="0" id="price"/>
                                </div>
                            </div>
                            <div class="unit2">
                                <div class="form-group">
                                    <div class="heading">LINK</div>
                                    <input type="url" id="link" name="link" required="required" placeholder="Enter URL"/>
                                </div>
                            </div>
                            <div class="unit1">
                                <div class="form-group">
                                    <input type="hidden" name="book_id" value="<?php echo e($book->id); ?>">
                                    <button type="submit" class="submit-button">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer no-border">
            </div>
        </div>
    </div>
</div>
<div id="discountModal" class="modal fade createbook-Modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-text">Add/EDIT DISCOUNT</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="ample-login-signup">
                    <div class="ample-login-section">
                        <form action="<?php echo e(url('/paid/discountSave')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="unit1 first-sec">
                                <div class="form-group">
                                    <div class="heading">STORE</div>
                                    <select class="form-control" name="paid_ebook_id" id="store">
                                        <?php $__currentLoopData = $paid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($val->id); ?>"><?php echo e($val->store_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="unit2 second-sec">
                                <div class="form-group">
                                    <div class="heading">DISCOUNT</div>
                                    <input type="number" name="discount" min="1" id="discount" placeholder="Discount %" required="required"/>
                                </div>
                            </div>
                            <div class="unit1 first-sec">
                                <div class="form-group">
                                    <div class="heading">Additional Options</div>
                                    <select id="addOption" name="additional_options" class="form-control">
                                        <option value="free_shipping">Free Shipping</option>
                                        <option value="paid">Paid</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="unit3">
                                <div class="form-group">
                                    <div class="heading">DESCRIPTION</div>
                                    <textarea id="desc" name="desc" placeholder="Enter Description" required="required" style="margin-top: 10px;"></textarea>
                                </div>
                            </div>
                            <div class="unit1">
                                <div class="form-group">
                                    <input type="hidden" name="book_id" value="<?php echo e($book->id); ?>">
                                    <button type="submit" class="submit-button">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer no-border">
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<?php $__currentLoopData = $paid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div id="storeEditModal-<?php echo e($val->id); ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">EDIT LINK</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(url('/paid/'.$val->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo e(method_field('PATCH')); ?> <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="url" name="link" class="form-control" required="required" value="<?php echo e($val->link); ?>">
                    </div>
                    <button type="submit" class="btn btn-default">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
<?php echo $__env->make('modals.modal-delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php endif; ?> 
<div class="save-cancel-btn edit">
    <div class="save">
        <input type="button" id="submitEditFormBtn" value="Save"/>
    </div>
    <div class="cancel">
        <label>Cancel</label>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('footer_scripts'); ?> <?php echo $__env->make('scripts.delete-modal-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>