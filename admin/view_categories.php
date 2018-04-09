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
                      <tr role="row"><th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 174px;"><a href='view_categories.php?order=cm'>Chuyên Mục</a></th><th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 225px;"><a href='view_categories.php?order=nt'>Người Tạo</a></th><th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 204px;"><a href='view_categories.php?order=pos'>Position</a></th><th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 146px;">Sửa</th><th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 110px;">Xóa</th></tr>
                    </thead>
                    <tbody>
                    	<?php 
                    		if(isset($_GET['order'])){
                    			switch ($_GET['order']) {
                    				case 'cm':
                    					$order = "cat_name";
                    					break;
                    				case 'nt':
                    					$order = "user_name";
                    					break;
                    				case 'pos':
                    					$order = "position";
                    					break;
                    				default:
                    					$order = "position";
                    					break;
                    			}
                    		}else{
                    			$order = "position";
                    		}
                    	 ?>
                      
                    <?php
                      $pt = getStartAndLimitForAdmin("SELECT COUNT(cat_id) FROM categories"); 
                    	$q = "SELECT cat_id,cat_name,CONCAT(first_name,' ',last_name) AS user_name,position FROM categories INNER JOIN users ON categories.user_id=users.user_id ORDER BY {$order} ASC LIMIT {$pt['start']},{$pt['limit']}";
                    	$r = mysqli_query($dbc,$q);
                    	check_query($r,$q);
                    	if(mysqli_num_rows($r) > 0){
                    		while($cat = mysqli_fetch_array($r)){
                    			echo "
                    			<tr class='gradeA odd' role='row'>
                        			<td class='sorting_1'>{$cat['cat_name']}</td>
                        			<td>{$cat['user_name']}</td>
                        			<td>{$cat['position']}</td>
                        			<td class='center'><button class='btn btn-space btn-warning'><a href='edit_categories.php?id={$cat['cat_id']}'><font color='white'>Sửa</font></a></button></td>
                        			<td class='center'><button class='btn btn-space btn-danger'><a href='delete_categories.php?id={$cat['cat_id']}&name={$cat['cat_name']}'><font color='white'>Xóa</font></a></button></td>
                      			</tr>";

                    		}
                    	}
                     ?>
                      
                    </tbody>
                  </table></div></div>
                  <div class="row be-datatable-footer">
                    <div class="col-sm-7">
                      <div class="dataTables_paginate paging_simple_numbers" id="table1_paginate">
                        <ul class="pagination">
                          <?php 
                            if($pt['page'] > 1){
                              echo "<li class='paginate_button previous disabled' id='table1_previous'><a href='view_categories.php?page=".($pt['page']-1)."' aria-controls='table1' data-dt-idx='0' tabindex='0'>Previous</a></li>";
                            }
                            for($i=1;$i<=$pt['total_page'];$i++){
                              if($i == $pt['page']){
                                echo "<li class='paginate_button active'><a href='view_categories.php?page=".$i."' aria-controls='table1' data-dt-idx='".$i."' tabindex='0'>".$i."</a></li>";
                              }else{
                                echo "<li class='paginate_button '><a href='view_categories.php?page=".$i."' aria-controls='table1' data-dt-idx='".$i."' tabindex='0'>".$i."</a></li>";
                              }
                            }
                            if($pt['page']<$pt['total_page'] && $pt['total_page']>1){
                              echo "<li class='paginate_button next' id='table1_next'><a href='view_categories.php?page=".($pt['page']+1)."' aria-controls='table1' data-dt-idx='7' tabindex='0'>Next</a></li>";
                            }
                          ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>
            </div>
        </div>
<?php include '../admin/include/nav-right.php'; ?>
<?php include '../admin/include/footer.php'; ?>