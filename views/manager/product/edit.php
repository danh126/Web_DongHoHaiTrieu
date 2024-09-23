<div class="container-fluid px-4">
    <div class="mt-4">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/Web_HaiTrieu/manager/index">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/Web_HaiTrieu/product/index/?page=<?= $page ?>">Danh sách sản phẩm</a></li>
            <li class="breadcrumb-item active">Cập nhật sản phẩm</li>
        </ol>
    </div>
    <h4 class="text-center">Cập nhật sản phẩm</h4>
    <form action="/Web_HaiTrieu/product/doEdit/?id=<?= $o['ProductId'] ?>&page=<?= $page ?>" method="post" enctype="multipart/form-data">
        <div class="row mt-3 d-flex justify-content-center">
            <label for="cat" class="col-3 form-label">Danh mục <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <select name="cid" id="cat" class="form-select">
                    <?php foreach ($crr as $v) : ?>
                        <?php if ($o['CategoryId'] ==  $v['CategoryId']) : ?>
                            <option selected value="<?= $v['CategoryId'] ?>"><?= $v['CategoryName'] ?></option>
                        <?php else : ?>
                            <option value="<?= $v['CategoryId'] ?>"><?= $v['CategoryName'] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="brand" class="col-3 form-label">Thương hiệu <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <select name="bid" id="brand" class="form-select">
                    <?php foreach ($brr as $v) : ?>
                        <?php if ($o['BrandId'] ==  $v['BrandId']) : ?>
                            <option selected value="<?= $v['BrandId'] ?>"><?= $v['BrandName'] ?></option>
                        <?php else : ?>
                            <option value="<?= $v['BrandId'] ?>"><?= $v['BrandName'] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="name" class="col-3 form-label">Tên sản phẩm <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <input type="text" value="<?= $o['ProductName'] ?>" name="name" id="name" class="form-control" required>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="fb" class="col-3 form-label">Ảnh bìa <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <input type="hidden" name="url" value="<?= $o['ImageUrl'] ?>">
                <input type="file" name="fb" id="fb" class="form-control" accept="image/*">
                <img width="100" class="img-thumbnail" src="/Web_HaiTrieu/public/images/product/<?= $o['ImageUrl'] ?>" alt="<?= $o['ProductName'] ?>">
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="desc" class="col-3 form-label">Mô tả <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <textarea name="desc" id="desc" class="form-control"><?= $o['Description'] ?></textarea>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="price" class="col-3 form-label">Giá bán <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <input type="number" value="<?= $o['Price'] ?>" name="price" id="price" class="form-control" required>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="qty" class="col-3 form-label">Số lượng <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <input type="number" value="<?= $o['Quantity'] ?>" name="qty" id="qty" class="form-control" required>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="f" class="col-3 form-label">Hình ảnh chi tiết</label>
            <div class="col-9">
                <input type="file" name="f[]" id="f" class="form-control" multiple accept="image/*">
                <?php
                if ($irr != null) :
                    foreach ($irr as $v) :
                ?>
                        <input type="hidden" name="urls[]" value="<?= $v['ImageUrl'] ?>">
                        <img width="100" class="img-thumbnail" src="/Web_HaiTrieu/public/images/imgdetails/<?= $v['ImageUrl'] ?>" alt="<?= $o['ProductName'] ?>">
                <?php endforeach;
                endif ?>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="attr" class="col-3 form-label">Thông tin sản phẩm</label>
            <div class="col-9">
                <table class="table table-bordered">
                    <?php foreach ($arr as $v) : ?>
                        <tr>
                            <td><?= $v['AttributeName'] ?></td>
                            <td>
                                <input type="hidden" name="ids[]" value="<?= $v['AttributeId'] ?>">
                                <input type="text" name="values[]" id="attr" value="<?= $v['Value'] ?>" class="form-control">
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
        <div class="mt-3 mb-3 d-flex justify-content-center">
            <button class="btn btn-primary me-2">Cập nhật</button>
            <a href="/Web_HaiTrieu/product/index/?page=<?= $page ?>" class="btn btn-success">Quay lại</a>
        </div>
    </form>
</div>
<script>
    ClassicEditor
        .create(document.querySelector('#desc'))
        .catch(error => {
            console.error(error);
        });
</script>