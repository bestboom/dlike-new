<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//include '../vendor/spatie/image-optimizer/src/OptimizerChainFactory.php';
require_once("../vendor/autoload.php"); 
include 'helper/spatie/image-optimizer/src/OptimizerChainFactory.php';
include 'helper/spatie/image-optimizer/src/OptimizerChain.php';
include 'helper/spatie/image-optimizer/src/Image.php';
include 'helper/spatie/image-optimizer/src/Optimizer.php';
include 'helper/spatie/image-optimizer/src/Optimizers/BaseOptimizer.php';
include 'helper/spatie/image-optimizer/src/Optimizers/Optipng.php';
include 'helper/spatie/image-optimizer/src/Optimizers/Gifsicle.php';
include 'helper/spatie/image-optimizer/src/Optimizers/Jpegoptim.php';
include 'helper/spatie/image-optimizer/src/Optimizers/Cwebp.php';
include 'helper/spatie/image-optimizer/src/Optimizers/Svgo.php';
include 'helper/spatie/image-optimizer/src/Optimizers/Pngquant.php';

include 'helper/spatie/Psr/Log/LoggerInterface.php';
include 'helper/spatie/image-optimizer/src/DummyLogger.php';


use Spatie\ImageOptimizer\OptimizerChainFactory;



echo $pathToImage = "https://aniportalimages.s3.amazonaws.com/media/details/__sized__/Palestine_covid_jan_30-thumbnail-154x87-70.jpg";
echo '<br>';
echo $originalSize = filesize($pathToImage);

// Optimize updates the existing image
$optimizerChain = OptimizerChainFactory::create();
$optimizerChain->optimize($pathToImage);

// Clear stat cache to get the optimized size
clearstatcache();

// Check the optimized size
$optimizedSize = filesize($pathToImage);
$percentChange = (1 - $optimizedSize / $originalSize) * 100;
echo sprintf("The image is now %.2f%% smaller\n", $percentChange);

?>	