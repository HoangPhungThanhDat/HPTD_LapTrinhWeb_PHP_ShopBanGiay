<?php
require_once "../Models/Menu.php";

$menu = new Menu();

$list_menu=$menu->getList('index');

$all_category = $menu->list_Category();
$all_brand = $menu->list_Brand();
$all_post = $menu->list_Post();
$all_topic = $menu->list_Topic();

$html_category_name = '';
$html_brand_name = '';
$html_post_name = '';
$html_topic_name = '';

foreach ($all_category as $category) {
    $html_category_name .= "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
}

foreach ($all_brand as $brand) {
    $html_brand_name .= "<option value='" . $brand['id'] . "'>" . $brand['name'] . "</option>";
}

foreach ($all_post as $post) {
    $html_post_name .= "<option value='" . $post['id'] . "'>" . $post['type'] . "</option>";
}
foreach ($all_topic as $topic) {
    $html_topic_name .= "<option value='" . $topic['id'] . "'>" . $topic['name'] . "</option>";
}

?>



<?php require_once "../views/backend/header.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Quản Lý Menu</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-12 text-right">
            <a href="" class="btn btn-sm btn-danger">
                <i class="fa fa-trash" aria-hidden="true"></i>Thùng Rác
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
            <div class="col-md-3">
              <form action="}" method="post">
                
                <div class="accordion" id="accordionExample">
                    <div class="card p-3">
                        <label for="position">Vị trí</label>
                        <select name="position" id="position" class="form-control">
                            <option value="mainmenu">Main Menu</option>
                            <option value="footermenu">Footer Menu</option>
                        </select>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingCategory">
                            <a class="d-block" data-toggle="collapse"
                                data-target="#collapseCategory" aria-expanded="true"
                                aria-controls="collapseCategory">
                                Danh mục
                            </a>
                        </div>
                        <div id="collapseCategory" class="collapse"
                            aria-labelledby="headingCategory" data-parent="#accordionExample">
                            <div class="card-body">
                            
                            <?php foreach ($all_category as $category): ?>
    <div class="form-check mb-2">
        <input class="form-check-input" name="categoryid[]" type="checkbox" value="<?= $category['id']; ?>" id="category_<?= $category['id']; ?>">
        <label class="form-check-label" for="category_<?= $category['id']; ?>">
            <?= $category['name']; ?>
        </label>
    </div>
<?php endforeach; ?>
                          


                                
                                <div class="mb-3">
                                    <input type="submit" name="createCategory" class="btn btn-success" value="Thêm Menu">
                                </div>
                            </div>
                        </div>
                    </div>
<div class="card">
                        <div class="card-header" id="headingcategory">
                            <a class="d-block" data-toggle="collapse"
                                data-target="#collapseBrand" aria-expanded="true"
                                aria-controls="collapseBrand">
                                Thương hiệu
                            </a>
                        </div>
                        <div id="collapseBrand" class="collapse"
                            aria-labelledby="headingBrand" data-parent="#accordionExample">
                            <div class="card-body">
                               
                             <?php foreach ($all_brand as $brand): ?>
    <div class="form-check mb-2">
        <input class="form-check-input" name="brandid[]" type="checkbox" value="<?= $brand['id']; ?>" id="brand_<?= $brand['id']; ?>">
        <label class="form-check-label" for="brand_<?= $brand['id']; ?>">
            <?= $brand['name']; ?>
        </label>
    </div>
<?php endforeach; ?>


                               
                                <div class="mb-3">
                                    <input type="submit" name="createBrand" class="btn btn-success" value="Thêm Menu">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                    <div class="card">
                        <div class="card-header" id="headingTopic">
                            <a class="d-block" data-toggle="collapse"
                                data-target="#collapseTopic" aria-expanded="true"
                                aria-controls="collapseTopic">
                               Chủ đề
                            </a>
                        </div>
                        <div id="collapseTopic" class="collapse"
                            aria-labelledby="headingTopic" data-parent="#accordionExample">
                            <div class="card-body">
                               
                            <?php foreach ($all_topic as $topic): ?>
    <div class="form-check mb-2">
        <input class="form-check-input" name="topicid[]" type="checkbox" value="<?= $topic['id']; ?>" id="topic_<?= $topic['id']; ?>">
        <label class="form-check-label" for="topic_<?= $topic['id']; ?>">
            <?= $topic['name']; ?>
        </label>
    </div>
<?php endforeach; ?>
                              
                                <div class="mb-3">
                                    <input type="submit" name="createTopic" class="btn btn-success" value="Thêm Menu">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                    <div class="card">
                        <div class="card-header" id="headingPage">
<a class="d-block" data-toggle="collapse"
                                data-target="#collapsePage" aria-expanded="true"
                                aria-controls="collapsePage">
                                Trang đơn
                            </a>
                        </div>
                        <div id="collapsePage" class="collapse"
                            aria-labelledby="headingPage" data-parent="#accordionExample">
                            <div class="card-body">
                               
                            <?php foreach ($all_post as $post): ?>
    <div class="form-check mb-2">
        <input class="form-check-input" name="postid[]" type="checkbox" value="<?= $post['id']; ?>" id="post_<?= $post['id']; ?>">
        <label class="form-check-label" for="post_<?= $post['id']; ?>">
            <?= $post['type']; ?>
        </label>
    </div>
<?php endforeach; ?>

                           
                                <div class="mb-3">
                                    <input type="submit" name="createPage" class="btn btn-success" value="Thêm Menu">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                    <div class="card">
                        <div class="card-header" id="headingCustom">
                            <a class="d-block" data-toggle="collapse"
                                data-target="#collapseCustom" aria-expanded="true"
                                aria-controls="collapseCustom">
                                Tùy liên kết
                            </a>
                        </div>
                        <div id="collapseCustom" class="collapse"
                            aria-labelledby="headingCustom" data-parent="#accordionExample">
                            <div class="card-body">
<div class="mb-3">
                                    <label for="name">Tên menu</label>
                                    <input type="text" value="" name="name" id="name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="link">Liên kết</label>
                                    <input type="text" value="" name="link" id="link" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <input type="submit" name="createCustom" class="btn btn-success" value="Thêm Menu">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                    <div class="card p-3">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="2">Chưa xuất bản</option>
                            <option value="1">Xuất bản</option>
                        </select>
                    </div>
                </div>
            </form>
            </div>
            <div class="col-md-9">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width:30px" class="text-center">#</th>
                            <th>name</th>
                            <th>link</th>
                            <th>position</th>
                            <th style="width:180px"class="text-center">function</th>
                            <th style="width:30px"class="text-center">id</th>
                        </tr>
                    </thead>
                    <tbody> 
                    <?php foreach ($list_menu as $row) :?>
                      <tr>
                        <td class="text-center">
                            <input type="checkbox">
                        </td>
                        <td><?=$row['name'];?></td>
                        <td> <?=$row['link'];?></td>
                        <td> <?=$row['position'];?></td>
                        <td class="text-center">
                         
                              <!-- Các chức năng -->
                    <?php if($row['status'] == 1): ?>
                                        <a href="index.php?option=menu&cat=status&id=<?=$row['id'];?>" class="btn btn-sm btn-success">
                                            <i class="fas fa-toggle-on"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="index.php?option=menu&cat=status&id=<?=$row['id'];?>" class="btn btn-sm btn-danger">
                                            <i class="fas fa-toggle-off"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <a href="index.php?option=menu&cat=show&id=<?=$row['id'];?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="index.php?option=menu&cat=edit&id=<?=$row['id'];?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?option=menu&cat=delete&id=<?=$row['id'];?>" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                                <td class="text-center"><?=$row['id'];?></td>
                            </tr>
                        
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </section>
    
 
  </div>

<?php require_once "../views/backend/footer.php";?>