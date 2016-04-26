<?php

$json = file_get_contents('http://brightstudio.ru/udata/news/lastlist/news/0/200/.json');
if(!$json) die('no json!');
$json = json_decode($json,true);
if(!$json) die('no json!');

function createElement($xml, $name, $text=null, $attributes=[]){
	$element = $xml->createElement($name);
	if($text){
		$element->nodeValue = $text;
	}
	if($attributes){
		foreach($attributes as $kAttr=>$vAttr){
			$element->setAttribute($kAttr, $vAttr);
		}
	}
	return $element;
}

$xml = new domDocument("1.0", "utf-8");
$root = $xml->createElement("udata");
$xml->appendChild($root);

foreach($json as $key=>$value){
	if($key=='items'){
		$items = createElement($xml, 'items');
		foreach($value['item'] as $vItem){
			$name = $vItem['name'];
			unset($vItem['name']);
			$element = createElement($xml, 'item', $name, $vItem);
			$items->appendChild($element);
		}
		$root->appendChild($items);
	} else {
		$element = createElement($xml, $key, $value);
		$root->appendChild($element);
	}
}

$xml->save("news.xml");

if(!class_exists('XSLTProcessor')) die('NO XSLTProcessor!');

$xsl = new DOMDocument;
$xsl->load('template.xsl');

$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl);

$proc->transformToURI($xml, 'php://output');