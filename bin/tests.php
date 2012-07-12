<?php

use Testes\Coverage\Coverage;
use Testes\Finder\Finder;
use Testes\Autoloader;

$base = __DIR__ . '/..';

require $base . '/vendor/autoload.php';

Autoloader::register();
Autoloader::addPath($base . '/tests');
Autoloader::addPath($base . '/src');

$coverage = (new Coverage)->start();
$suite    = (new Finder($base . '/tests', 'Test'))->run();
$analyzer = $coverage->stop()->addDirectory($base . '/src')->is('\.php$');

?>

<?php if ($suite->getAssertions()->isPassed()): ?>
All tests passed!
<?php else: ?>
Tests failed:
<?php foreach ($suite->getAssertions()->getFailed() as $ass): ?>
  <?php echo $ass->getTestClass(); ?>:<?php echo $ass->getTestLine(); ?> <?php echo $ass->getMessage(); ?>

<?php endforeach; ?>
<?php endif; ?>

Coverage: <?php echo $analyzer->getPercentTested(); ?>%

