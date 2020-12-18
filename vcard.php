<?php
if($input->get->id){

$item = json_decode(base64_decode($sanitizer->text($input->get->id)));
$file = $sanitizer->pageName($item->name1 ."-". $item->name2 .".vcf",true);
$area = "+358";

header("Content-type: text/plain");
header("Content-Disposition: attachment; filename=". $file .";");

echo "BEGIN:VCARD\n VERSION:3.0
REV:". date("Z") ."
N;CHARSET=utf-8:$item->name2;$item->name1;;;
FN;CHARSET=utf-8:$item->name1 $item->name2
TITLE;CHARSET=utf-8:$item->title
EMAIL;INTERNET:$item->email\n";
foreach($item->phone as $item){
	if (strpos($item, $area) == false) $item = $area . str_replace(" ","", substr($item,1));
	echo "TEL;PREF;WORK:$item\n";
}
echo "ADR;WORK;POSTAL;CHARSET=utf-8:;;$item->street;$item->area;;$item->postal;
ORG;CHARSET=utf-8:Polarputki Oy
END:VCARD";

}
?>

<a href="/vcard?id=<?= base64_encode(json_encode([
"name1" => "Timo",
"name2" => "Anttila",
"email" => "timo.anttila@example.com",
"phone" => [
	"0401234567",
	"0501234567"
],
"title" => "Web Developer",
"street" => "Testikuja 8",
"postal" => "37130",
"area" => "Nokia"
])) ?>" rel="nofollow">vcard</a>
