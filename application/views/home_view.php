<div class="header pb-12">
    <div class="container-fluid">
        <!-- <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Product</h5>
                                <span class="h2 font-weight-bold mb-0"><?php //echo $product->num_rows();?></span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <a href="<?php echo base_url();?>product" class="text-dark"><span class="text-nowrap">See more detail</span></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Brand</h5>
                                <span class="h2 font-weight-bold mb-0"><?php //echo $brand->num_rows();?></span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                    <i class="fa fa-tag"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <a href="<?php echo base_url();?>brand" class="text-dark"><span class="text-nowrap">See more detail</span></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Type</h5>
                                <span class="h2 font-weight-bold mb-0"><?php //echo $type->num_rows();?></span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                    <i class="fa fa-list"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <a href="<?php echo base_url();?>type" class="text-dark"><span class="text-nowrap">See more detail</span></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">New User</h5>
                                <span class="h2 font-weight-bold mb-0"><?php //echo $admin->num_rows();?></span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="fa fa-user-circle"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <a href="<?php echo base_url();?>user" class="text-dark"><span class="text-nowrap">See more detail</span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Welcome</h3>
                            </div>
                        </div>
                        <p><?php echo $app['app_description_full'];?></p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Social Media</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <tbody>
                                <?php foreach($sosmed as $data_sosmed) { ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $data_sosmed->social_media_name;?>
                                    </th>
                                    <td>
                                        <a href="<?php echo $data_sosmed->social_media_url;?>" target="_blank" class="btn btn-default btn-sm" style="background-color:#4267B2;"><i class="<?php echo $data_sosmed->social_media_icon;?>"></i> <?php echo $data_sosmed->social_media_name;?></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
