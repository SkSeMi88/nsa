<?php include __DIR__ . '/../header.php'; ?>
    <div style="text-align: center;">
        <h1>Активация не возможна.</h1>
        <?php if (!empty($errors)): ?>
            <div style="background-color: red;padding: 5px;margin: 15px"><?= $errors; ?></div>
        <?php endif; ?>
        <div>Обратитесь в <a href="#">службу поддерждки </a> портала.</div>
    </div>
<?php include __DIR__ . '/../footer.php'; ?>