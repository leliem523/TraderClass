
<?php $__env->startSection('title', $row->title); ?>
<?php $__env->startSection('content'); ?>
<form method="post" enctype="multipart/form-data">
    <?php echo $__env->make('Dashboard::inc.formheader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('Dashboard::inc.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card-box">
                <h4 class="header-title mb-3"><?php echo e($row->desc); ?></h4>
                <div class="form-group mb-2">
                    <label for="title">Crypto name</label>
                    
                    <select class="form-control form-control-sm symbol-id" name="name">
                        <?php $__currentLoopData = $name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value['id']); ?>" <?php echo e(old('name',$data->name)==$value['id']? "selected" :""); ?>><?php echo e($value['name'] .' ('.$value['symbol'] .')'); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="title">Địa chỉ</label>
                    <input type="text" name="address" value="<?php echo e(old('address', $data->address)); ?>" class="form-control form-control-sm" placeholder="* địa chỉ">
                </div>
                <div class="form-group mb-2">
                    <label>Symbol</label>
                    <select class="form-control form-control-sm symbol-id" name="symbol">
                        <?php $__currentLoopData = $symbol; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(substr($value['symbol'],-4)=="USDT"): ?>
                            <option value="<?php echo e($value['symbol']); ?>" <?php echo e(old('symbol',$data->symbol)==$value['symbol']? "selected" :""); ?>><?php echo e($value['symbol']); ?></option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="title">price</label>
                    <p class="form-control-sm price_api"><?php echo e($data_price['price']); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-box">
                <h5 class="header-title text-uppercase bg-light p-2 mb-2"><i class="fe-image mr-1"></i> Hình ảnh</h5>
                <?php if($data->image!=""): ?>
                <div class="form-group mb-2">
                    <img src="/public/upload/images/crypto/large/<?php echo e($data->image); ?>" style="width: auto;max-width: 100%">
                </div>
                <?php endif; ?>
                <div class="form-group mb-2">
                    <?php
                    $thumbsize = json_decode($settings["THUMB_SIZE_CRYPTO"]);
                    ?>
                    <label>Upload (jpg,png) [<?php echo e($thumbsize->width."x".$thumbsize->height); ?>px]</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input " name="photo" id="photo">
                            <label class="custom-file-label" for="photo">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label>Trạng thái</label>
                    <select class="form-control form-control-sm" name="status">
                        <option value="1" <?php echo e(old('status',$data->status)==1? "selected" :""); ?>>Kích hoạt</option>
                        <option value="0" <?php echo e(old('status',$data->status)==0? "selected" :""); ?>>Khóa</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('Dashboard::inc.formfooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>
<script>
    $(document).ready(function() {
        $(".symbol-id").click(function() {
            var _token = $('meta[name="csrf-token"]').attr('content');
            let id_symbol = $(this).val();
    
            $.ajax({
                url: "/dashboard/crypto/price-api-crypto",
                type: "POST",
                data: {
                    _token: _token,
                    id_symbol: id_symbol,
                },
                success: function(data) {
                    //console.log(data);
                    $(".price_api").html(data.price);
                }
            });
        });
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Dashboard::layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/traderclass_dashboard/public_html/app/Modules/Dashboard/Views/crypto/edit.blade.php ENDPATH**/ ?>