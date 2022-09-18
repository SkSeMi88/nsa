<?php include __DIR__ . '/../header.php'; ?>
<div>
<form name="new_shifr">
	Фонд
	<input type="text" name="fond_id" id="fond_id" value="">
	Опись
	<input type="text" name="opis_id" id="opis_id" value="">
	Дело
	<input type="text" name="delo_id" id="delo_id" value="">
	Лист
	<input type="text" name="list" id="list" value="">
</form>
</div>

<?php foreach ($articles as $article): ?>
    <h2><a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h2>
    <p><?= $article->getText() ?></p>
     <p>Автор: <?= $article->getAuthor()->getnickname()?></p>
    <hr>
<?php endforeach; ?>
<?php include __DIR__ . '/../footer.php'; ?>