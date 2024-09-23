<div class="container-fluid px-4">
    <div class="mt-4">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/Web_HaiTrieu/manager/index">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/Web_HaiTrieu/member/index">Danh sách người dùng</a></li>
            <li class="breadcrumb-item active">Phân quyền người dùng</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            ID Người dùng: <span><?= $id ?></span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-7">
                    <h4>Thông tin tài khoản</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th>Tên tài khoản</th>
                            <td><?= $obj['UserName'] ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $obj['Email'] ?></td>
                        </tr>
                        <tr>
                            <th>Giới tính</th>
                            <td><?= $obj['Gender'] ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-5">
                    <h4>Phân quyền</h4>
                    <table class="table table-bordered">
                        <?php foreach ($role as $v) : ?>
                            <tr>
                                <th><?= $v['RoleName'] ?></th>
                                <td><input type="checkbox" class="checkRole" value="<?= $v['RoleId'] ?>" <?= $v['Checked'] ? 'checked' : '' ?>></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<SCript>
    $('.checkRole').on('click', function() {
        let rid = $(this).val();
        let mid = $('.card-header span').text().trim();

        $.post('/Web_HaiTrieu/member/addRole', {
            'mid': mid,
            'rid': rid
        }, (d) => {
            //
        });
    });
</SCript>