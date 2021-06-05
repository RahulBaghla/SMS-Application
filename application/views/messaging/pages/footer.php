    <!-- External jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- <script type="text/javascript" src="./js/jquery-1.12.3.min.js"></script> -->
	<script type="text/javascript" src="<?php echo base_url('assets/js/welcome.js') ?>"></script>
	<script type="text/javascript">
		// basic usage
		$('.tablemanager').tablemanager({
			firstSort: [[3,0],[2,0],[1,'asc']],
			disable: ["last"],
			appendFilterby: true,
			dateFormat: [[4,"mm-dd-yyyy"]],
			debug: true,
			vocabulary: {
    voc_filter_by: 'Filter By',
    voc_type_here_filter: 'Filter...',
    voc_show_rows: 'Rows Per Page'
  },
			pagination: true,
			showrows: [5,10,20,50,100],
			disableFilterBy: [1]
		});
		// $('.tablemanager').tablemanager();
	</script>
	
<?php 
	function fetchData(){
		$postRequest = array(
			'apikey' => 'e9367726-cab5-426e-b8a1-21ce7d4af7cc',
			'start' => '11'
		);
		
		$cURLConnection = curl_init('http://gdemo.schoolpad.in/externalApiManager/getStudentCounts');
		curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
		curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
		
		$apiResponse = curl_exec($cURLConnection);
		curl_close($cURLConnection);
		
		$jsonArrayResponse = json_decode($apiResponse)->data;
		return $jsonArrayResponse;
	}
	?>
</body>
</html>
