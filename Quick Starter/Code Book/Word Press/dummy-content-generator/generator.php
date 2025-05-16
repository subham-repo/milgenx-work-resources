<?php
$xml_paragraph_path = site_url()."/wp-content/themes/kinex/content-generator/dummy_paragraph.xml";
$xml_sentences_path = site_url()."/wp-content/themes/kinex/content-generator/dummy_sentences.xml";


$number = $_GET['n'];
$text   = $_GET['t'];

// echo 'number: '.$number ;
// echo 'text: '.$text ;


$counter = 0;

if($text == 'p'){
	$xml = simplexml_load_file($xml_paragraph_path); 


	foreach ($xml->item as $xml_data) {
		if($counter < $number){
			echo "<p>".$xml_data."</p>";
		}
		$counter++;
	}
}

if($text == 's'){
	$xml = simplexml_load_file($xml_sentences_path); 
	$sentence_heap = explode('.', $xml->item) ;
    echo "<p>";
    foreach ($sentence_heap as $sentence_item) {
    	if($counter < $number){
			echo $sentence_item.". ";
		}
		$counter++;
	}
	echo "</p>";
}

if($text == 'w'){
	$xml = simplexml_load_file($xml_sentences_path); 
	$sentence_heap = explode(' ', $xml->item) ;
    echo "<p>";
    foreach ($sentence_heap as $sentence_item) {
    	if($counter < $number){
			echo $sentence_item." ";
		}
		$counter++;
	}
	echo "</p>";
}

?>