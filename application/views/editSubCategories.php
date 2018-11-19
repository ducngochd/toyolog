<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-files-o"></i> サブカテゴリ管理
        <!-- <small>Add / Edit User</small> -->
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">サブカテゴリ作成</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>addNewSubCategories" method="post" role="form">
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role">カテゴリ</label>
                                            <select class="form-control required" id="role" name="role">
                                                <option value="0">---------</option>
                                                <?php
                                                if(!empty($userRecords))
                                                {
                                                    foreach ($userRecords as $temp)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $temp->id ?>" <?php if($temp->id == $subCategoriesInfo->id){echo "selected=selected";}  ?>><?php echo $temp->category ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                </div> 
                            </div>


                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">サブカテゴリ名</label>
                                        <input type="text" class="form-control required" value="<?php echo $subCategoriesInfo->subCategories?>" id="fname" name="fname" maxlength="128">
                                        <input type="hidden" value="<?php echo $subCategoriesInfo->id; ?>" name="situationId" id="situationId" />    

                                    </div>
                                    
                                </div>
                            </div>

 

                          
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="追加" />
                            <a href="<?php echo base_url();?>subCategoriesListing"><input type="button" class="btn btn-default" value="前のページへ戻る" /></a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>