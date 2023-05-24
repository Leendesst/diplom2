<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Work;

use App\Domain\Service\Service;
use App\Domain\Service\ServiceNotFoundException;
use App\Domain\Work\Work;
use App\Domain\Work\WorkNotFoundException;
use App\Domain\Work\WorkRepository;
use PDO;
use PDOException;
use Psr\Log\LoggerInterface;

class PDOWorkRepository implements WorkRepository {
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * PDOServiceRepository constructor.
     *
     * @param PDO $pdo Database interface
     * @param LoggerInterface $logger Logger interface
     */
    public function __construct(PDO $pdo, LoggerInterface $logger) {
        $this->pdo = $pdo;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function find(?int $max=10, ?int $offset=0): array {
        try {
            // TODO: Починить загрузку контента "по частям"
            $stmt = $this->pdo->prepare('SELECT * FROM `works`'/*' LIMIT :offset, :max'*/);
            if($stmt->execute()) {
                $output = [];
                while ($row = $stmt->fetch()) {
                    $output[] = new Work(intval($row['id']), $row['title'], $row['text'], $row['date']);
                }
                return $output;
            } else {
                return [];
            }
        } catch (PDOException $e) {
            $this->logger->error($e->getMessage() . " on " . __FILE__);
            return [];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function findWorkOfId(int $id): Work {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM `works` WHERE `id` = :id');
            $stmt->bindParam('id', $id, PDO::PARAM_INT);
            if($stmt->execute() && $row = $stmt->fetch()) {
                return new Work(intval($row['id']), $row['title'], $row['text'], $row['date']);
            } else {
                throw new ServiceNotFoundException();
            }
        } catch (PDOException $e) {
            $this->logger->error($e->getMessage() . " on " . __FILE__);
            throw new ServiceNotFoundException();
        }
    }
}
