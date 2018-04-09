<?php include '../admin/include/header.php'; ?>
<?php include '../admin/include/nav.php'; ?>
<?php include '../admin/include/menu.php'; ?>
<?php require_once '../inc/connect.php'; ?>
<?php require_once '../inc/func.php'; ?>
<?php isLoggedIn(); ?>
        <div class="be-content">
            <div class="main-content container-fluid">
                <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
              
                <div class="panel-body">
                  <div class="row be-datatable-body"><div class="col-sm-12"><table id="table1" class="table table-striped table-hover table-fw-widget dataTable no-footer" role="grid" aria-describedby="table1_info">
                    <thead>
                      <tr role="row"><th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 174px;"><a href='view_pages.php?order=bv'>Bài Viết</a></th><th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 225px;"><a href='view_pages.php?order=cm'>Chuyên Mục</a></th><th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 204px;"><a href='view_pages.php?order=post'>Ngày Đăng</a></th><th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 146px;">Sửa</th><th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 110px;">Xóa</th></tr>
                    </thead>
                    <tbody>
                      <?php 
                        if(isset($_GET['order'])){
                          switch ($_GET['order']) {
                            case 'bv':
                              $order = "page_name";
                              $return = "ASC";
                              break;
                            case 'cm':
                              $order = "cat_name";
                              $return = "ASC";
                              break;
                            case 'post':
                              $order = "post_on";
                              $return = "DESC";
                              break;
                            default:
                              $order = "post_on";
                              $return = "DESC";
                              break;
                          }
                        }else{
                          $order = "post_on";
                          $return = "DESC";
                        }
                       ?>
                      
                    <?php
                      $pt = getStartAndLimitForAdmin("SELECT COUNT(page_id) FROM pages");
                      $q = "SELECT page_id,page_name,cat_name,post_on FROM pages INNER JOIN categories ON pages.cat_id=categories.cat_id ORDER BY {$order} {$return} LIMIT {$pt['start']},{$pt['limit']}";
                      $r = mysqli_query($dbc,$q);
                      check_query($r,$q);
                      if(mysqli_num_rows($r) > 0){
                        while($page = mysqli_fetch_array($r)){
                          echo "
                          <tr class='gradeA odd' role='row'>
                              <td class='sorting_1'>{$page['page_name']}</td>
                              <td>{$page['cat_name']}</td>
                              <td>{$page['post_on']}</td>
                              <td class='center'><button class='btn btn-space btn-warning'><a href='edit_pages.php?id={$page['page_id']}'><font color='white'>Sửa</font></a></button></td>
                              <td class='center'><button class='btn btn-space btn-danger'><a href='delete_pages.php?id={$page['page_id']}&name={$page['page_name']}'><font color='white'>Xóa</font></a></button></td>
                            </tr>";

                        }
                      }
                     ?>
                      
                    </tbody>
                  </table></div></div><div class="row be-datatable-footer"><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="table1_paginate"><ul class="pagination">
                   <?php 
                            if($pt['page'] > 1){
                              echo "<li class='paginate_button previous disabled' id='table1_previous'><a href='view_pages.php?page=".($pt['page']-1)."' aria-controls='table1' data-dt-idx='0' tabindex='0'>Previous</a></li>";
                            }
                            for($i=1;$i<=$pt['total_page'];$i++){
                              if($i == $pt['page']){
                                echo "<li class='paginate_button active'><a href='view_pages.php?page=".$i."' aria-controls='table1' data-dt-idx='".$i."' tabindex='0'>".$i."</a></li>";
                              }else{
                                echo "<li class='paginate_button '><a href='view_pages.php?page=".$i."' aria-controls='table1' data-dt-idx='".$i."' tabindex='0'>".$i."</a></li>";
                              }
                            }
                            if($pt['page']<$pt['total_page'] && $pt['total_page']>1){
                              echo "<li class='paginate_button next' id='table1_next'><a href='view_pages.php?page=".($pt['page']+1)."' aria-controls='table1' data-dt-idx='7' tabindex='0'>Next</a></li>";
                            }
                          ?>
                  </ul></div></div></div></div>
                </div>
              </div>
            </div>
          </div>
            </div>
        </div>
<?php include '../admin/include/nav-right.php'; ?>
<?php include '../admin/include/footer.php'; ?>