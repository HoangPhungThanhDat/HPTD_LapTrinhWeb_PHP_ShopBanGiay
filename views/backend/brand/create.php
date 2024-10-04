<?php
$html_sort_order = '';
if (is_array($list) && count($list) > 0) {
    foreach ($list as $item) {
       
        $html_sort_order .= "<option  value='" . ($item['sort_order'] + 1) . "'>Sau: " . $item['name'] . "</option>";
    }
}
?>
<form action="index.php?option=brand&cat=process" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name">Tên thương hiệu</label>
        <input type="text" value="" name="name" id="name" class="form-control">

    </div>
    <div class="mb-3">
        <label for="description">Mô tả</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="sort_order">Sắp xếp</label>
        <select name="sort_order" id="sort_order" class="form-control">
            <option value="0">None</option>
            <?= $html_sort_order; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="image">Hình</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>
    <div class="mb-3">
        <label for="status">Trạng thái</label>
        <select name="status" id="status" class="form-control">
            <option value="2">Chưa xuất bản</option>
            <option value="1">Xuất bản</option>
        </select>
    </div>
    <button type="submit" name="CREATE" class="btn btn-success px-5"></i>
        Lưu [Thêm]
    </button>
</form>