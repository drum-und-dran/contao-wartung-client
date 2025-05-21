<?php

namespace DuD\ContaoWartungClientBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Contao\CoreBundle\ContaoCoreBundle;
use Composer\InstalledVersions;
use Doctrine\DBAL\Connection;

class ApiController
{
    private const AUTH_SALT = '-u>7XLzvkq&y';

    public function __construct(
        private ParameterBagInterface $params,
        private Connection $connection
    ) {}

    public function systemInfo(Request $request): JsonResponse
    {
        $serverAuth = $request->query->get('auth');
        $host = parse_url($request->getSchemeAndHttpHost(), PHP_URL_HOST);
        $cleanHost = preg_replace('/^www\./', '', $host);
        $expectedAuth = hash('sha256', $cleanHost . self::AUTH_SALT);

        if ($serverAuth !== $expectedAuth) {
            return new JsonResponse(['error' => 'Unauthorized'], 401);
        }

        $phpVersion = phpversion();
        $contaoVersion = InstalledVersions::isInstalled('contao/core-bundle')
            ? InstalledVersions::getPrettyVersion('contao/core-bundle')
            : 'unknown';
        $mysqlVersion = $this->getMysqlVersion();

        return new JsonResponse([
            'php_version' => $phpVersion,
            'contao_version' => $contaoVersion,
            'mysql_version' => $mysqlVersion
        ]);
    }

    private function getMysqlVersion(): ?string
    {
        try {
            return $this->connection->fetchOne('SELECT VERSION()');
        } catch (\Throwable $e) {
            return null;
        }
    }
}
