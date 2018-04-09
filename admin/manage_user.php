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
                  <div id="table1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                  	<div class="row be-datatable-body">
                  		<div class="col-sm-12">
                  			<table id="table1" class="table table-striped table-hover table-fw-widget dataTable no-footer" role="grid" aria-describedby="table1_info">
                    <thead>
                      <tr role="row"><th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 174px;"><a href='manage_user.php?order=fn'>First Name</a></th><th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 225px;"><a href='manage_user.php?order=ln'>Last Name</a></th><th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 204px;"><a href='manage_user.php?order=email'>Email</a></th><th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 204px;"><a href='manage_user.php?order=lv'>User Level</a></th><th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 146px;">Sửa</th><th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 110px;">Xóa</th></tr>
                    </thead>
                    <tbody>
                    	<?php 
                    		if(isset($_GET['order'])){
                    			switch ($_GET['order']) {
                    				case 'fn':
                    					$order = "first_name";
                    					break;
                    				case 'ln':
                    					$order = "last_name";
                    					break;
                    				case 'email':
                    					$order = "email";
                    					break;
                    				case 'lv':
                    					$order = "user_level";
                    				default:
                    					$order = "first_name";
                    					break;
                    			}
                    		}else{
                    			$order = "first_name";
                    		}
                    	 ?>
                      
                    <?php 
                        $pt = getStartAndLimitForAdmin("SELECT COUNT(user_id) FROM users"); 
                    	$q = "SELECT user_id,first_name,last_name,email,user_level FROM users ORDER BY {$order} ASC";
                    	$r = mysqli_query($dbc,$q);
                    	check_query($r,$q);
                    	if(mysqli_num_rows($r) > 0){
                    		while($user = mysqli_fetch_array($r)){
                    			echo "
                    			<tr class='gradeA odd' role='row'>
                        			<td class='sorting_1'>{$user['first_name']}</td>
                        			<td>{$user['last_name']}</td>
                        			<td>{$user['email']}</td>
                        			<td>{$user['user_level']}</td>
                        			<td class='center'><button class='btn btn-space btn-warning'><a href='edit_user.php?id={$user['user_id']}'><font color='white'>Sửa</font></a></button></td>
                        			<td class='center'><button class='btn btn-space btn-danger'><a href='delete_user.php?id={$user['user_id']}'><font color='white'>Xóa</font></a></button></td>
                      			</tr>";

                    		}
                    	}else{
                    		echo "Không có dữ liệu";
                    	}
                     ?>
                      
                    </tbody>
                  </table></div></div><div class="row be-datatable-footer"><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="table1_paginate"><ul class="pagination">
                    <?php 
                            if($pt['page'] > 1){
                              echo "<li class='paginate_button previous disabled' id='table1_previous'><a href='manage_user.php?page=".($pt['page']-1)."' aria-controls='table1' data-dt-idx='0' tabindex='0'>Previous</a></li>";
                            }
                            for($i=1;$i<=$pt['total_page'];$i++){
                              if($i == $pt['page']){
                                echo "<li class='paginate_button active'><a href='manage_user.php?page=".$i."' aria-controls='table1' data-dt-idx='".$i."' tabindex='0'>".$i."</a></li>";
                              }else{
                                echo "<li class='paginate_button '><a href='manage_user.php?page=".$i."' aria-controls='table1' data-dt-idx='".$i."' tabindex='0'>".$i."</a></li>";
                              }
                            }
                            if($pt['page']<$pt['total_page'] && $pt['total_page']>1){
                              echo "<li class='paginate_button next' id='table1_next'><a href='manage_user.php?page=".($pt['page']+1)."' aria-controls='table1' data-dt-idx='7' tabindex='0'>Next</a></li>";
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