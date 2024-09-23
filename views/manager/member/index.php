<div class="container-fluid px-4">
    <div class="mt-4">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/Web_HaiTrieu/manager/index">Trang chủ</a></li>
            <li class="breadcrumb-item active">Danh sách người dùng</li>
        </ol>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách người dùng
        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered">
                <thead class="table-warning">
                    <tr class="text-center">
                        <th>ID Người dùng</th>
                        <th>Tên tài khoản</th>
                        <th>Email</th>
                        <th>Giới tính</th>
                        <th>Tác Vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mrr as $v) : ?>
                        <tr>
                            <td><?= $v['MemberId'] ?></td>
                            <td><?= $v['UserName'] ?></td>
                            <td class="text-center"><?= $v['Email'] ?></td>
                            <td class="text-center"><?= $v['Gender'] ?></td>
                            <td class="text-center">
                                <a class="btn btn-primary" href="/Web_HaiTrieu/member/roles/<?= $v['MemberId'] ?>">Phân quyền</a>
                                <button class="del btn btn-danger">Xóa</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>