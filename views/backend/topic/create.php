<?php

$html_sort_order = '';
if (is_array($list) && count($list) > 0) {
    foreach ($list as $item) {
      
        $html_sort_order .= "<option value='" . ($item['sort_order'] + 1) . "'> " . $item['name'] . "</option>";
    }
}
?>
<form action="index.php?option=topic&cat=process" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="staticTopic" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticTopicLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Thêm Chủ Đề
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name">Tên Chủ Đề(*)</label>
                        <input type="text" name="name" id="name" required class="form-control"
                            placeholder="VD: Áo thun">
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
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="2">Chưa xuất bản</option>
                            <option value="1">Xuất bản</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="CREATE" class="btn btn-success px-5"><i class="fas fa-save"></i>
                        Lưu [Thêm]
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>
                        Thoát</button>
                </div>
            </div>
        </div>
    </div>
</form>