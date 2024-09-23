<div class="container-fluid px-4">
    <div class="mt-4">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/Web_HaiTrieu/manager/index">Trang chủ</a></li>
            <li class="breadcrumb-item active">Thêm sản phẩm</li>
        </ol>
    </div>
    <h4 class="text-center">Thêm sản phẩm</h4>
    <form action="/Web_HaiTrieu/product/doAdd" method="post" enctype="multipart/form-data">
        <div class="row mt-3 d-flex justify-content-center">
            <label for="cat" class="col-3 form-label">Danh mục <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <select name="cid" id="cat" class="form-select">
                    <?php foreach ($crr as $v) : ?>
                        <option value="<?= $v['CategoryId'] ?>"><?= $v['CategoryName'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="brand" class="col-3 form-label">Thương hiệu <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <select name="bid" id="brand" class="form-select">
                    <?php foreach ($brr as $v) : ?>
                        <option value="<?= $v['BrandId'] ?>"><?= $v['BrandName'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="name" class="col-3 form-label">Tên sản phẩm <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="fb" class="col-3 form-label">Ảnh bìa <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <input type="file" name="fb" id="fb" class="form-control" required accept="image/*">
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="desc" class="col-3 form-label">Mô tả <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <textarea name="desc" id="desc" class="form-control"></textarea>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="price" class="col-3 form-label">Giá bán <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <input type="number" name="price" id="price" class="form-control" required>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="qty" class="col-3 form-label">Số lượng <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <input type="number" name="qty" id="qty" class="form-control" required>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="f" class="col-3 form-label">Hình ảnh chi tiết <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <input type="file" name="f[]" id="f" class="form-control" multiple accept="image/*" required>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <label for="attr" class="col-3 form-label">Thông tin sản phẩm <span class="text-danger">(*)</span></label>
            <div class="col-9">
                <table class="table table-bordered">
                    <?php foreach ($arr as $v) : ?>
                        <tr>
                            <td><?= $v['AttributeName'] ?></td>
                            <td>
                                <input type="hidden" name="ids[]" value="<?= $v['AttributeId'] ?>">
                                <input type="text" name="values[]" id="attr" class="form-control">
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
        <div class="mt-3 mb-3 d-flex justify-content-center">
            <button class="btn btn-primary me-2">Thêm mới</button>
            <a href="/Web_HaiTrieu/product/index" class="btn btn-success">Quay lại</a>
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