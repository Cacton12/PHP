<?php include("connect.php"); ?>
<?php
header('Content-Type: application/json');
$sql = "SELECT q.id, q.question, q.answer, q.value, q.catId, q.datecreated, c.title FROM questions q INNER JOIN categories c ON q.catId = c.id ORDER BY RAND() LIMIT 1";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

$id  = $result['id'];
$question  = $result['question'];
$answer  = $result['answer'];
$value  = $result['value'];
$catId   = $result ['catId'];
$datecreated   = $result ['datecreated'];
$category   = $result ['title'];

$myQuestion = [
    'id' => $id,
    'question' => $question,
    'answer' => $answer,
    'value' => $value,
    'catId' => $catId,
    'datecreated' => $datecreated,
    'category' => $category
];

$question = json_encode($myQuestion);
echo $question;
