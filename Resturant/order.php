<?php
include('top.php');

$sql = "SELECT order_master.id,order_master.address,order_master.zipcode,dish.dish,dish.dish_detail,dish.image,dish.type,order_status.order_status FROM order_master,order_detail,dish_details,dish,order_status,restaurants WHERE order_master.id=order_detail.order_id AND order_master.order_status=order_status.id and order_detail.dish_details_id=dish_details.id and dish_details.dish_id=dish.id and order_detail.r_id=restaurants.r_id and restaurants.r_id=" . $Res_Id . "";
$res = mysqli_query($con, $sql);

?>
<div class="card">
	<div class="card-body">
		<h1 class="grid_title">Order Master</h1>
		<div class="row grid_box">

			<div class="col-12">
				<div class="table-responsive">
					<table id="order-listing" class="table">
						<!-- <thead>
							<tr>
								<th width="5%">Order Id</th>
								<th width="20%">Name/Email/Mobile</th> 

								<th width="20%">Address/Zipcode</th>
								<th width="5%">Price</th>
								<th width="10%">Payment Type</th>
								<th width="10%">Payment Status</th>
								<th width="10%">Order Status</th>
								<th width="15%">Added On</th>
							</tr>
						</thead> -->
						<tbody>
							<?php if (mysqli_num_rows($res) > 0) {
								$i = 1;
								while ($row = mysqli_fetch_assoc($res)) {
							?>
									<tr>
										<td>
											<div class="div_order_id">
												<a href="order_detail.php?id=<?php echo $row['id'] ?>"><?php echo $row['id'] ?></a>
											</div>
										</td>
										<!-- <td>
								<p><?php echo $row['name'] ?></p>
								<p><?php echo $row['email'] ?></p>
								<p><?php echo $row['mobile'] ?></p>
							<td> -->
										<td>
											<p><?php echo $row['address'] ?></p>
											<p><?php echo $row['zipcode'] ?></p>
										</td>
										<td>
											<p><?php echo $row['dish'] ?></p>
											<p><?php echo $row['dish_detail'] ?></p>
										</td>
										<td>
											<p><?php echo $row['type'] ?></p>
										</td>
										<!-- <td style="font-size:14px;"><?php echo $row['total_price'] ?><br/>
								<?php
									if ($row['coupon_code'] != '') {
								?>
								<?php echo $row['coupon_code'] ?><br/>
								<?php echo $row['final_price'] ?>
								<?php } ?>
							
							</td> -->
										<!-- <td><?php echo $row['payment_type'] ?></td>
							<td> -->
										<!-- <div class="payment_status payment_status_<?php echo $row['payment_status'] ?>"><?php echo ucfirst($row['payment_status']) ?></div>
							</td> -->
										<!-- <td><?php echo $row['order_status_str'] ?></td> -->
										<!-- <td>
							<?php
									$dateStr = strtotime($row['added_on']);
									echo date('d-m-Y h:s', $dateStr);
							?>
							</td> -->

									</tr>
								<?php
									$i++;
								}
							} else { ?>
								<tr>
									<td colspan="6">No data found</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>