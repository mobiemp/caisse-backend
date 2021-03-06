<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

include 'DBConfig.php';
include 'functions.php';
include 'parametre.php';

$today_date = date('Y-m-d');
$sql = "SELECT * FROM `table_client_ticket` WHERE date like '%$today_date%' AND id_caisse = $id_caisse";
$tickets = $conn->query($sql);
$nbligne = $tickets->num_rows;
$total_espece = 0;
$total_cb = 0;
$total_cheques = 0;
$total_ttc = 0;
if($nbligne>0){
	while($ticket = $tickets->fetch_assoc()){
		$total_espece+= $ticket['p_espece_euro'];
		$total_cheques += $ticket['p_cheque_euro'];
		$total_cb += $ticket['p_cb'];
		$total_ttc += $ticket['total_euro_du'];
	}
	$date_sortie_ticket = date('d/m/Y H:s:i');
	$total_caisse = "
		CAISSE $id_caisse
		DATE : $date_sortie_ticket
		-----------------------------

		TOTAL ESPECE : $total_espece €
		TOTAL CB : $total_cb €
		TOTAL CHEQUE: $total_cheques €

		-----------------------------

		TOTAL TTC : $total_ttc
	";
	file_put_contents('ticket_total_caisse.txt', $total_caisse);
	echo json_encode(array('response'=>1,'total_espece' => round($total_espece,2),'total_cb'=>round($total_cb,2),'total_cheques'=>round($total_cheques,2),'total_ttc'=>round($total_ttc,2)));
}
else{
	echo 0;
}