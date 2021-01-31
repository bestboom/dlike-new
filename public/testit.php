<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//include '../vendor/spatie/image-optimizer/src/OptimizerChainFactory.php';
require_once("../vendor/autoload.php"); 
include 'helper/spatie/image-optimizer/src/Optimizers';
include 'helper/spatie/image-optimizer/src/Optimizers/BaseOptimizer.php';
include 'helper/spatie/image-optimizer/src/Optimizers/Optipng.php';
include 'helper/spatie/image-optimizer/src/Optimizers/Gifsicle.php';
include 'helper/spatie/image-optimizer/src/Optimizers/Jpegoptim.php';
include 'helper/spatie/image-optimizer/src/Optimizers/Cwebp.php';
include 'helper/spatie/image-optimizer/src/Optimizers/Svgo.php';
include 'helper/spatie/image-optimizer/src/Optimizers/Pngquant.php';
include 'helper/spatie/image-optimizer/src/OptimizerChainFactory.php';
include 'helper/spatie/image-optimizer/src/OptimizerChain.php';
include 'helper/spatie/Psr/Log/LoggerInterface.php';
include 'helper/spatie/image-optimizer/src/DummyLogger.php';


use Spatie\ImageOptimizer\OptimizerChainFactory;

$optimizerChain = OptimizerChainFactory::create();

echo $pathToImage = "https://aniportalimages.s3.amazonaws.com/media/details/__sized__/Palestine_covid_jan_30-thumbnail-154x87-70.jpg";

echo $optimizerChain->optimize($pathToImage);

?>	