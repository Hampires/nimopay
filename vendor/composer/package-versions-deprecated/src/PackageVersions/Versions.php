<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see \Composer\InstalledVersions::getRootPackage()} instead. The
     *             equivalent expression for this constant's contents is
     *             `\Composer\InstalledVersions::getRootPackage()['name']`.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = 'laravel/laravel';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'akaunting/money' => '1.2.0@75f6d0d036cd1ca82c2926cfae5a7c2759445cfb',
  'berkayk/onesignal-laravel' => 'v1.0.5@3f15369055cbdbd1b46690152cb8af2c9d198222',
  'biscolab/laravel-recaptcha' => '4.4.0@a9f5645aeac0747506cb75ccc3bb70e7fada5a7e',
  'brotzka/laravel-dotenv-editor' => 'v2.1.0@516679ec50e8c3e395ad521f36b1770ab210ee96',
  'chumper/zipper' => 'v1.0.3@d15207e010f8fe1bdd341376bd86d599c4166423',
  'clue/stream-filter' => 'v1.4.1@5a58cc30a8bd6a4eb8f856adf61dd3e013f53f71',
  'composer/package-versions-deprecated' => '1.10.99.1@68c9b502036e820c33445ff4d174327f6bb87486',
  'darryldecode/cart' => '4.1.2@8f227c052d041973c4d91bd77507098e9449d7ef',
  'dnoegel/php-xdg-base-dir' => 'v0.1.1@8f8a6e48c5ecb0f991c2fdcf5f154a47d85f9ffd',
  'doctrine/cache' => '1.10.2@13e3381b25847283a91948d04640543941309727',
  'doctrine/dbal' => '2.10.2@aab745e7b6b2de3b47019da81e7225e14dcfdac8',
  'doctrine/event-manager' => '1.1.1@41370af6a30faa9dc0368c4a6814d596e81aba7f',
  'doctrine/inflector' => '1.4.3@4650c8b30c753a76bf44fb2ed00117d6f367490c',
  'doctrine/lexer' => '1.2.1@e864bbf5904cb8f5bb334f99209b48018522f042',
  'dompdf/dompdf' => 'v0.8.5@6782abfc090b132134cd6cea0ec6d76f0fce2c56',
  'dragonmantank/cron-expression' => 'v2.3.0@72b6fbf76adb3cf5bc0db68559b33d41219aba27',
  'egulias/email-validator' => '2.1.19@840d5603eb84cc81a6a0382adac3293e57c1c64c',
  'erusev/parsedown' => '1.7.4@cb17b6477dfff935958ba01325f2e8a2bfa6dab3',
  'fideloper/proxy' => '4.4.0@9beebf48a1c344ed67c1d36bb1b8709db7c3c1a8',
  'guzzlehttp/guzzle' => '6.5.5@9d4290de1cfd701f38099ef7e183b64b4b7b0c5e',
  'guzzlehttp/promises' => 'v1.3.1@a59da6cf61d80060647ff4d3eb2c03a2bc694646',
  'guzzlehttp/psr7' => '1.6.1@239400de7a173fe9901b9ac7c06497751f00727a',
  'http-interop/http-factory-guzzle' => '1.0.0@34861658efb9899a6618cef03de46e2a52c80fc0',
  'intervention/image' => '2.5.1@abbf18d5ab8367f96b3205ca3c89fb2fa598c69e',
  'jakub-onderka/php-console-color' => 'v0.2@d5deaecff52a0d61ccb613bb3804088da0307191',
  'jakub-onderka/php-console-highlighter' => 'v0.4@9f7a229a69d52506914b4bc61bfdb199d90c5547',
  'jean85/pretty-package-versions' => '1.5.0@e9f4324e88b8664be386d90cf60fbc202e1f7fc9',
  'joedixon/laravel-translation' => 'v1.1.2@4a467398bae73cd16522d523b557e96f3455b9d2',
  'kkomelin/laravel-translatable-string-exporter' => '1.10.1@4f81ad2a89463a50ebd27e981a19344d570d3464',
  'laravel-frontend-presets/argon' => '1.0.12@ff48f7561ef3d58ae702ed08c72eaa4fedbe99cd',
  'laravel-notification-channels/onesignal' => 'v2.1.0@494c928cda9fd60dd4c79914f2ea67646cb25671',
  'laravel-notification-channels/twilio' => '3.0.0@c6e8f01c9e2846f41338e7a9856d9480def8b891',
  'laravel/cashier' => 'v10.7.0@7f3837131fec83f4224418ee6fc7d37b16e07f94',
  'laravel/framework' => 'v5.8.38@78eb4dabcc03e189620c16f436358d41d31ae11f',
  'laravel/socialite' => 'v4.4.1@80951df0d93435b773aa00efe1fad6d5015fac75',
  'laravel/tinker' => 'v1.0.10@ad571aacbac1539c30d480908f9d0c9614eaf1a7',
  'league/flysystem' => '1.1.2@63cd8c14708b9544d3f61d3c15b747fda1c95c6e',
  'league/mime-type-detection' => '1.4.0@fda190b62b962d96a069fcc414d781db66d65b69',
  'league/oauth1-client' => '1.7.0@fca5f160650cb74d23fc11aa570dd61f86dcf647',
  'maatwebsite/excel' => '3.1.21@405ff5f0dd014a0d5a1fdb8fd6f525a9a1ece3f6',
  'maennchen/zipstream-php' => '2.1.0@c4c5803cc1f93df3d2448478ef79394a5981cc58',
  'markbaker/complex' => '1.4.8@8eaa40cceec7bf0518187530b2e63871be661b72',
  'markbaker/matrix' => '1.2.0@5348c5a67e3b75cd209d70103f916a93b1f1ed21',
  'moneyphp/money' => 'v3.3.1@122664c2621a95180a13c1ac81fea1d2ef20781e',
  'monolog/monolog' => '1.25.5@1817faadd1846cd08be9a49e905dc68823bc38c0',
  'myclabs/php-enum' => '1.7.6@5f36467c7a87e20fbdc51e524fd8f9d1de80187c',
  'nesbot/carbon' => '2.38.0@d8f6a6a91d1eb9304527b040500f61923e97674b',
  'nikic/php-parser' => 'v4.9.0@aaee038b912e567780949787d5fe1977be11a778',
  'onecentlin/laravel-adminer' => '4.7.7@b17a3413c0275e1061d2acaf197d973725447426',
  'opis/closure' => '3.5.6@e8d34df855b0a0549a300cb8cb4db472556e8aa9',
  'paragonie/random_compat' => 'v9.99.99@84b4dfb120c6f9b4ff7b3685f9b8f1aa365a0c95',
  'paypal/rest-api-sdk-php' => '1.14.0@72e2f2466975bf128a31e02b15110180f059fc04',
  'pcinaglia/laraupdater' => '1.0.2@d19d88f0b1c1cbe7a2fdb5505d3d5f434939e8dd',
  'phenx/php-font-lib' => '0.5.2@ca6ad461f032145fff5971b5985e5af9e7fa88d8',
  'phenx/php-svg-lib' => 'v0.3.3@5fa61b65e612ce1ae15f69b3d223cb14ecc60e32',
  'php-http/client-common' => '2.3.0@e37e46c610c87519753135fb893111798c69076a',
  'php-http/discovery' => '1.9.1@64a18cc891957e05d91910b3c717d6bd11fbede9',
  'php-http/guzzle6-adapter' => 'v2.0.1@6074a4b1f4d5c21061b70bab3b8ad484282fe31f',
  'php-http/httplug' => '2.2.0@191a0a1b41ed026b717421931f8d3bd2514ffbf9',
  'php-http/message' => '1.8.0@ce8f43ac1e294b54aabf5808515c3554a19c1e1c',
  'php-http/message-factory' => 'v1.0.2@a478cb11f66a6ac48d8954216cfed9aa06a501a1',
  'php-http/promise' => '1.1.0@4c4c1f9b7289a2ec57cde7f1e9762a5789506f88',
  'phpoffice/phpspreadsheet' => '1.14.1@2383aad5689778470491581442aab38cec41bf1d',
  'phpoption/phpoption' => '1.7.5@994ecccd8f3283ecf5ac33254543eb0ac946d525',
  'psr/container' => '1.0.0@b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
  'psr/http-client' => '1.0.1@2dfb5f6c5eff0e91e20e913f8c5452ed95b86621',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.3@0f73288fd15629204f9d42b7055f72dacbe811fc',
  'psr/simple-cache' => '1.0.1@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
  'psy/psysh' => 'v0.9.12@90da7f37568aee36b116a030c5f99c915267edd4',
  'rachidlaasri/laravel-installer' => '4.1.0@b751b4c23dba893e9a4a12f881a6fd8fa921d228',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'ramsey/uuid' => '3.9.3@7e1633a6964b48589b142d60542f9ed31bd37a92',
  'sabberworm/php-css-parser' => '8.3.1@d217848e1396ef962fb1997cf3e2421acba7f796',
  'sentry/sdk' => '2.1.0@18921af9c2777517ef9fb480845c22a98554d6af',
  'sentry/sentry' => '2.4.3@89fd1f91657b33ec9139f33f8a201eb086276103',
  'sentry/sentry-laravel' => '1.8.0@912731d2b704fb6a97cef89c7a8b5c367cbf6088',
  'silviolleite/laravelpwa' => '2.0.3@5f7135d2ee870af01793c9fdf6b1b932b546e20e',
  'spatie/geocoder' => '3.6.1@006b79000a95240021bb97e21c57bce898b8157d',
  'spatie/laravel-cookie-consent' => '2.12.9@423f17b60aaca47431414d0a0ef07614711f73d0',
  'spatie/laravel-googletagmanager' => '2.6.2@aadef9d3fc9ced1a8ab03a91ddab59979644182c',
  'spatie/laravel-permission' => '2.38.0@674ad54a0ba95d8ad26990aa250b5c9d9b165e15',
  'stripe/stripe-php' => 'v7.49.0@db6229bff448f7f3bf7f6aee112d5d9ba34ca4ba',
  'swiftmailer/swiftmailer' => 'v6.2.3@149cfdf118b169f7840bbe3ef0d4bc795d1780c9',
  'symfony/console' => 'v4.4.11@55d07021da933dd0d633ffdab6f45d5b230c7e02',
  'symfony/css-selector' => 'v5.1.3@e544e24472d4c97b2d11ade7caacd446727c6bf9',
  'symfony/debug' => 'v4.4.11@47aa9064d75db36389692dd4d39895a0820f00f2',
  'symfony/deprecation-contracts' => 'v2.1.3@5e20b83385a77593259c9f8beb2c43cd03b2ac14',
  'symfony/error-handler' => 'v4.4.11@66f151360550ec2b3273b3746febb12e6ba0348b',
  'symfony/event-dispatcher' => 'v4.4.11@6140fc7047dafc5abbe84ba16a34a86c0b0229b8',
  'symfony/event-dispatcher-contracts' => 'v1.1.9@84e23fdcd2517bf37aecbd16967e83f0caee25a7',
  'symfony/finder' => 'v4.4.11@2727aa35fddfada1dd37599948528e9b152eb742',
  'symfony/http-foundation' => 'v4.4.11@3675676b6a47f3e71d3ab10bcf53fb9239eb77e6',
  'symfony/http-kernel' => 'v4.4.11@a675d2bf04a9328f164910cae6e3918b295151f3',
  'symfony/intl' => 'v5.1.3@7299f8c95ffd2623986c976fb8c48beb4c4cb44d',
  'symfony/mime' => 'v5.1.3@149fb0ad35aae3c7637b496b38478797fa6a7ea6',
  'symfony/options-resolver' => 'v5.1.3@9ff59517938f88d90b6e65311fef08faa640f681',
  'symfony/polyfill-ctype' => 'v1.18.1@1c302646f6efc070cd46856e600e5e0684d6b454',
  'symfony/polyfill-iconv' => 'v1.18.1@6c2f78eb8f5ab8eaea98f6d414a5915f2e0fce36',
  'symfony/polyfill-intl-icu' => 'v1.18.1@4e45a6e39041a9cc78835b11abc47874ae302a55',
  'symfony/polyfill-intl-idn' => 'v1.18.1@5dcab1bc7146cf8c1beaa4502a3d9be344334251',
  'symfony/polyfill-intl-normalizer' => 'v1.18.1@37078a8dd4a2a1e9ab0231af7c6cb671b2ed5a7e',
  'symfony/polyfill-mbstring' => 'v1.18.1@a6977d63bf9a0ad4c65cd352709e230876f9904a',
  'symfony/polyfill-php70' => 'v1.18.1@0dd93f2c578bdc9c72697eaa5f1dd25644e618d3',
  'symfony/polyfill-php72' => 'v1.18.1@639447d008615574653fb3bc60d1986d7172eaae',
  'symfony/polyfill-php73' => 'v1.18.1@fffa1a52a023e782cdcc221d781fe1ec8f87fcca',
  'symfony/polyfill-php80' => 'v1.18.1@d87d5766cbf48d72388a9f6b85f280c8ad51f981',
  'symfony/polyfill-uuid' => 'v1.18.1@da48e2cccd323e48c16c26481bf5800f6ab1c49d',
  'symfony/process' => 'v4.4.11@65e70bab62f3da7089a8d4591fb23fbacacb3479',
  'symfony/psr-http-message-bridge' => 'v2.0.1@e44f249afab496b4e8c0f7461fb8140eaa4b24d2',
  'symfony/routing' => 'v4.4.11@e103381a4c2f0731c14589041852bf979e97c7af',
  'symfony/service-contracts' => 'v2.1.3@58c7475e5457c5492c26cc740cc0ad7464be9442',
  'symfony/translation' => 'v4.4.11@a8ea9d97353294eb6783f2894ef8cee99a045822',
  'symfony/translation-contracts' => 'v2.1.3@616a9773c853097607cf9dd6577d5b143ffdcd63',
  'symfony/var-dumper' => 'v4.4.11@2125805a1a4e57f2340bc566c3013ca94d2722dc',
  'tijsverkoyen/css-to-inline-styles' => '2.2.3@b43b05cf43c1b6d849478965062b6ef73e223bb5',
  'twilio/sdk' => '6.10.0@ed7d54168a437794c4bb9ee52fe173c328402b1b',
  'unicodeveloper/laravel-paystack' => '1.0.4@533d45b3e7c68e283a2ed71ddd45af1ef7728873',
  'vlucas/phpdotenv' => 'v3.6.7@2065beda6cbe75e2603686907b2e45f6f3a5ad82',
  'willvincent/laravel-rateable' => '1.0.9@3ee044baadc424aab13db250d3233af34761dc7b',
  'barryvdh/laravel-debugbar' => 'v3.4.1@9e785aa5584e8839fd43070202dd7f2e912db51c',
  'beyondcode/laravel-dump-server' => '1.3.0@fcc88fa66895f8c1ff83f6145a5eff5fa2a0739a',
  'doctrine/instantiator' => '1.3.1@f350df0268e904597e3bd9c4685c53e0e333feea',
  'filp/whoops' => '2.7.3@5d5fe9bb3d656b514d455645b3addc5f7ba7714d',
  'fzaninotto/faker' => 'v1.9.1@fc10d778e4b84d5bd315dad194661e091d307c6f',
  'hamcrest/hamcrest-php' => 'v2.0.1@8c3d0a3f6af734494ad8f6fbbee0ba92422859f3',
  'maximebf/debugbar' => 'v1.16.3@1a1605b8e9bacb34cc0c6278206d699772e1d372',
  'mockery/mockery' => '1.3.3@60fa2f67f6e4d3634bb4a45ff3171fa52215800d',
  'myclabs/deep-copy' => '1.10.1@969b211f9a51aa1f6c01d1d2aef56d3bd91598e5',
  'nunomaduro/collision' => 'v3.0.1@af42d339fe2742295a54f6fdd42aaa6f8c4aca68',
  'phar-io/manifest' => '1.0.3@7761fcacf03b4d4f16e7ccb606d4879ca431fcf4',
  'phar-io/version' => '2.0.1@45a2ec53a73c70ce41d55cedef9063630abaf1b6',
  'phpdocumentor/reflection-common' => '2.2.0@1d01c49d4ed62f25aa84a747ad35d5a16924662b',
  'phpdocumentor/reflection-docblock' => '5.2.1@d870572532cd70bc3fab58f2e23ad423c8404c44',
  'phpdocumentor/type-resolver' => '1.3.0@e878a14a65245fbe78f8080eba03b47c3b705651',
  'phpspec/prophecy' => '1.11.1@b20034be5efcdab4fb60ca3a29cba2949aead160',
  'phpunit/php-code-coverage' => '6.1.4@807e6013b00af69b6c5d9ceb4282d0393dbb9d8d',
  'phpunit/php-file-iterator' => '2.0.2@050bedf145a257b1ff02746c31894800e5122946',
  'phpunit/php-text-template' => '1.2.1@31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
  'phpunit/php-timer' => '2.1.2@1038454804406b0b5f5f520358e78c1c2f71501e',
  'phpunit/php-token-stream' => '3.1.1@995192df77f63a59e47f025390d2d1fdf8f425ff',
  'phpunit/phpunit' => '7.5.20@9467db479d1b0487c99733bb1e7944d32deded2c',
  'sebastian/code-unit-reverse-lookup' => '1.0.1@4419fcdb5eabb9caa61a27c7a1db532a6b55dd18',
  'sebastian/comparator' => '3.0.2@5de4fc177adf9bce8df98d8d141a7559d7ccf6da',
  'sebastian/diff' => '3.0.2@720fcc7e9b5cf384ea68d9d930d480907a0c1a29',
  'sebastian/environment' => '4.2.3@464c90d7bdf5ad4e8a6aea15c091fec0603d4368',
  'sebastian/exporter' => '3.1.2@68609e1261d215ea5b21b7987539cbfbe156ec3e',
  'sebastian/global-state' => '2.0.0@e8ba02eed7bbbb9e59e43dedd3dddeff4a56b0c4',
  'sebastian/object-enumerator' => '3.0.3@7cfd9e65d11ffb5af41198476395774d4c8a84c5',
  'sebastian/object-reflector' => '1.1.1@773f97c67f28de00d397be301821b06708fca0be',
  'sebastian/recursion-context' => '3.0.0@5b0cd723502bac3b006cbf3dbf7a1e3fcefe4fa8',
  'sebastian/resource-operations' => '2.0.1@4d7a795d35b889bf80a0cc04e08d77cedfa917a9',
  'sebastian/version' => '2.0.1@99732be0ddb3361e16ad77b68ba41efc8e979019',
  'theseer/tokenizer' => '1.2.0@75a63c33a8577608444246075ea0af0d052e452a',
  'webmozart/assert' => '1.9.1@bafc69caeb4d49c39fd0779086c03a3738cbb389',
  'laravel/laravel' => '1.0.0+no-version-set@',
);

    private function __construct()
    {
        class_exists(InstalledVersions::class);
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (class_exists(InstalledVersions::class, false)) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }
}
