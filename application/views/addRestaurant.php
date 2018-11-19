    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <i class="fa fa-users"></i> 店作成
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
                            <h3 class="box-title">作成</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <?php $this->load->helper("form"); ?>

                        <form role="form" id="addUser" action="<?php echo base_url();?>addNewRestaurant" method="post" role="form" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="file" name="picture" id="profile-img">
                                            <img src="" id="profile-img-tag" width="200px" />
                                        </div>
 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">                                
                                        <div class="form-group">
                                            <label for="fname">店名</label>
                                            <input type="text" class="form-control required" value="<?php echo set_value('fname'); ?>" id="fname" name="fname" maxlength="128">
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role">地域</label>
                                            <select class="form-control required" id="role" name="role">
                                                <option value="0">---------</option>
                                                <?php
                                                if(!empty($city))
                                                {
                                                    foreach ($city as $key => $value)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
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
                                            <label for="role">カテゴリ</label>
                                            <select class="form-control required" id="role" name="role">
                                                <option value="0">---------</option>
                                                <?php
                                                if(!empty($categories))
                                                {
                                                    foreach ($categories as $object )
                                                    {
                                                        ?>
                                                        <option value="<?php echo $object->id ?>"><?php echo $object->category ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="col-xs-12 col-sm-6 col-md-6">                                
                                        <div class="form-group">
                                            <label>サブカテゴリ</label>
                                            <select class="form-control select2" multiple="multiple" data-placeholder="サブカテゴリ">
                                                <?php
                                                if(!empty($subCategories))
                                                {
                                                    foreach ($subCategories as $object )
                                                    {
                                                        ?>
                                                        <option value="<?php echo $object->id ?>"><?php echo $object->subCategories ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        
                                    </div>  
                                </div>


                                <div class="row">
                                    <div class="form-group">
                                    <!-- <label class="col-lg-2 control-label" for="role">価格</label> -->

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="role">価格から</label>
                                                <select  class="form-control required" id="price_from" name="price_from">
                                                    <option value="0">---------</option>
                                                    <?php
                                                    if(!empty($price))
                                                    {
                                                        foreach ($price as $key => $value)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                    </div>  
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="role">価格まで</label>
                                                <select class="form-control required" id="price_to" name="price_to">
                                                    <option value="0">---------</option>
                                                    <?php
                                                    if(!empty($price))
                                                    {
                                                        foreach ($price as $key => $value)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <!-- <a class="btn btn-primary" href="<?php echo base_url(); ?>addNew"><i class="fa fa-plus"></i> ユーザー作成</a> -->

                                            </div>
                                        </div>
                                        </div> 
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">シチュエーション</label>
                                                <select class="form-control required" id="type" name="type">
                                                    <option value="0">---------</option>
                                                    <?php
                                                    if(!empty($type))
                                                    {
                                                        foreach ($type as $tp)
                                                        {
                                                            ?>
                                                                <option value="<?php echo $tp->situationId ?>" ><?php echo $tp->situation ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>  
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="mobile">コメンート</label>
                                            <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>

                                            <!-- <input type="text" class="form-control required digits" id="mobile" value="<?php echo set_value('mobile'); ?>" name="mobile" maxlength="10"> -->
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select class="form-control required" id="role" name="role">
                                                <option value="0">地域を選択する</option>
                                                <?php
                                                if(!empty($roles))
                                                {
                                                    foreach ($roles as $rl)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $rl->roleId ?>" <?php if($rl->roleId == set_value('role')) {echo "selected=selected";} ?>><?php echo $rl->role ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>     -->
                                </div>
                            </div><!-- /.box-body -->
        
                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary" value="アプロード" />
                                <input type="reset" class="btn btn-default" value="リセット" />
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
            </div>    
        </section>
        
    </div>
        <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(".select2").select2();

        $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });
</script>
    <script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>
