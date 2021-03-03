<?php
$username = $_GET['id'];

function cut_str($str, $left, $right) {
	$front = explode($left, $str);
	$returnVar = array();
	
	foreach($front as $value) {
		if(strpos($value, $right) !== false) {
			$end = explode($right, $value);
			$returnVar[] = $end[0];
		}
	}
	
	foreach($returnVar as $key => $value) {
		if(substr($value, 0, 9) == '<!DOCTYPE') unset($returnVar[$key]);
	}
	
	$returnVar = array_values($returnVar);
	return $returnVar;
}

$data = file_get_contents($username);

$data = cut_str($data, 'window._sharedData = ', ';</script>');
$data = json_decode($data[0], 1);
$responses = json_encode($data["entry_data"]["PostPage"][0]["graphql"]['shortcode_media']);
$jsonx = json_decode($responses, true);
#echo $responses;
?>
<?php
 if ($username)
 {
	$response["status"] = "success";
	$response['first_pict'] = $jsonx['display_url']; 
	$response['first_video'] = $jsonx['video_url'];  
	for($i=0; $i < count($jsonx['edge_sidecar_to_children']['edges']); $i++) {
	$response['pict_url'][$i] = $jsonx['edge_sidecar_to_children']['edges'][$i]['node']['display_url']; 
	}
	for($i=0; $i < count($jsonx['edge_sidecar_to_children']['edges']); $i++) {
	$response['video_url'][$i] = $jsonx['edge_sidecar_to_children']['edges'][$i]['node']['video_url'];  
	}
	$response["caption"] = $jsonx['edge_media_to_caption']['edges']['0']['node']['text'];
	$response["like"] = $jsonx['edge_media_preview_like']['count'];
	for($i=0; $i < count($jsonx['edge_media_to_comment']['edges']); $i++) {
	$response['comment'][$i] = $jsonx['edge_media_to_comment']['edges'][$i]['node']['owner']['username'].': '.$jsonx['edge_media_to_comment']['edges'][$i]['node']['text'];  
	}
	echo json_encode($response, JSON_PRETTY_PRINT);
 }
 else
 {
 include('./error.php');
 }
?>