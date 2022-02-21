<link rel="stylesheet" type="text/css" href="{{asset('customer_template/css/main.css')}}">
<style>
			table {
					width: 100%;
					margin-left: auto;
					margin-right: auto;
			}
			.table-order-info p{
					margin: 0px 0px 5px 0px;
					font-size: 14px;
					color: #333;
			}
			.table-footer p{
					margin: 0px 0px 5px 0px;
					font-size: 14px;
					color: #333;
			}
	</style>
    <table class="table-order-info">
			<tr>
				<td>
					<p>Dear <b>{{$data['user_name']}}</b>, </p>
					<p>Your Hire Dress account will be activate after click on the active link.</p>
					<p class="text-center">
						<a href="{{url('active-account/base64_encode($data['id'])')}}" style='color:green;font-size:20px'>ACTIVE</a>
					</p>
					<p>Kind Regards,<br><b>Hire Dress</b></p>
					<!-- <p>GiBo</p> -->
				</td>
			</tr>
    </table>
